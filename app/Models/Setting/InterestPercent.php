<?php

namespace App\Models\Setting;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterestPercent extends Model
{
    use HasFactory;

    protected $table = 'interest_percents';

    protected $fillable = ['name', 'percent', 'status','user', 'com_id'];




    public function user(){
        return $this->belongsTo(User::class, 'user', 'id');
    }


}
