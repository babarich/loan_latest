<?php

namespace App\Models\Borrow;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowerAttachment extends Model
{
    use HasFactory;

    protected $table = 'borrower_attachments';

    protected $fillable = ['borrower_id', 'filename', 'attachment_size', 'attachment','uploaded_by'];



}
