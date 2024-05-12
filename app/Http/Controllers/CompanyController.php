<?php

namespace App\Http\Controllers;

use App\Models\Setting\CompanyPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{

    public function index(Request $request)
    {

        $transactions = CompanyPayment::query()->get();
        return view('settings.transaction.index', compact('transactions'));
    }

    public function create(Request $request)
    {
        return view('settings.transaction.create');
    }



    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'account' => 'required',
            'payment_type' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $type = CompanyPayment::create([
                'name' => $request->filled('name') ? $request->input('name') : null,
                'account' => $request->filled('account') ? $request->input('account') : null,
                'payment_type' => $request->filled('payment_type') ? $request->input('payment_type') : null,
                'user_id' => Auth::id(),
                'com_id' => Auth::user()->com_id,

            ]);

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_interest', [$e]);
            return  redirect()->back()->with('error', 'sorry something went wrong cannot create borrower try again');
        }

        return redirect()->route('company.index')->with('success','You have added successfully a new interest');
    }


    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'payment_type' => 'required',
            'account' => 'required'
        ]);
        $company = CompanyPayment::findOrFail($id);
        try {
            DB::beginTransaction();
            $company->update([
                'name' => $request->filled('name') ? $request->input('name') : null,
                'account' => $request->filled('account') ? $request->input('account') : null,
                'payment_type' => $request->filled('payment_type') ? $request->input('payment_type') : null,

            ]);
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_borrow', [$e]);
            return  redirect()->back()->with('error', 'sorry something went wrong cannot create borrower try again');
        }

        return redirect()->route('company.index')->with('success','You have updated successfully your collateral type');
    }

    public function show(Request $request, $id)
    {
        $transaction = CompanyPayment::with('user')->findOrFail($id);

        return view('settings.transaction.view',['$transaction' =>$transaction]);
    }





    public function edit(Request $request, $id)
    {
        $transaction = CompanyPayment::with('user')->findOrFail($id);
        return view('settings.transaction.edit',['transaction' => $transaction]);
    }


}
