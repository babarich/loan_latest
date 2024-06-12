<?php

namespace App\Models\Loan;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanReturn extends Model
{
    use HasFactory;
    protected $fillable = ['loan_id', 'user_id', 'description', 'type', 'com_id'];



    public function user()  {
        return $this->belongsTo(User::class, 'user_id');
    }


}
