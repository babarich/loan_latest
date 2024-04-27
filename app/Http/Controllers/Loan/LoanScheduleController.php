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



        $perPage = request('per_page',10);
        $sortField = request('sort_field','created_at');
        $sortDirection = request('sort_direction','desc');
        return Inertia::render('Schedule/index',[
            'filters' => FacadesRequest::all('search','date'),
            'schedules' => LoanSchedule::query()
                ->where('status', 'pending')
                ->orderBy($sortField, $sortDirection)
                ->filter(FacadesRequest::only('search','date'))
                ->paginate($perPage,['*'],'schedules')
                ->withQueryString()
                ->through(fn ($schedule) => [
                    'id' => $schedule->id,
                    'name' => isset($schedule->borrower) ? $schedule->borrower->first_name . ' ' . $schedule->borrower->last_name : null,
                    'product' => isset($schedule->loan->product) ? $schedule->loan->product->name : null,
                    'loan_id' => isset($schedule->loan) ? $schedule->loan->id : null,
                    'principal' =>$schedule->principle,
                    'interest' => $schedule->interest,
                    'due' => $schedule->amount,
                    'paid' => $schedule->interest_paid + $schedule->principle_paid,
                    'status' => $schedule->status
                ])

        ]);
    }


    public function outstanding(Request $request){
        $perPage = request('per_page',10);
        $sortField = request('sort_field','created_at');
        $sortDirection = request('sort_direction','desc');
        return Inertia::render('Schedule/outstanding',[
            'filters' => FacadesRequest::all('search'),
            'outs' => Loan::query()
                ->orderBy($sortField, $sortDirection)
                ->filter(FacadesRequest::only('search'))
                ->paginate($perPage,['*'],'outs')
                ->withQueryString()
                ->through(fn ($out) => [
                    'id' => $out->id,
                    'reference' => $out->reference,
                    'release' => $out->loan_release_date,
                    'maturity' => $out->maturity_date,
                    'name' => $out->borrower->first_name . ' ' . $out->borrower->last_name,
                    'principal' =>$out->principle_amount,
                    'paid' =>$out->schedules()->sum('principal_paid') ?? 0,
                    'balance' =>$out->schedules()->sum('principle') ?? 0,
                    'status' => $out->status
                ])

        ]);
    }



    public function maturity(Request $request){
        $perPage = request('per_page',10);
        $sortField = request('sort_field','created_at');
        $sortDirection = request('sort_direction','desc');
        return Inertia::render('Schedule/maturity',[
            'filters' => FacadesRequest::all('search'),
            'matures' => Loan::query()
                ->orderBy($sortField, $sortDirection)
                ->where('status', 'pending')
                ->where('maturity_date', '>=', Carbon::now())
                ->filter(FacadesRequest::only('search'))
                ->paginate($perPage,['*'],'matures')
                ->withQueryString()
                ->through(fn ($mature) => [
                    'id' => $mature->id,
                    'reference' => $mature->reference,
                    'release' => $mature->loan_release_date,
                    'maturity' => $mature->maturity_date,
                    'name' => $mature->borrower->first_name . ' ' . $mature->borrower->last_name,
                    'principal' =>$mature->principle_amount,
                    'paid' =>$mature->schedules()->sum('principal_paid') ?? 0,
                    'balance' =>$mature->schedules()->sum('principle') ?? 0,
                    'status' => $mature->status
                ])

        ]);
    }
}
