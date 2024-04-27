<?php

namespace App\Charts;

use App\Models\Loan\Loan;
use App\Models\Loan\LoanSchedule;
use App\Models\Loan\PaymentLoan;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class LoanDueChart
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


        $dataSchedule = LoanSchedule::query()->get();
        $groupedDataSchedule = $dataSchedule->groupBy(function($item) {
            return Carbon::parse($item->due_date)->format('M');
        });

        $totalSchedule = $groupedDataSchedule->map(function($group) {
            return $group->sum('amount');
        });

        $totalLabel = array_merge($totals->keys()->toArray(),$totalSchedule->keys()->toArray());

        return $this->chart->areaChart()
            ->addData('Collected Amount', $totals->values()->toArray())
            ->addData('Due Amount', $totalSchedule->values()->toArray())
            ->setXAxis($totalLabel)
            ->setHeight(350)
            ->setColors(['#259AE6', '#DC3545']);

    }
}
