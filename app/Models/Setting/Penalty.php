<?php

namespace App\Models\Setting;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    use HasFactory;


    protected $table = 'penalties';

    protected $fillable = ['name', 'percent','period','user','com_id'];




    public function user(){
        return $this->belongsTo(User::class, 'user', 'id');
    }

}
