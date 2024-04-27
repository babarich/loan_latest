<?php

namespace App\Charts;

use App\Models\Loan\LoanSchedule;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class PrincipleDue
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
            return $group->sum('principal_paid');
        });


        $dataDue = LoanSchedule::query()->get();
        $groupedDataDue = $dataDue->groupBy(function($item) {

            return Carbon::parse($item->due_date)->format('M');
        });

        $totalDue = $groupedDataDue->map(function($group) {
            return $group->sum('principle');
        });
        return $this->chart->barChart()
            ->addData('Principle Paid', $totals->values()->toArray())
            ->addData('Principle Due', $totalDue->values()->toArray())
            ->setXAxis($totals->keys()->toArray())
            ->setColors(['#259AE6', '#DC3545']);

    }
}
