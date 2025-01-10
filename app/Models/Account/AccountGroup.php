<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;

class AccountGroup extends Model
{
    protected $table = 'account_groups';
    protected $fillable = ['id', 'name', 'note','category_id', 'financial_category_id','com_id', 'user_id'];

    public function category() {
        return $this->belongsTo(FinancialCategory::class, 'financial_category_id', 'id')->withDefault(['name' => 'unknown']);
    }

}
