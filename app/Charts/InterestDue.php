<?php

namespace App\Charts;

use App\Models\Loan\LoanSchedule;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class InterestDue
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {

        $data = LoanSchedule::query()->get();
        $groupedData = $data->groupBy(function($item) {

            return Carbon::parse($item->due_date)->format('M');
        });

        $totals = $groupedData->map(function($group) {
            return round($group->sum('interest_paid'),2);
        });



        $dataDue = LoanSchedule::query()->get();
        $groupedDataDue = $dataDue->groupBy(function($item) {

            return Carbon::parse($item->due_date)->format('M');
        });

        $totalDue = $groupedDataDue->map(function($group) {
            return $group->sum('interest');
        });
        return $this->chart->barChart()
            ->addData('Interest Paid', $totals->values()->toArray())
            ->addData('Interest Due',  $totalDue->values()->toArray())
            ->setXAxis($totals->keys()->toArray())
            ->setColors(['#259AE6', '#DC3545']);

    }
}
