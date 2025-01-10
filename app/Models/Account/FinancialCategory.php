<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;

class FinancialCategory extends Model
{
    

    protected $table = 'financial_categories';
    protected $fillable = ['id','name', 'create_date','financial_statement_id', 'note'];

   
    public function accountGroups() {
        return $this->hasMany(AccountGroup::class, 'financial_category_id', 'id');
    }

}
