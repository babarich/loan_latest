<?php

namespace App\Models\Setting;

use App\Traits\HasCompanyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPayment extends Model
{
    use HasFactory,HasCompanyTrait;

    protected $table = 'company_payments';

    protected $fillable = ['payment_type', 'name', 'account', 'user_id', 'com_id'];


}
