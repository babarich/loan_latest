<?php

namespace App\Models\Loan;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanDisbursement extends Model
{
    use HasFactory;


    protected $table = 'loan_disbursements';
    protected $fillable = ['loan_id','payment_method', 'payment_reference', 'payment_date', 'user_id', 'com_id', 'chart_id'];


}
