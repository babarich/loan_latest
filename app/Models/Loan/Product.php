<?php

namespace App\Models\Loan;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['name', 'user_id', 'description', 'status', 'com_id'];



    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }




    public function scopeFilter($query , array $filters){
        $query->when($filters['search'] ?? null, function ($query, $search){
            $query->where('name', 'like', '%'.$search.'%');
        });
    }

}
