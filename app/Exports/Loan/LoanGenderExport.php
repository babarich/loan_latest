<?php

namespace App\Exports\Loan;

use App\Models\Loan\Loan;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LoanGenderExport implements  FromCollection, WithHeadings, WithTitle, WithStyles
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

       return Loan::with(['borrower', 'product'])
    ->whereBetween('loan_release_date', [$startDate, $endDate])
    ->where('status', 'disbursement')
    ->where('com_id', $this->id)
    ->get()
    ->groupBy(fn($loan) => $loan->product->name ?? 'Unknown') // Ensure proper grouping
    ->map(function ($loans, $sector) {
        $female = $loans->filter(fn($loan) => $loan->borrower->gender === 'female');
        $male = $loans->filter(fn($loan) => $loan->borrower->gender === 'male');

        return [
            'sector' => $sector, // Correctly set product name as sector
            'female_count' => $female->count(),
            'female_amount' => $female->sum('principle_amount'),
            'male_count' => $male->count(),
            'male_amount' => $male->sum('principle_amount'),
            'total_count' => $loans->count(),
            'total_amount' => $loans->sum('principle_amount')
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
            ['Sector', 'Loans Disbursed to Female', '', 'Loans Disbursed to Male', '', 'Total Loans Disbursed', ''],
            ['', 'Number', 'Amount', 'Number', 'Amount', 'Number (c+e)', 'Amount (d+f)']
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
