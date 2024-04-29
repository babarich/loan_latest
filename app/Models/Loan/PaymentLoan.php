<?php

namespace App\Models\Loan;

use App\Models\User;
use App\Traits\FilterByDatesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLoan extends Model
{
    use HasFactory,FilterByDatesTrait;
    protected $table = 'payment_loans';

    protected $fillable = ['loan_id', 'description', 'amount', 'payment_date', 'user_id', 'type','borrower_id', 'com_id', 'bank', 'mobile', 'reference'];


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }


    public function loan()
    {
        return $this->belongsTo(Loan::class, 'loan_id');
    }

    public function scopeFilter($query , array $filters){
        $query->when($filters['search'] ?? null, function ($query, $search){
            $query->where('amount', 'like', '%'.$search.'%')
            ->orWhere('type', 'like', '%'.$search.'%')
            ->orWhereDate('payment_date', 'like', '%'.$search.'%');

        });
    }
}
