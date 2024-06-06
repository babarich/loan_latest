<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use App\Models\Loan\Loan;
use App\Models\Loan\LoanSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class LoanScheduleController extends Controller
{


    public function index(Request $request){

        $schedules = LoanSchedule::query()
            ->where('status', 'pending')
            ->orderBy('updated_at', 'desc')
            ->get();

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
