<?php

namespace App\Services;

use App\Models\Loan\LoanSchedule;
use App\Models\Loan\PaymentLoan;
use Carbon\Carbon;

class ChartService
{


    public function getDataMonth()
    {

        $data = PaymentLoan::query()->get();
        $groupedData = $data->groupBy(function($item) {
            return $item->created_at->format('M');
        });

        $totals = $groupedData->map(function($group) {
            return $group->sum('amount');
        });

        $chartData = [
            'data' => $totals->values()->toArray(),
            'labels' => $totals->keys()->toArray(),

        ];
        return $chartData;
    }


    public function getMonthProjected()
    {

        $data = LoanSchedule::query()->get();
        $groupedData = $data->groupBy(function($item) {

            return Carbon::parse($item->due_date)->format('M');
        });

        $totals = $groupedData->map(function($group) {
            return $group->sum('amount');
        });

        $chartData = [
            'data' => $totals->values()->toArray(),
            'labels' => $totals->keys()->toArray(),

        ];
        return $chartData;
    }

    public function getInterest()
    {

        $data = LoanSchedule::query()->get();
        $groupedData = $data->groupBy(function($item) {

            return Carbon::parse($item->due_date)->format('M');
        });

        $totals = $groupedData->map(function($group) {
            return $group->sum('interest_paid');
        });

        $chartData = [
            'data' => $totals->values()->toArray(),
            'labels' => $totals->keys()->toArray(),

        ];
        return $chartData;
    }



    public function getProjectedInterest()
    {

        $data = LoanSchedule::query()->get();
        $groupedData = $data->groupBy(function($item) {

            return Carbon::parse($item->due_date)->format('M');
        });

        $totals = $groupedData->map(function($group) {
            return $group->sum('interest');
        });

        $chartData = [
            'data' => $totals->values()->toArray(),
            'labels' => $totals->keys()->toArray(),

        ];
        return $chartData;
    }



    public function getPrinciple()
    {

        $data = LoanSchedule::query()->get();
        $groupedData = $data->groupBy(function($item) {

            return Carbon::parse($item->due_date)->format('M');
        });

        $totals = $groupedData->map(function($group) {
            return $group->sum('principle_paid');
        });

        $chartData = [
            'data' => $totals->values()->toArray(),
            'labels' => $totals->keys()->toArray(),

        ];
        return $chartData;
    }



    public function getProjectedPrinciple()
    {

        $data = LoanSchedule::query()->get();
        $groupedData = $data->groupBy(function($item) {

            return Carbon::parse($item->due_date)->format('M');
        });

        $totals = $groupedData->map(function($group) {
            return $group->sum('principle');
        });

        $chartData = [
            'data' => $totals->values()->toArray(),
            'labels' => $totals->keys()->toArray(),

        ];
        return $chartData;
    }

}
