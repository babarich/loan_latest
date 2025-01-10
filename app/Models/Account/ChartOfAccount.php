<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;

class ChartOfAccount extends Model
{
     protected $table = 'chart_of_accounts';
    protected $fillable = ['id', 'name', 'create_date', 'financial_category_id', 'note', 'status', 'code', 'open_balance','com_id', 'account_group_id','chart_no'];


    public function category() {
        return $this->belongsTo(FinancialCategory::class, 'financial_category_id', 'id');
    }

    public function group() {
        return $this->belongsTo(AccountGroup::class, 'account_group_id', 'id');
    }

   
}
