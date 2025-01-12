<?php

namespace App\Models\Account;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{


    use HasFactory,SoftDeletes, HasUuids;

    protected $table = 'expenses';

    protected $fillable = ['name','type', 'amount', 'expense_year', 'note', 'category_id', 'chart_id', 
    'ref_no', 'com_id', 'bank_account_id', 'payment_id', 'bank', 'mobile', 'uuid', 'user_id', 'date'];


    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function chart() {
        return $this->belongsTo(ChartOfAccount::class, 'chart_id', 'id');
    }


    public function uniqueIds()
    {
        return ['uuid'];
    }

    
      
}
