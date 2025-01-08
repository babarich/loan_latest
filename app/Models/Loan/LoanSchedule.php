<?php

namespace App\Models\Loan;

use App\Models\Borrow\Borrower;
use App\Traits\FilterByDatesTrait;
use App\Traits\HasCompanyTrait;
use App\Traits\LoanUserTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanSchedule extends Model
{
    use HasFactory,FilterByDatesTrait,LoanUserTrait,HasCompanyTrait;

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



    public function scopeFilter($query ,$request){
     
        $query->when($request->filled('start_date') && $request->filled('due_date'), function($query) use ($request){
          $query->whereBetween('due_date', [$request->input('start_date'), $request->input('due_date')]);
        });

        $query->whereMonth('due_date', Carbon::now()->month)
            ->whereYear('due_date', Carbon::now()->year);

         $query->when($request->filled('start_date') && !$request->filled('due_date'), function($query) use ($request){
          $query->whereDate('due_date', $request->input('start_date'));
        });   

       $query->when(!$request->filled('start_date') && $request->filled('due_date'), function($query) use ($request){
          $query->whereDate('due_date', $request->input('due_date'));
        });
    }

    public function scopeCurrentMonth($query)
    {
        return $query->whereMonth('due_date', Carbon::now()->month)
            ->whereYear('due_date', Carbon::now()->year);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    
}
