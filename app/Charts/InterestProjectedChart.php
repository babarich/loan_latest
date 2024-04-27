<?php

namespace App\Charts;

use App\Models\Loan\LoanSchedule;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class InterestProjectedChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {


        $dataDue = LoanSchedule::query()->get();
        $groupedDataDue = $dataDue->groupBy(function($item) {

            return Carbon::parse($item->due_date)->format('M');
        });

        $totalDue = $groupedDataDue->map(function($group) {
            return $group->sum('interest');
        });
        return $this->chart->barChart()
            ->addData('Interest Due',  $totalDue->values()->toArray())
            ->setXAxis($totalDue->keys()->toArray())
            ->setColors( ['#DC3545']);

    }
}
