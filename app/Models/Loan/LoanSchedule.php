<?php

namespace App\Models\Loan;

use App\Models\Borrow\Borrower;
use App\Traits\FilterByDatesTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanSchedule extends Model
{
    use HasFactory,FilterByDatesTrait;

    protected $table = 'loan_schedules';



    protected  $casts = [
        'due_date' => "datetime:Y-m-d",
        'start_date' => "datetime:Y-m-d",
    ];

    protected $fillable = ['loan_id', 'borrower_id', 'due_date', 'amount', 'status','user_id', 'paid','principle', 'interest', 'penalty',
        'fees', 'interest_paid', 'principal_paid', 'com_id', 'start_date'];


    public function loan()
    {

        return $this->belongsTo(Loan::class, 'loan_id');
    }


    public function borrower()
    {

        return $this->belongsTo(Borrower::class, 'borrower_id');
    }

    protected function dueDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('Y-m-d')
        );
    }



    public function scopeFilter($query , array $filters){
        $query->when($filters['search'] ?? null, function ($query, $search){
            $query->where('name', 'like', '%'.$search.'%');
        })->when($filters['date'] ?? null, function ($query, $date){
            $query->whereDate('due_date', '=', $date);
        });
    }


}
