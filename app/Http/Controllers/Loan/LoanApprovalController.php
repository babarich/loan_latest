<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use App\Models\Collateral\CollateralType;
use App\Models\Loan\Loan;
use App\Models\Loan\LoanReturn;
use App\Models\Loan\TempLoan;
use App\Models\Setting\CompanyPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;
use function PHPUnit\Framework\returnValue;

class LoanApprovalController extends Controller
{



    public function index(){

        $loans = TempLoan::query()
            ->where('release_status', 'pending')
            ->where('stage', '>', 0)
            ->orderBy('created_at', 'desc')
            ->get();


        return view('approval.index', compact('loans'));
    }


    public function show(Request $request, $id){
        $types = CollateralType::query()->get();
        $transactions = CompanyPayment::query()->get();
        $loan = TempLoan::with(['schedules','user', 'borrower','guarantor','product','agreements',
            'collaterals', 'files','comments'])->findOrFail($id);
        return view('approval.view',['loan' =>$loan, 'types' => $types, 'transactions' => $transactions]);
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

            if($stage === 1){
                $loan->update(['stage' => 0, 'status' => 'approver returned']);
            }elseif ($stage === 2){
                $loan->update(['stage' => 1, 'status' => 'disbursement returned']);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error', [$e]);
            return  redirect()->back()->with('error', 'sorry something went wrong cannot create loan try again');
        }
        return redirect()->back()->with('success','You have returned successfully the loan');
    }


    public function approve(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $loan = Loan::findOrFail($id);
            $stage = $loan->stage;
            if($stage === 1){
                $loan->update(['stage' => 2, 'status' => 'approver approved']);
            }else{
                $loan->update(['stage' => 3, 'status' => 'disbursement', 'release_status' => 'approved']);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error', [$e]);
            return  redirect()->back()->with('error', 'sorry something went wrong cannot create loan try again');
        }
        return redirect()->route('approve.index')->with('success','You have  successfully approved the loan');
    }

    public function reject(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $loan = Loan::findOrFail($id);
            $stage = $loan->stage;
            if($stage === 1){
                $loan->update(['status' => 'approver rejected']);
            }else{
                $loan->update([ 'status' => 'disbursement rejected', 'release_status' => 'rejected']);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error', [$e]);
            return  redirect()->back()->with('error', 'sorry something went wrong cannot create loan try again');
        }
        return redirect()->route('approve.index')->with('success','You have rejected successfully  the loan');
    }

}
