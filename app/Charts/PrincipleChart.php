<?php

namespace App\Charts;

use App\Models\Loan\LoanSchedule;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class PrincipleChart
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
            return round($group->sum('principal_paid'),2);
        });


        return $this->chart->areaChart()
            ->addData('Principle Paid', $totals->values()->toArray())
            ->setXAxis($totals->keys()->toArray())
            ->setColors(['#259AE6', '#DC3545']);

    }
}
