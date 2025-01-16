<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use App\Models\Collateral\CollateralType;
use App\Models\Loan\Loan;
use App\Models\Loan\LoanDisbursement;
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

        $user = Auth::user();
        $loans = TempLoan::query()
            ->where('release_status', 'pending')
            ->where('stage', '>', 0)
            ->where('com_id', $user->com_id)
            ->orderBy('created_at', 'desc')
            ->get();


        return view('approval.index', compact('loans'));
    }


    public function show(Request $request, $id){
        $user = Auth::user();
        $types = CollateralType::query()
        ->where('com_id', $user->com_id)
        ->get();
        $transactions = CompanyPayment::query()
        ->where('com_id', $user->com_id)
        ->get();
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
                'user_id' => Auth::id(),
                'com_id' => Auth::user()->com_id,
            
            ]);

            if($stage === 1){
                $loan->update(['stage' => 0, 'status' => 'approver returned', 'release_status' => 'rejected']);
            }elseif ($stage === 2){
                $loan->update(['stage' => 1, 'status' => 'disbursement returned','release_status' => 'rejected']);
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
    
        $payment = CompanyPayment::query()->where('id', $request->input('payment_method'))->first();
        try {
            DB::beginTransaction();
            $loan = Loan::findOrFail($id);
            $stage = $loan->stage;
            if($stage === 1){
                $loan->update(['stage' => 2, 'status' => 'approver approved']);
            }else{
                $loan->update(['stage' => 3, 'status' => 'disbursement', 'release_status' => 'approved']);

                LoanDisbursement::create([
                    'loan_id' => $loan->id,
                    'payment_method' => $request->input('payment_method'),
                    'payment_reference' => $request->input('payment_reference'),
                    'payment_date' => $request->input('payment_date'),
                    'user_id' => Auth::id(),
                    'com_id' => Auth::user()->com_id,
                ]);

                if($payment){
                $open = $payment->open_balance;
                if($open > 0){
                    $total = $open - $loan->amount;
                    $payment->open_balance = $total;
                    $payment->save();
                }
            }   
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
                $loan->update(['status' => 'approver rejected', 'release_status' => 'rejected']);
            }else{
                $loan->update([ 'status' => 'disbursement rejected', 'release_status' => 'rejected']);
            }
            LoanReturn::create([
                'loan_id' => $loan->id,
                'type' => $stage,
                'description' => $request->input('comment'),
                'user_id' => Auth::id(),
                'com_id' => Auth::user()->com_id,
            ]);
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error', [$e]);
            return  redirect()->back()->with('error', 'sorry something went wrong cannot create loan try again');
        }
        return redirect()->route('approve.index')->with('success','You have rejected successfully  the loan');
    }

}
