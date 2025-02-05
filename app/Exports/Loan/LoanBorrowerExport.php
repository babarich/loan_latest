<?php

namespace App\Exports\Loan;

use App\Models\Loan\Loan;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LoanBorrowerExport implements FromCollection, WithHeadings, WithTitle, WithStyles
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

       return Loan::with('borrower', 'product','schedules')
            ->whereBetween('loan_release_date', [$startDate, $endDate])
            ->where('status', 'disbursement')
             ->where('com_id', $this->id)
            ->get()
            ->groupBy('loan_product')
            ->map(function ($loans) {
                return [
                    'sector' => $loans->first()->product->name ?? 'Unknown',
                    'borrowers_count' => $loans->unique('borrower_id')->count(),
                    'total_outstanding' => $loans->first()->schedules->sum('amount'),
                    'total_current' => 0
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
            ['Sector', 'Number Of Borrowerss', 'Total Outstanding Amount' , 'Total Current Amount', ''],
            
        ];
    }


    public function title(): string
    {
        return 'Loan Borrower Q'.$this->quarter.' Report';
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
