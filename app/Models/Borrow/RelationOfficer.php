<?php

namespace App\Models\Borrow;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationOfficer extends Model
{
    use HasFactory;

    protected $table = 'relation_officers';

    protected $fillable = ['group_id', 'user_id', 'description', 'created_by', 'status'];



    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
