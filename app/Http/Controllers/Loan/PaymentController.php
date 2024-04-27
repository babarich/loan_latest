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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class PaymentController extends Controller
{



    public function index(Request $request){

        $perPage = request('per_page',10);
        $sortField = request('sort_field','created_at');
        $sortDirection = request('sort_direction','desc');
        return Inertia::render('Payment/Index',[
            'filters' => FacadesRequest::all('search'),
            'payments' => PaymentLoan::query()
                ->orderBy($sortField, $sortDirection)
                ->filter(FacadesRequest::only('search'))
                ->paginate($perPage,['*'],'payments')
                ->withQueryString()
                ->through(fn ($payment) => [
                    'id' => $payment->id,
                    'reference' => $payment->loan->reference,
                    'name' => $payment->loan->borrower->first_name . ' ' . $payment->loan->borrower->last_name,
                    'date' =>$payment->payment_date,
                    'type' => $payment->type,
                    'amount'=>$payment->amount,
                    'user' => $payment->user->name
                ])

        ]);

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


        return Inertia::render('Payment/Chart',[
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

        $filterUser = $request->input('filterCollection');
        $query = PaymentLoan::today()
            ->select(
                DB::raw('COUNT(id) as total_id'),
                DB::raw('SUM(amount) as total_amount'),
                DB::raw('COUNT(DISTINCT user_id) as total_users')
            );

        if ($filterUser) {
            $startDate = $filterUser['startDate'];
            $endDate = $filterUser['endDate'];
            $userId = $filterUser['staffId'];
            $borrowerGroup = $filterUser['groupId'];

            $query->with(['loan', 'loan.borrower']);

            if ($startDate && $endDate) {
                $query->whereBetween('payment_date', [$startDate, $endDate]);
            }

            if ($userId) {
                $query->where('user_id', $userId);
            }

            if ($borrowerGroup) {
                $query->whereHas('loan.borrower', function ($query) use ($borrowerGroup) {
                    $query->where('group_id', $borrowerGroup);
                });
            }
        }

        $results = $query->first();





        $staff = User::query()->get();
        $groups = BorrowerGroup::query()->get();

        return Inertia::render('Collection/Index',
        [
            'staffs' => $staff,
            'groups' => $groups,
            'collections' => $results
        ]);
    }
}
