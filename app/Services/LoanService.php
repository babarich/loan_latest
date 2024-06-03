<?php

namespace App\Services;

use Carbon\Carbon;

class LoanService
{

    public function calculateMonthlyPayment($principal, $annualInterestRate, $term)
    {
        $monthlyInterestRate = $annualInterestRate / 12 / 100;
        $numberOfPayments = $term;

        return ($principal * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$numberOfPayments));
    }

    public function generateAmortizationSchedule($principal, $annualInterestRate, $term, $cycle, $loanDate)
    {
        $monthlyPayment = $this->calculateMonthlyPayment($principal, $annualInterestRate, $term);
        $monthlyInterestRate = $annualInterestRate /12 / 100;
        $balance = $principal;
        $schedule = [];
        $date = Carbon::parse($loanDate);
        for ($i = 0; $i < $term; $i++) {
            $interest = $balance * $monthlyInterestRate;
            $principalPayment = $monthlyPayment - $interest;
            $balance -= $principalPayment;
            if ($cycle === 'week'){
                $dueDate = $date->addDays(7)->format('Y-m-d');
                $startDate = Carbon::parse($dueDate)->subDays(7)->format('Y-m-d');
            }elseif ($cycle === 'day'){
                $dueDate = $date->addDays(1)->format('Y-m-d');
                $startDate = Carbon::parse($dueDate)->subDays(1)->format('Y-m-d');
            }else{
                $dueDate = $date->addDays(30)->format('Y-m-d');
                $startDate = Carbon::parse($dueDate)->subDays(30)->format('Y-m-d');
            }
            $schedule[] = [
                'start_date' => $startDate,
                'due_date' => $dueDate,
                'monthly_payment' => $monthlyPayment,
                'principal_payment' => $principalPayment,
                'interest_payment' => $interest,
                'balance' => $balance > 0 ? $balance : 0,
            ];
        }

        return $schedule;
    }
}
