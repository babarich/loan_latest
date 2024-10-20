<?php

namespace App\Http\Controllers\Loan;


use App\Charts\InterestChart;
use App\Charts\InterestProjectedChart;
use App\Charts\LoanMonthly;
use App\Charts\LoanProjected;
use App\Charts\MonthlyPayment;
use App\Charts\PrincipleChart;
use App\Charts\PrincipleProjectedChart;
use App\Http\Controllers\Controller;
use App\Models\Borrow\Borrower;
use App\Models\Borrow\BorrowerGroup;
use App\Models\Loan\Loan;
use App\Models\Loan\LoanPayment;
use App\Models\Loan\LoanSchedule;
use App\Models\Loan\PaymentLoan;
use App\Models\User;
use App\Services\ChartService;
use App\Services\CollectionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class PaymentController extends Controller
{



    public function index(Request $request){


        $payments = PaymentLoan::query()->orderBy('updated_at', 'desc')->get();

        return view('payment.index', compact('payments'));

    }



    public function chart(Request $request, InterestChart $interestChart, 
    InterestProjectedChart $projectedChart,
    PrincipleChart $principleChart, PrincipleProjectedChart $principleProjectedChart, 
    LoanProjected $loanProjected, MonthlyPayment $monthlyPayment)
    {

        $today = PaymentLoan::today()->sum('amount');

        $total = PaymentLoan::sum('amount');
        $week = PaymentLoan::lastweek()->sum('amount');
        $lastMonth = PaymentLoan::lastmonth()->sum('amount');
        $month = PaymentLoan::month()->sum('amount');
        $loans = Loan::count();
        $interest = LoanSchedule::sum('interest_paid');
        $principle = LoanSchedule::sum('principal_paid');
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $lastMonth = Carbon::now()->subMonth()->month;
        $lastMonthYear = Carbon::now()->subMonth()->year;


        $interestThisMonth = LoanSchedule::whereMonth('due_date', $currentMonth)
            ->whereYear('due_date', $currentYear)
            ->sum('interest_paid');


        $interestLastMonth = LoanSchedule::whereMonth('due_date', $lastMonth)
            ->whereYear('due_date', $lastMonthYear)
            ->sum('interest_paid');


        return view('payment.chart',[
            'today' => $today,
            'total' => $total,
            'week' => $week,
            'month' => $month,
            'lastMonth' => $lastMonth,
            'loan' => $loans,
            'interest' => $interest,
            'interestMonth' => $interestThisMonth,
            'interestLastMonth' => $interestLastMonth,
            'principle' => $principle,
            'chartData' => $monthlyPayment->build(),
            'projectedMonth' => $loanProjected->build(),
            'interestPaid' => $interestChart->build(),
            'interestProjected' => $projectedChart->build(),
            'principlePaid' => $principleChart->build(),
            'principleProjected' => $principleProjectedChart->build()
        ]);
    }




    public function collection(Request $request)
    {

        $query = LoanSchedule::query();

        $query->currentMonth();

        if ($request->filled('due_date') && !$request->filled('start_date')) {
            $query->filter($request);
        }

        if ($request->filled('start_date') && !$request->filled('due_date')) {
            $query->filter($request);
        }


        if ($request->filled('due_date') && $request->filled('start_date')) {
            $query->filter($request);
        }


    
        if ($request->filled('user_id')) {
            $query->byUser($request->input('user_id'));
        }

        $schedules = $query->get();
        $users = User::query()->where('com_id', Auth::user()->com_id)->get();

        return view('payment.collection', compact('schedules', 'users'));

    }

    public function create(){

        $borrowers = Borrower::whereHas('loans', function ($query) {
        $query->where('release_status', 'approved');
    })->whereHas('schedules', function ($query) {
        $query->select('borrower_id')
            ->groupBy('borrower_id')
            ->havingRaw('SUM(amount) > 0');
    })->with(['loans' => function ($query) {
        $query->where('release_status', 'approved');
    }, 'schedules' => function ($query) {
        $query->select('borrower_id')
            ->groupBy('borrower_id')
            ->havingRaw('SUM(amount) > 0');
    }])->get();



        return view('payment.create', compact('borrowers'));

    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'amount' => 'required|numeric|gt:0',
            'payment_date' => 'required|date',
            'type' => 'required'
        ]);

        try{
           DB::beginTransaction();

           $loanSchedules = LoanSchedule::query()
           ->where('borrower_id', $validatedData['customer_id'])
           ->where('paid', false)
           ->orderBy('due_date', 'asc')
           ->get();
       
       if ($loanSchedules->isNotEmpty()) {
           $paymentAmount = $validatedData['amount'];
           $totalAmountDue = $loanSchedules->sum(function($schedule) {
               return $schedule->interest + $schedule->principle;
           });
       
           if ($paymentAmount > $totalAmountDue) {
             session()->flash('error', 'Payment amount exceeds the total amount due');
            return redirect()->back();
            
           }
       
           foreach ($loanSchedules as $loanSchedule) {
               $remainingAmountDue = $loanSchedule->interest + $loanSchedule->principle;
       
               if ($paymentAmount >= $remainingAmountDue) {
                   $paidInterest = $loanSchedule->interest;
                   $paidPrincipal = $loanSchedule->principle;
                   $paymentAmount -= $remainingAmountDue;
       
                   $loanSchedule->paid = true;
                   $loanSchedule->status = 'completed';
                   $loanSchedule->interest_paid = $paidInterest;
                   $loanSchedule->interest = 0;
                   $loanSchedule->principal_paid = $paidPrincipal;
                   $loanSchedule->principle = 0;
                   $loanSchedule->amount = 0;
                   $loanSchedule->save();
               } else {
                   $paidInterest = min($paymentAmount, $loanSchedule->interest);
                   $loanSchedule->interest_paid += $paidInterest;
                   $loanSchedule->interest -= $paidInterest;
                   $paymentAmount -= $paidInterest;
       
                   $paidPrincipal = min($paymentAmount, $loanSchedule->principle);
                   $loanSchedule->principal_paid += $paidPrincipal;
                   $loanSchedule->principle -= $paidPrincipal;
                   $paymentAmount -= $paidPrincipal;
       
                   $loanSchedule->paid = false;
                   $loanSchedule->status = 'partial';
                   $loanSchedule->amount -= ($paidInterest + $paidPrincipal);
                   $loanSchedule->save();
               }
       
               if ($paymentAmount <= 0) {
                   break;
               }
           }
       
           $payment = LoanPayment::query()->where('loan_id', $loanSchedules->first()->loan_id)->first();
           $totalPaid = $payment->paid_amount + $validatedData['amount'];
           $dueAmount = max(0, $payment->due_amount - $validatedData['amount']);
           $payment->update(['paid_amount' => $totalPaid, 'due_amount' => $dueAmount]);
       
           PaymentLoan::create([
               'loan_id' => $loanSchedules->first()->loan_id,
               'borrower_id' => $loanSchedules->first()->borrower_id,
               'description' => $request->filled('description') ? $request->input('description') : null,
               'payment_date' => $validatedData['payment_date'],
               'amount' => $validatedData['amount'],
               'type' => $validatedData['type'],
               'bank' => $request->filled('bank') ? $request->input('bank') : null,
               'mobile' => $request->filled('mobile') ? $request->input('mobile') : null,
               'reference' => $request->filled('reference') ? $request->input('reference') : null,
               'user_id' => Auth::id(),
               'com_id' => Auth::user()->com_id,
           ]);
       }
       
           DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            Log::info('error_payment', [$e]);
            return redirect()->back()->with('error', 'Sorry something went wrong please try again later');
        }
        return redirect()->route('payment.index')->with('success', 'You have added a payment successfully');
    }
}
