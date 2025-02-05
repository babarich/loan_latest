<?php

namespace App\Exports\Loan;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithProperties;

class LoanSheetExport implements WithMultipleSheets,WithProperties
{

    use Exportable;

     protected $quarter;
     protected $year;

     protected $id;

    public function __construct($quarter, $year, $id)
    {
        $this->quarter = $quarter;
        $this->year = $year;
        $this->id = $id;
    }


    public function sheets(): array
    {
        $sheets = [];
        $sheets['Loan Gender'] = new LoanGenderExport($this->quarter, $this->year, $this->id);
        $sheets['Balance Sheet'] = new BalanceSheetExport($this->quarter, $this->year, $this->id);
        $sheets['Borrowers Report'] = new LoanBorrowerExport($this->quarter, $this->year, $this->id);


        return $sheets;
    }



    /**
     * @return array
     */

     public function properties(): array
     {
        return [
           'creator' => Auth::user()->name,
           'lastModifiedBy' => Auth::user()->name,
           'title' => 'BOT Reports',
           'description' => 'BOT Reports',
           'subject' => 'Loan BOT Reports',

        ];
     }
}
