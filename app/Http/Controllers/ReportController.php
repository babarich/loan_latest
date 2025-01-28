<?php

namespace App\Http\Controllers;

use App\Models\Account\ChartOfAccount;
use App\Models\Account\JournalEntry;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    
    public function balance(Request $request){
      
        $assets = $this->getAccountTotalByType(5);
        $liabilities = $this->getAccountTotalByType(6);
        $equity = $this->getAccountTotalByType(7);

        $totalAssets = $assets->sum('balance');
        $totalLiabilities = $liabilities->sum('balance');
        $totalEquity = $equity->sum('balance');

        $company = Company::query()->where('id', Auth::user()->com_id)->first();

     
    

        // $sheets = DB::table('journal_entries')
        //     ->join('chart_of_accounts', 'journal_entries.chart_of_account_id', '=', 'chart_of_accounts.id')
        //     ->select('chart_of_accounts.name', 'chart_of_accounts.financial_category_id', 
        //             DB::raw('SUM(journal_entries.debit) as total_debit'), 
        //             DB::raw('SUM(journal_entries.credit) as total_credit'))
        //     ->groupBy('chart_of_accounts.name', 'chart_of_accounts.financial_category_id')
        //     ->get();


            return view('reports.balance', compact('assets', 
            'liabilities', 'equity', 'totalAssets', 'totalLiabilities', 'totalEquity','company'));

    }

     private function getAccountTotalByType($type)
    {
        return ChartOfAccount::where('financial_category_id', $type)
            ->with(['journalEntries'])
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
    $accounts = ChartOfAccount::with(['journalEntries'])->get();

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
        'company' => $company
    ]);
}

}
