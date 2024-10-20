<?php

namespace App\Http\Controllers;

use App\Charts\InterestDue;
use App\Charts\LoanDueChart;
use App\Charts\LoanMonthly;
use App\Charts\MonthlyPayment;
use App\Charts\PrincipleDue;
use App\Models\Borrow\Borrower;
use App\Models\Loan\Loan;
use App\Models\Loan\LoanPayment;
use App\Models\Loan\LoanSchedule;
use App\Services\ChartService;
use Carbon\Carbon;
use Illuminate\Http\Request;


class DashboardController extends Controller
{




    public function index(Request $request){

             $totalOutstanding = Loan::sum('principle_amount');
             $amountDue= LoanSchedule::query()->whereDate('due_date', '<=', Carbon::now())->where('amount', '>', 0)->sum('amount');
             $principleOutstanding = LoanSchedule::sum('principle');
             $interestOut = LoanSchedule::sum('interest');
             $fully = LoanPayment::query()->where('status', '=','completed')->count();
             $open = LoanPayment::query()->where('status', '!=', 'completed')->count();
             $borrowers = Borrower::count('id');
             $denied =Loan::query()->where('status', '=', 'rejected')->count();
             $loans =Loan::query()->where('release_status', '=', 'approved')->count();
             $dataMonth = new ChartService();
             $monthly = $dataMonth->getMonthProjected();
             $books = $dataMonth->getMonthLoan();

             $currentMonth = Carbon::now()->month;
             $currentYear = Carbon::now()->year;
             
     
             $interestThisMonth = LoanSchedule::whereMonth('due_date', $currentMonth)
                 ->whereYear('due_date', $currentYear)
                 ->sum('interest_paid');
    

        return view ('dashboard',[
            'totalOutstanding' => $totalOutstanding,
            'amountDue' => $amountDue,
            'principleOutstanding' => $principleOutstanding,
            'interestOut' => $interestOut,
            'fully' => $fully,
            'open' => $open,
            'loans' => $loans,
            'borrowers' => $borrowers,
            'denied' => $denied,
            'monthly' => $monthly,
            'books' => $books,
            'interest' => $interestThisMonth


        ]);
    }
}
