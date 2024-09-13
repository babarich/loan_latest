<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait LoanUserTrait
{
    public static function bootLoanUserTrait()
    {
        if (!app()->runningInConsole() && auth()->check()) {
            static::addGlobalScope('loan_trait', function (Builder $builder) {
                $userId = auth()->id();
                $user = User::find($userId);
                if($user && $user->hasRole('approver')){

                }elseif($user && $user->hasRole('admin')){

                 }else{
                    $builder->where(function($query) use ($user){
                        $query->where('user_id', $user->id);
                    });
                }
            });
        }
    }



}
