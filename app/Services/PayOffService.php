<?php

namespace App\Services;

use App\Models\Loan\LoanPayment;
use App\Models\Loan\LoanSchedule;
use App\Models\Loan\PaymentLoan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class PayOffService
{



    public function makePayment($amount, $borrowerId)
    {


        $loanSchedules = LoanSchedule::query()->where('borrower_id', $borrowerId)->get();
        $paymentAmount = $amount;
        try {
            DB::beginTransaction();
            if ($loanSchedules){
                foreach ($loanSchedules as $loanSchedule){
                    $payment = LoanPayment::query()->where('loan_id', $loanSchedule->loan_id)->first();
                    $remainingAmountDue = $loanSchedule->interest + $loanSchedule->principle;
                    if ($paymentAmount >= $remainingAmountDue && $remainingAmountDue > 0) {
                        $loanSchedule->paid = true;
                        $loanSchedule->status = 'completed';
                        $paidInterest = min($paymentAmount, $loanSchedule->interest);
                        $loanSchedule->interest_paid = $paidInterest;
                        $loanSchedule->interest -= $paidInterest;
                        $paymentAmount -= $paidInterest;
                        $paidPrincipal = min($paymentAmount, $loanSchedule->principle);
                        $loanSchedule->principal_paid = $paidPrincipal;
                        $loanSchedule->principle -= $paidPrincipal;
                        $paymentAmount -= $paidPrincipal;
                        $loanSchedule->amount -= $paidPrincipal + $paidInterest;
                        $loanSchedule->save();
                        $total = $payment->paid_amount + $amount;
                        if ($payment->due_Amount > 0 && $payment->due_amount > $amount){
                            $due = $payment->due_amount - $amount;
                        }else{
                            $due = 0;
                        }
                        $payment->update(['paid_amount' => $total, 'due_amount' => $due]);
                    } else if ($paymentAmount < $remainingAmountDue && $remainingAmountDue > 0) {
                        $paidInterest = min($paymentAmount, $loanSchedule->interest);
                        $loanSchedule->interest_paid = $paidInterest;
                        $loanSchedule->interest -= $paidInterest;
                        $paymentAmount -= $paidInterest;
                        // Paying principal
                        $principalToPay = min($paymentAmount, $loanSchedule->principle);
                        $loanSchedule->principal_paid = $principalToPay;
                        $paymentAmount -= $principalToPay;
                        $loanSchedule->principle -= $principalToPay;

                        // Update schedule properties
                        $loanSchedule->paid = false;
                        $loanSchedule->status = 'partial';
                        $loanSchedule->amount -= ($loanSchedule->interest_paid + $loanSchedule->principal_paid);
                        $loanSchedules->save();

                        // Update payment properties
                        $totalPaid = $payment->paid_amount + $paymentAmount;
                        $dueAmount = max(0, $payment->due_amount - $paymentAmount);
                        $payment->update(['paid_amount' => $totalPaid, 'due_amount' => $dueAmount]);
                    }

                    PaymentLoan::create([
                        'loan_id' => $loanSchedule->loan_id,
                        'borrower_id' => $loanSchedules->borrower_id,
                        'description' => 'Pay off amount',
                        'payment_date' => Carbon::now(),
                        'amount' => $paymentAmount,
                        'type' => 'Pay Off',
                        'user_id' => Auth::id()
                    ]);
                }

            }


            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_payment', [$e]);

        }


    }

}
