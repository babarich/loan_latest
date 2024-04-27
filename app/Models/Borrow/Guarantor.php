<?php

namespace App\Models\Borrow;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guarantor extends Model
{
    use HasFactory;

    protected $dates = [
        'date_birth'
    ];

    protected $table = 'guarantors';
    protected $fillable = ['reference','first_name', 'last_name', 'gender', 'title', 'mobile', 'email', 'date_birth', 'address', 'city',
        'working_status','business_name','filename', 'attachment_size', 'attachment', 'uploaded_by', 'status','description','balance', 'total_paid',
        'last-pay_date','approval_status', 'com_id'];



    public function user()
    {
        return $this->belongsTo(User::class,'uploaded_by', 'id');
    }


    public function attachments()
    {
        return $this->hasMany(GuarantorAttachment::class, 'guarantor_id', 'id');
    }

    public function getAgeAttribute()
    {
        return round(Carbon::parse($this->date_birth)->diffInYears(Carbon::now()));
    }

    public function scopeFilter($query , array $filters){
        $query->when($filters['search'] ?? null, function ($query, $search){
            $query->where('first_name', 'like', '%'.$search.'%')
                ->orWhere('last_name', 'like', '%'.$search.'%')
                ->orWhere('reference', 'like', '%'.$search.'%')
                ->orWhere('business', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%')
                ->orWhere('mobile', 'like', '%'.$search.'%');
        });
    }
}
