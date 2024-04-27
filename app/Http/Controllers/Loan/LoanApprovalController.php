<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use App\Models\Collateral\CollateralType;
use App\Models\Loan\Loan;
use App\Models\Loan\LoanReturn;
use App\Models\Loan\TempLoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class LoanApprovalController extends Controller
{



    public function index(){
        $perPage = request('per_page',10);
        $sortField = request('sort_field','created_at');
        $sortDirection = request('sort_direction','desc');
        return Inertia::render('Approve/Index',[
            'filters' => FacadesRequest::all('search'),
            'loans' => TempLoan::query()
                ->where('release_status', 'pending')
                ->orderBy($sortField, $sortDirection)
                ->filter(FacadesRequest::only('search'))
                ->paginate($perPage,['*'],'groups')
                ->withQueryString()
                ->through(fn ($loan) => [
                    'id' => $loan->id,
                    'reference' => $loan->reference,
                    'name' => $loan->borrower->first_name . ' ' . $loan->borrower->last_name,
                    'principal' =>$loan->principle_amount,
                    'total_interest' => $loan->total_interest,
                    'interest' => isset($loan->interest_percentage) ? $loan->interest_percentage. ' '. '%' : $loan->interest_amount,
                    'type' => 'per'.' '.$loan->interest_duration,
                    'due'=>$loan->principle + $loan->total_interest,
                    'interest_type' => $loan->interest_method,
                    'user' =>$loan->user->name,
                    'stage' => $loan->stage,
                    'status' => $loan->status
                ])

        ]);
    }


    public function show(Request $request, $id){
        $types = CollateralType::query()->get();
        $loan = TempLoan::with(['schedules','user', 'borrower','guarantor','product','agreements',
            'collaterals', 'files','comments'])->findOrFail($id);
        return Inertia::render('Approve/View',['loan' =>$loan, 'types' => $types]);
    }


    public function return(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $loan = Loan::findOrFail($id);
            $stage = $loan->stage;
            LoanReturn::create([
                'loan_id' => $loan->id,
                'type' => $stage,
                'description' => $request->input('comment'),
                'user_id' => Auth::id()
            ]);

            if($stage === 0){
                $loan->update(['stage' => 0, 'status' => 'first approver returned']);
            }elseif ($stage === 1){
                $loan->update(['stage' => 0, 'status' => 'second approver returned']);
            }elseif ($stage === 2){
                $loan->update(['stage' => 1, 'status' => 'first disburser returned']);
            }else{
                $loan->update(['stage' => 2, 'status' => 'second disburser returned']);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create loan try again');
        }
        return Redirect::back()->with('success','You have returned successfully the loan');
    }


    public function approve(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $loan = Loan::findOrFail($id);
            $stage = $loan->stage;
            if($stage === 0){
                $loan->update(['stage' => 1, 'status' => 'first approver approved']);
            }elseif ($stage === 1){
                $loan->update(['stage' => 2, 'status' => 'second approver approved']);
            }elseif ($stage === 2){
                $loan->update(['stage' => 3, 'status' => 'first disburser approved']);
            }else{
                $loan->update(['stage' => 4, 'status' => 'second disburser approved', 'release_status' => 'approved']);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create loan try again');
        }
        return Redirect::route('approve.index')->with('success','You have returned successfully approved the loan');
    }

    public function reject(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $loan = Loan::findOrFail($id);
            $stage = $loan->stage;
            if($stage === 0){
                $loan->update(['status' => 'first approver rejected']);
            }elseif ($stage === 1){
                $loan->update(['status' => 'second approver rejected']);
            }elseif ($stage === 2){
                $loan->update(['status' => 'first disburser rejected']);
            }else{
                $loan->update([ 'status' => 'second disburser rejected', 'release_status' => 'rejected']);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create loan try again');
        }
        return Redirect::route('approve.index')->with('success','You have rejected successfully approved the loan');
    }

}
