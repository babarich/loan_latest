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
                        case $user->hasRole('first-approver'):
                            $stage = 0;
                            break;
                        case $user->hasRole('second-approver'):
                                $stage = 1;
                                break;
                        case $user->hasRole('first-disburser'):
                            $stage = 2;
                            break;
                        case $user->hasRole('second-disburser'):
                            $stage = 3;
                            break;
                        default:
                            $stage = null;
                    }

                    if (!is_null($stage)) {
                        $builder->where('stage', $stage);
                    } else {
                        $builder->where('user_id', $userId);
                    }
                }
            });
        }
    }



}
