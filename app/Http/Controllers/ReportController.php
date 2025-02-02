<?php

namespace App\Http\Controllers;

use App\Exports\Loan\LoanGenderExport;
use App\Models\Account\ChartOfAccount;
use App\Models\Account\JournalEntry;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class ReportController extends Controller
{
    
  
public function balance(Request $request)
{
    
    $company = Company::query()->where('id', Auth::user()->com_id)->first();

   
    $fromDate = $request->input('from_date', Carbon::now()->startOfDay()->toDateString());
    $toDate = $request->input('to_date', Carbon::now()->endOfDay()->toDateString());

   
    $assets = $this->getAccountTotalByType(5, $company->id, $fromDate, $toDate);
    $liabilities = $this->getAccountTotalByType(6, $company->id, $fromDate, $toDate);
    $equity = $this->getAccountTotalByType(7, $company->id, $fromDate, $toDate);

   
    $totalAssets = $assets->sum('balance');
    $totalLiabilities = $liabilities->sum('balance');
    $totalEquity = $equity->sum('balance');

   
    return view('reports.balance', compact(
        'assets',
        'liabilities',
        'equity',
        'totalAssets',
        'totalLiabilities',
        'totalEquity',
        'company',
        'fromDate',
        'toDate'
    ));
}

private function getAccountTotalByType($type, $companyId, $fromDate, $toDate)
{
    return ChartOfAccount::where('financial_category_id', $type)
        ->with(['journalEntries' => function ($query) use ($fromDate, $toDate) {
            $query->whereBetween('created_at', [$fromDate, $toDate]);
        }])
        ->where('com_id', $companyId)
        ->get()
        ->map(function ($account) {
            $debit = $account->journalEntries->sum('debit');
            $credit = $account->journalEntries->sum('credit');
            $balance = str_contains($account->category->name, 'Asset') ? $debit - $credit : $credit - $debit;

            return (object) [
                'name' => $account->name,
                'balance' => $balance,
            ];
        });
}

   public function trial(Request $request)
{


      $fromDate = $request->input('from_date', Carbon::now()->startOfDay()->toDateString());
      $toDate = $request->input('to_date', Carbon::now()->endOfDay()->toDateString());

    $accounts = ChartOfAccount::query()
     ->with(['journalEntries' => function ($query) use ($fromDate, $toDate) {
            $query->whereBetween('created_at', [$fromDate, $toDate]);
        }])
    ->where('com_id', Auth::user()->com_id)
    ->get();

     $company = Company::query()->where('id', Auth::user()->com_id)->first();

       $trialBalance = $accounts->map(function ($account) {
        $debit = $account->journalEntries->sum('debit');
        $credit = $account->journalEntries->sum('credit');

        return [
            'account_name' => $account->name,
            'debit' => $debit,
            'credit' => $credit,
            
        ];
    });

    $totals = [
        'debit' => $trialBalance->sum('debit'),
        'credit' => $trialBalance->sum('credit'),
    ];

    return view('reports.trial', [
        'trialBalance' => $trialBalance,
        'totals' => $totals,
        'company' => $company,
        'fromDate' => $fromDate,
        'toDate' => $toDate
    ]);
}

        public function gender(Request $request){
            
            return view('reports.gender');
        }


        public function exportGender(Request $request){

            $id = Auth::user()->com_id;
               $quarter = request('quarter', Carbon::now()->quarter);
                $year = request('year', Carbon::now()->year);

             return Excel::download(new LoanGenderExport($quarter, $year, $id), 'quarterly_loans.xlsx');
            
        }
}
