<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasCompanyTrait
{
    protected static function bootHasCompanyTrait()
    {
        static::addGlobalScope('company', function (Builder $builder) {
            if (auth()->check() && auth()->user()->com_id) {
                $builder->where('com_id', auth()->user()->com_id);
            }
        });
    }
}
