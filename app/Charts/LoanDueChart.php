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


        $dataSchedule = LoanSchedule::query()->get();
        $groupedDataSchedule = $dataSchedule->groupBy(function($item) {
            return Carbon::parse($item->due_date)->format('M');
        });

        $totalSchedule = $groupedDataSchedule->map(function($group) {
            return $group->sum('amount');
        });


        return $this->chart->barChart()
            ->addData('Due Amount', $totalSchedule->values()->toArray())
            ->setXAxis($totalSchedule->keys()->toArray())
            ->setHeight(350)
            ->setColors(['#DC3545']);

    }
}
