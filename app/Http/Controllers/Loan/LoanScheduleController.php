<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use App\Models\Loan\Loan;
use App\Models\Loan\LoanSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class LoanScheduleController extends Controller
{


    public function index(Request $request){

             $amountDueSums = LoanSchedule::query()
    ->select('borrower_id', DB::raw('SUM(amount) as total_amount_due'))
    ->where('status', 'pending')
    ->groupBy('borrower_id');


$schedules = LoanSchedule::query()
    ->joinSub($amountDueSums, 'amount_due_sums', function ($join) {
        $join->on('loan_schedules.borrower_id', '=', 'amount_due_sums.borrower_id');
    })
    ->where('loan_schedules.status', 'pending')
    ->orderBy('loan_schedules.updated_at', 'desc')
    ->get(['loan_schedules.*', 'amount_due_sums.total_amount_due']);

        return view('schedule.index', compact('schedules'));
    }





    public function maturity(Request $request){

        $matures = Loan::query()
            ->where('status', 'pending')
            ->where('maturity_date', '>=', Carbon::now())
            ->get();

        return view('schedule.maturity', compact('matures'));
    }



    public function closed(Request $request)
    {

    }



    public function update(Request $request)
    {
        $schedules = $request->input('schedules');
        foreach ($schedules as $schedule) {
            $loanSchedule = LoanSchedule::find($schedule['id']);
            if ($loanSchedule) {
                $loanSchedule->start_date = $schedule['start_date'];
                $loanSchedule->due_date = $schedule['due_date'];
                $loanSchedule->principle = $schedule['principle'];
                $loanSchedule->interest = $schedule['interest'];
                $loanSchedule->penalty = $schedule['penalty'];
                $loanSchedule->fees = $schedule['fees'];
                $loanSchedule->interest_paid = $schedule['interest_paid'];
                $loanSchedule->principal_paid = $schedule['principal_paid'];
                $loanSchedule->amount = $schedule['amount'];
                $loanSchedule->status = $schedule['status'];
                $loanSchedule->save();
            }
        }
    }
}
