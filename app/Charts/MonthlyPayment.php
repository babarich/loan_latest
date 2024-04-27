<?php

namespace App\Charts;

use App\Models\Loan\PaymentLoan;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class MonthlyPayment
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {

        $data = PaymentLoan::query()->get();
        $groupedData = $data->groupBy(function($item) {
            return Carbon::parse($item->payment_date)->format('M');
        });

        $totals = $groupedData->map(function($group) {
            return $group->sum('amount');
        });


        return $this->chart->areaChart()
            ->addData('Amount', $totals->values()->toArray())
            ->setXAxis($totals->keys()->toArray())
            ->setHeight(350);

    }
}
