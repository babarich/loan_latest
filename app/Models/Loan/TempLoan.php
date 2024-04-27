<?php

namespace App\Models\Loan;

use App\Models\Borrow\Borrower;
use App\Models\Borrow\Guarantor;
use App\Models\Collateral\Collateral;
use App\Models\User;
use App\Traits\LoanFlowScope;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TempLoan extends Model
{
    use HasFactory,LoanFlowScope;

    protected $table = 'loans';

    protected $fillable = ['reference', 'loan_product', 'borrower_id', 'principle_amount', 'interest_method', 'interest_type', 'interest_percentage',
        'interest_duration', 'loan_duration', 'duration_type', 'payment_cycle', 'payment_number', 'interest_amount','total_interest', 'loan_release_date',
        'maturity_date', 'disbursed_by', 'description', 'status', 'release_status','guarantor_id', 'user_id','disbursement'];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }


    public function product()
    {
        return $this->belongsTo(Product::class, 'loan_product','id');
    }


    public function agreements(){
        return  $this->hasMany(LoanAttachment::class, 'loan_id')->where('type', 'agreement')->with('user');
    }



    public function files(){
        return  $this->hasMany(LoanAttachment::class, 'loan_id')->where('type', 'loan')->with('user');
    }



    public function guarantor()
    {
        return $this->belongsTo(Guarantor::class,'guarantor_id', 'id');
    }

    public function borrower()
    {
        return $this->belongsTo(Borrower::class, 'borrower_id', 'id');
    }




    public function schedules()
    {
        return  $this->hasMany(LoanSchedule::class, 'loan_id');
    }





    public function comments()
    {
        return  $this->hasMany(LoanComment::class, 'loan_id')->with('user');
    }
    public function collaterals()
    {
        return  $this->hasMany(Collateral::class, 'loan_id')->with('user');
    }

    public function scopeFilter($query , array $filters){
        $query->when($filters['search'] ?? null, function ($query, $search){
            $query->where('name', 'like', '%'.$search.'%');
        });
    }
}
