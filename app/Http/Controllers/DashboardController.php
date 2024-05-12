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
use Carbon\Carbon;
use Illuminate\Http\Request;


class DashboardController extends Controller
{




    public function index(Request $request){

             $totalOutstanding = LoanSchedule::sum('amount');
             $principleOutstanding = LoanSchedule::sum('principle');
             $interestOut = LoanSchedule::sum('interest');
             $fully = LoanPayment::query()->where('status', '=','completed')->count();
             $open = LoanPayment::query()->where('status', '!=', 'completed')->count();
             $borrowers = Borrower::count('id');
             $denied =Loan::query()->where('status', '=', 'rejected')->count();
             $loans =Loan::query()->where('release_status', '=', 'approved')->count();

        $dataSchedule = LoanSchedule::query()->get();
        $groupedDataSchedule = $dataSchedule->groupBy(function($item) {
             Carbon::parse($item->due_date)->format('M');
        });

        $totalSchedule = $groupedDataSchedule->map(function($group) {
             $group->sum('amount');
        });

        return view ('dashboard',[
            'totalOutstanding' => $totalOutstanding,
            'principleOutstanding' => $principleOutstanding,
            'interestOut' => $interestOut,
            'fully' => $fully,
            'open' => $open,
            'loans' => $loans,
            'borrowers' => $borrowers,
            'denied' => $denied,
            'dueChart' => $totalSchedule,


        ]);
    }
}
