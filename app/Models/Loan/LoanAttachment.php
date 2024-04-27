<?php

namespace App\Models\Loan;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanAttachment extends Model
{
    use HasFactory;

    protected $table = 'loan_attachments';

    protected $fillable = ['loan_id', 'name', 'filename', 'file', 'attachment_size', 'attachment', 'uploaded_by', 'type','com_id'];



    public  function user()
    {
        return $this->belongsTo(User::class,'uploaded_by');

    }
}
