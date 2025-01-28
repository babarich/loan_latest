<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Setting\CompanyPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();
        $transactions = CompanyPayment::query()
        ->where('com_id', $user->com_id)
        ->get();
        return view('settings.transaction.index', compact('transactions'));
    }

    public function indexCompany(Request $request)
    {
        $user = Auth::user();
        $company = Company::query()
        ->where('id', $user->com_id)
        ->first();

        return view('company.index', compact('company'));
    }



      public function editCompany(Request $request, $id)
    {
        $user = Auth::user();
        $company = Company::findOrFail($id);

        return view('company.edit', compact('company'));
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
                'open_balance' => $request->filled('balance') ? $request->input('balance') : null,
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
                'open_balance' => $request->filled('balance') ? $request->input('balance') : null,

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

        return view('settings.transaction.view',['transaction' =>$transaction]);
    }





    public function edit(Request $request, $id)
    {
        $transaction = CompanyPayment::findOrFail($id);
        return view('settings.transaction.edit',['transaction' => $transaction]);
    }


    public function delete(Request $request)
    {
        $id = $request->input('id');
        try {
            $comp = CompanyPayment::findOrFail($id);
            $comp->delete();

        }catch (\Exception $e){
            Log::info('error_borrow', [$e]);
            return  redirect()->back()->with('error', 'sorry something went wrong  try again');
        }
        return redirect()->back()->with('success','You have deleted successfully a payment loan');
    }



      public function updateCompany(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'address' => 'sometimes|string|max:255',
            'mobile' => 'sometimes|string|max:15',
            'website' => 'sometimes|url|max:255',
            'email' => 'sometimes|email|max:255',
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:4048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

       
        $company = Company::findOrFail($id);

        
        $company->name = $request->has('name') ? $request->name : $company->name;
        $company->address = $request->has('address') ? $request->address : $company->address;
        $company->phone_number = $request->has('mobile') ? $request->mobile : $company->mobile;
        $company->website = $request->has('website') ? $request->website : $company->website;
        $company->email = $request->has('email') ? $request->email : $company->email;

        if ($request->hasFile('photo')) {
            
            if ($company->photo && Storage::exists($company->photo)) {
                Storage::delete($company->photo);
            }

            $photoPath = $request->file('photo')->store('company_photos', 'public');
            $company->photo = $photoPath;
        }

       
        $company->save();


        return redirect()->route('company.setting')->with('success', 'Company updated successfully!');


    }
}
