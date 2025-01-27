<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{

    use HasFactory,HasUuids;

    protected $table = 'journal_entries';

    protected $fillable = ['chart_of_account_id', 'debit', 'credit', 'reference', 'com_id'];




    public function chart(){
        return $this->belongsTo(ChartOfAccount::class, 'chart_of_account_id', 'id');
    }

      public function uniqueIds()
    {
        return ['uuid'];
    }


}
