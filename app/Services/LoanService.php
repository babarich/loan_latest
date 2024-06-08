<?php

namespace App\Services;

use Carbon\Carbon;

class LoanService
{

    public function calculateMonthlyPayment($principal, $annualInterestRate, $term)
    {
        $years = 1;
        $annualRate = $annualInterestRate * $term;
        $ratePeriod =  $annualRate /100;
        $ratePerPeriod = $ratePeriod / $term;
        $numberOfPayments = $term * $years;

        $emi = $principal * $ratePerPeriod * pow(1 + $ratePerPeriod, $numberOfPayments)/(pow(1 + $ratePerPeriod, $numberOfPayments)-1);

        return $emi;

    }

    public function generateAmortizationSchedule($principal, $annualInterestRate, $term, $cycle, $loanDate)
    {
        $monthlyPayment = $this->calculateMonthlyPayment($principal, $annualInterestRate, $term);
        $annualRate = $annualInterestRate * $term;
        $ratePeriod =  $annualRate /100;
        $ratePerPeriod = $ratePeriod / $term;
              
        $monthlyInterestRate = $ratePerPeriod;
        $balance = $principal;
        $schedule = [];
        $date = Carbon::parse($loanDate);
        $totalInterest = 0;
        for ($i = 0; $i < $term; $i++) {
            $interest = $balance * $monthlyInterestRate;
            $principalPayment = $monthlyPayment - $interest;
            $balance -= $principalPayment;
            $totalInterest += $interest;
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
                'total_interest' => $totalInterest,
            ];
        }

        return $schedule;
    }


    public function calculateTotalInterest($principle, $percent, $duration, $type,$method)
    { 
        
        
        $term = $this->convertTerm($duration, $type, $method);
        $annualRate = $percent * $term;
        $ratePeriod =  $annualRate /100;
        $ratePerPeriod = $ratePeriod / $term;
              
        $monthlyInterestRate = $ratePerPeriod;
        $monthlyPayment = ($principle * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$term));

        $totalInterest = 0;
        $balance = $principle;

        for ($i = 0; $i < $term; $i++) {
            $interest = $balance * $monthlyInterestRate;
            $principalPayment = $monthlyPayment - $interest;
            $balance -= $principalPayment;

            $totalInterest += $interest;
        }

        return $totalInterest;
    }

    private function convertTerm($duration, $type, $method)
    {

        switch ($type) {
            case 'day':
                if ($method === 'day'){
                    return $duration;
                }elseif ($method === 'week'){
                    return $duration/7;
                }else{
                    return $duration/30;
                }
            case 'week':
                if ($method === 'day'){
                    return $duration * 7;
                }elseif ($method === 'week'){
                    return $duration;
                }else{
                    return $duration /4;
                }
            case 'month':
                if ($method === 'day'){
                    return $duration * 30;
                }elseif ($method === 'week'){
                    return $duration * 4;
                }else{
                    return $duration;
                }
            case 'year':
                if ($method === 'day'){
                    return $duration * 360;
                }elseif ($method === 'week'){
                    return $duration * 52;
                }else{
                    return $duration * 12;
                }
            default:
                return $duration;
        }
    }

}
