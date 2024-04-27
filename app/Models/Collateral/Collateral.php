<?php

namespace App\Models\Collateral;

use App\Models\Loan\Loan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collateral extends Model
{
    use HasFactory;


    protected $casts = [
      'date' => 'datetime:Y-m-d'
    ];

    protected $table = 'collaterals';

    protected $fillable = ['loan_id','type_id', 'name', 'product_name', 'amount', 'date', 'condition', 'description', 'attachment','filename', 'attachment_size', 'user_id'];


    public function loan(){
        return $this->belongsTo(Loan::class, 'loan_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }



    public function type(){
        return $this->belongsTo(CollateralType::class, 'type_id');
    }


    public function scopeFilter($query , array $filters){
        $query->when($filters['search'] ?? null, function ($query, $search){
            $query->where('product_name', 'like', '%'.$search.'%');
        });
    }
}
