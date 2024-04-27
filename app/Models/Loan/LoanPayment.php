<?php

namespace App\Models\Loan;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanPayment extends Model
{
    use HasFactory;

    protected $table = 'loan_payments';

    protected $fillable = ['loan_id', 'paid_amount', 'due_amount', 'total', 'status', 'user_id', 'com_id'];




    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
