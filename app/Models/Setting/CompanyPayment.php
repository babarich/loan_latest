<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPayment extends Model
{
    use HasFactory;

    protected $table = 'company_payments';

    protected $fillable = ['payment_type', 'name', 'account', 'user_id', 'com_id'];


}
