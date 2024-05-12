<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait LoanFlowScope
{
    public static function bootLoanFlowScope()
    {
        if (!app()->runningInConsole() && auth()->check()) {
            static::addGlobalScope('loan_flow', function (Builder $builder) {
                $userId = auth()->id();
                $user = User::find($userId);

                if ($user) {
                    switch (true) {
                        case $user->hasRole('approver'):
                                $stage = 1;
                                break;
                        case $user->hasRole('disbursement'):
                            $stage = 2;
                            break;
                        default:
                            $stage = null;
                    }

                    if (!is_null($stage)) {
                        $builder->where('stage', $stage);
                    }
                }
            });
        }
    }



}
