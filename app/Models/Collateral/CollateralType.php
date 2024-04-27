<?php

namespace App\Models\Collateral;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollateralType extends Model
{
    use HasFactory;

    protected $table = 'collateral_types';

    protected $fillable = ['name','user_id', 'description', 'status'];


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }


    public function scopeFilter($query , array $filters){
        $query->when($filters['search'] ?? null, function ($query, $search){
            $query->where('name', 'like', '%'.$search.'%');
        });
    }
}
