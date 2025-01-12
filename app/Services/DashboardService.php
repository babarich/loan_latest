<?php

namespace App\Services;

use App\Models\Loan\Loan;
use App\Models\Loan\PaymentLoan;

class DashboardService
{



    public function getDashboard($user){
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


    public function getLoans($user){
        $data = Loan::query()->where('com_id', $user->com_id)->get();
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

}
