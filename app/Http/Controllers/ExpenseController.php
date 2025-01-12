<?php

namespace App\Http\Controllers;

use App\Models\Account\ChartOfAccount;
use App\Models\Account\Expense;
use App\Models\Setting\CompanyPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ExpenseController extends Controller
{
    
    public function index(){
       
        $expenses = Expense::where('com_id', Auth::user()->com_id)->orderBy('id','DESC')->get();
    
         return view('expense.index', compact('expenses'));
    }

    public function create(Request $request){

        $charts = ChartOfAccount::query()->where('com_id', Auth::user()->com_id)->get();
        $payments = CompanyPayment::query()->where('com_id', Auth::user()->com_id)->get();

        return view('expense.create', compact('charts', 'payments'));
    }

     public function edit(Request $request, $expenseId){

        $charts = ChartOfAccount::query()->where('com_id', Auth::user()->com_id)->get();
        $payments = CompanyPayment::query()->where('com_id', Auth::user()->com_id)->get();

        return view('expense.edit', compact('charts', 'payments'));
    }

    public function show(Request $request, $expenseId){
        $expense = Expense::findOrFail($expenseId);

        return view('expense.view', compact('expense'));
    }


    public function store(Request $request){
        

        $payment = CompanyPayment::query()->where('id', 'payment_id')->first();
        try{
            DB::beginTransaction();

            $expense = new Expense();
            $expense->name = $request->input('name');
            $expense->date = $request->input('date');
            $expense->amount = $request->input('amount');
            $expense->note = $request->input('note');
            $expense->chart_id = $request->input('chart_id');
            $expense->ref_no = $request->input('ref_no');
            $expense->payment_id = $request->input('payment_id');
            $expense->user_id = Auth::id();
            $expense->com_id = Auth::user()->com_id;
            $expense->save();

            if($payment){
                $open = $payment->open_balance;
                if($open > 0){
                    $total = $open - $request->input('amount');
                    $payment->open_balance = $total;
                    $payment->save();
                }
            }

            DB::commit();
        }catch(\Exception $e){

            DB::rollBack();
            Log::info('error', [$e]);
            return redirect()->back()->with('error', 'Sorry Something went wrong');
        }

        return redirect()->route('expense.index')->with('success', 'You have added expense successfully');
    }


    public function update(Request $request){
        
    }


    
}
