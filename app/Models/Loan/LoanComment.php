<?php

namespace App\Models\Loan;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanComment extends Model
{
    use HasFactory;


    protected $casts = [
        'created_at' => 'datetime:yyyy-m-d'
    ];

    protected $table = 'loan_comments';

    protected $fillable = ['loan_id', 'description', 'user_id', 'com_id'];


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

   public function loan(){
        return $this->belongsTo(Loan::class, 'loan_id', 'id');
   }

}
