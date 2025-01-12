<?php

namespace App\Services;

use App\Models\Loan\Loan;
use App\Models\Loan\LoanSchedule;
use App\Models\Loan\PaymentLoan;
use Carbon\Carbon;

class ChartService
{


    public function getDataMonth($user)
    {



        $data = PaymentLoan::query()->where('com_id', $user->com_id)->get();
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


    public function getMonthProjected($user)
    {

        $data = LoanSchedule::query()->where('com_id', $user->com_id)->get();
        $groupedData = $data->groupBy(function($item) {

            return Carbon::parse($item->due_date)->format('M');
        });

        $totals = $groupedData->map(function($group) {
            return $group->sum('amount');
        });
        $chartData = $groupedData->map(function($monthlyPayments, $month) {
            return (object) [
                'month' => $month,
                'total' => $monthlyPayments->sum('amount'),
            ];
        })->values()->toArray();

        return $chartData;
    }



    public function getMonthLoan($user)
    {

        $data = Loan::query()->where('com_id', $user->com_id)->where('release_status','approved')->get();
        $groupedData = $data->groupBy(function($item) {
            return Carbon::parse($item->created_at)->format('M');
        });

        $totals = $groupedData->map(function($group) {
            return $group->count('id');
        });
        $chartData = $groupedData->map(function($monthlyPayments, $month) {
            return (object) [
                'month' => $month,
                'count' => $monthlyPayments->count('id'),
            ];
        })->values()->toArray();

        return $chartData;
    }

    public function getInterest($user)
    {

        $data = LoanSchedule::query()->where('com_id', $user->com_id)->get();
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



    public function getProjectedInterest($user)
    {

        $data = LoanSchedule::query()->where('com_id', $user->com_id)->get();
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



    public function getPrinciple($user)
    {

        $data = LoanSchedule::query()->where('com_id', $user->com_id)->get();
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



    public function getProjectedPrinciple($user)
    {

        $data = LoanSchedule::query()->where('com_id', $user->com_id)->get();
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
