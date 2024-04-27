<?php

namespace App\Charts;

use App\Models\Loan\Loan;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class LoanMonthly
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {


        $data = Loan::query()->get();
        $groupedData = $data->groupBy(function($item) {
            return $item->created_at->format('M');
        });

        $totals = $groupedData->map(function($group) {
            return $group->sum('amount');
        });


        return  $this->chart->areaChart()
            ->addData('Amount', $totals->values()->toArray())
            ->setXAxis($totals->keys()->toArray())
            ->setHeight(350);

    }
}
