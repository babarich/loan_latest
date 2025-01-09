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
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{




    public function index(Request $request){

             $user = Auth::user();
             $totalOutstanding = Loan::where('com_id', $user->com_id)->sum('principle_amount');
             $amountDue= LoanSchedule::query()->where('com_id', $user->com_id)->whereDate('due_date', '<=', Carbon::now())->where('amount', '>', 0)->sum('amount');
             $principleOutstanding = LoanSchedule::where('com_id', $user->com_id)->sum('principle');
             $interestOut = LoanSchedule::where('com_id', $user->com_id)->sum('interest');
             $fully = LoanPayment::query()->where('com_id', $user->com_id)->where('status', '=','completed')->count();
             $open = LoanPayment::query()->where('status', '!=', 'completed')->count();
             $borrowers = Borrower::where('com_id', $user->com_id)->count('id');
             $denied =Loan::query()->where('com_id', $user->com_id)->where('status', '=', 'rejected')->count();
             $loans =Loan::query()->where('com_id', $user->com_id)->where('release_status', '=', 'approved')->count();
             $dataMonth = new ChartService();
             $monthly = $dataMonth->getMonthProjected();
             $books = $dataMonth->getMonthLoan();

             $currentMonth = Carbon::now()->month;
             $currentYear = Carbon::now()->year;
             
     
             $interestThisMonth = LoanSchedule::whereMonth('due_date', $currentMonth)
                 ->whereYear('due_date', $currentYear)
                 ->where('com_id', $user->com_id)
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
