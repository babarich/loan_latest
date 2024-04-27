<?php

namespace App\Models\Borrow;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuarantorAttachment extends Model
{
    use HasFactory;

    protected $table = 'guarantor_attachments';

    protected $fillable = ['guarantor_id', 'filename', 'attachment_size', 'attachment','uploaded_by'];


}
