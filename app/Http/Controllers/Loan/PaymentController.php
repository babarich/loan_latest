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
use App\Models\Borrow\BorrowerGroup;
use App\Models\Loan\Loan;
use App\Models\Loan\LoanSchedule;
use App\Models\Loan\PaymentLoan;
use App\Models\User;
use App\Services\ChartService;
use App\Services\CollectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class PaymentController extends Controller
{



    public function index(Request $request){


        $payments = PaymentLoan::query()->orderBy('updated_at', 'desc')->get();

        return view('payment.index', compact('payments'));

    }



    public function chart(Request $request, InterestChart $interestChart, InterestProjectedChart $projectedChart,
    PrincipleChart $principleChart, PrincipleProjectedChart $principleProjectedChart, LoanProjected $loanProjected, MonthlyPayment $monthlyPayment)
    {

        $today = PaymentLoan::today()->sum('amount');

        $total = PaymentLoan::sum('amount');
        $week = PaymentLoan::lastweek()->sum('amount');
        $month = PaymentLoan::lastmonth()->sum('amount');
        $loans = Loan::count();
        $interest = LoanSchedule::sum('interest_paid');
        $principle = LoanSchedule::sum('principal_paid');


        return view('payment.chart',[
            'today' => $today,
            'total' => $total,
            'week' => $week,
            'month' => $month,
            'loan' => $loans,
            'interest' => $interest,
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

        if ($request->filled('due_date')) {
            $query->dueDate($request->input('due_date'));
        }

        if ($request->filled('start_date')) {
            $query->startDate($request->input('start_date'));
        }

        if ($request->filled('user_id')) {
            $query->byUser($request->input('user_id'));
        }

        $schedules = $query->get();
        $users = User::query()->where('com_id', Auth::user()->com_id)->get();

        return view('payment.collection', compact('schedules', 'users'));

    }
}
