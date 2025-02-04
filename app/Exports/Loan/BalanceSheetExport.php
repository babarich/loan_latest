<?php

namespace App\Exports\Loan;

use App\Models\Account\ChartOfAccount;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BalanceSheetExport implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    protected $quarter;
    protected $year;

    protected $id;

    public function __construct($quarter, $year, $id)
    {
        $this->quarter = $quarter;
        $this->year = $year;
        $this->id = $id;
    }

    public function collection()
    {
        
        $startDate = Carbon::create($this->year, ($this->quarter * 3) - 2, 1)->startOfDay();
        $endDate = $startDate->copy()->endOfQuarter();

        $assets = $this->getAccountTotalByType(5, $this->id, $startDate, $endDate);
        $liabilities = $this->getAccountTotalByType(6, $this->id, $startDate, $endDate);
        $equity = $this->getAccountTotalByType(7, $this->id, $startDate, $endDate);

   
    $totalAssets = $assets->sum('balance');
    $totalLiabilities = $liabilities->sum('balance');
    $totalEquity = $equity->sum('balance');


    
    $data = [];

 
    $data[] = ['1', 'Total Assets', number_format($totalAssets, 2)];
    foreach ($assets as $index => $asset) {
        $data[] = ['', $asset->name, number_format($asset->balance, 2)];
    }

   
    $data[] = ['2', 'Total Liabilities', number_format($totalLiabilities, 2)];
    foreach ($liabilities as $index => $liability) {
        $data[] = ['', $liability->name, number_format($liability->balance, 2)];
    }

   
    $data[] = ['3', 'Total Equity', number_format($totalEquity, 2)];
    foreach ($equity as $index => $eq) {
        $data[] = ['', $eq->name, number_format($eq->balance, 2)];
    }

    return collect($data);
      
   
 
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

     public function headings(): array
    {
        return [
            ['NAME OF INSTITUTION: '],
            ['MSP CODE: '],
            ['LOANS DISBURSED DURING THE QUARTER ENDED: '.$this->getQuarterEndDate()],
            ['BOT Form MSP2-09 To be submitted Quarterly'],
            [],
            ['S/N', 'Particulars', 'Amount',]
            
        ];
    }


    public function title(): string
    {
        return 'Q'.$this->quarter.' Report';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            6 => ['font' => ['bold' => true]],
            7 => ['font' => ['bold' => true]],
        ];
    }

   

    private function getQuarterEndDate()
    {
        return Carbon::create($this->year, ($this->quarter * 3), 1)
            ->endOfQuarter()
            ->format('d/m/Y');
    }
}
