<?php

namespace App\Services;

use App\Models\Loan\LoanSchedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CollectionService
{



    public function report()
    {

        $weekly = LoanSchedule::query()
                ->whereBetween('due_date', [Carbon::today()->subDays(7), Carbon::now()])
                ->select(DB::raw('extract(DOW from due_date) as week_name'),
                    DB::raw('SUM(amount) as amount'),
                   'loan_id',
                )
                ->groupBy('week_name','loan_id')
                ->orderBy('week_name')
                ->get();

        $data = [
          'Sun' => 0,
          'Mon' => 0,
          'Tue' => 0,
          'Wed' => 0,
          'Thu' => 0,
          'Fri' => 0,
          'Sat' => 0,
        ];

        $filterWeekly = collect($weekly);
        $filterWeekly->each(function ($week) use ($data) {
            $day = intval($week->week_name);
            $amount = $week->amount;
            $loanId = $week->loan_id;
            switch ($day) {
                case 0: $data['Sun'] = [$amount,$loanId];break;
                case 1: $data['Mon'] = [$amount,$loanId];break;
                case 2: $data['Tue'] = [$amount,$loanId];break;
                case 3: $data['Wed'] = [$amount,$loanId];break;
                case 4: $data['Thu'] = [$amount,$loanId];break;
                case 5: $data['Fri'] = [$amount,$loanId];break;
                case 6: $data['Sat'] = [$amount,$loanId];break;
            }
        });


        return $data;
    }

}
