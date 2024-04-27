<?php

namespace App\Traits;

use Carbon\Carbon;

trait FilterByDatesTrait
{

    public function scopeToday($query, $column = 'created_at')
    {
        return $query->whereDate($column, Carbon::today());
    }

    public function scopeYesterday($query, $column = 'created_at')
    {
        return $query->whereDate($column, Carbon::yesterday());
    }
    public function scopeBeforeYesterday($query, $column = 'created_at')
    {
        return $query->whereDate($column, Carbon::yesterday()->subDays(1));
    }

    public function scopeMonth($query, $column = 'created_at')
    {
        return $query->whereBetween($column, [Carbon::now()->startOfMonth(), Carbon::now()]);
    }


    public function scopeQuarterToDate($query, $column = 'created_at')
    {
        $now = Carbon::now();
        return $query->whereBetween($column, [$now->startOfQuarter(), $now]);
    }

    public function scopeYearToDate($query, $column = 'created_at')
    {
        return $query->whereBetween($column, [Carbon::now()->startOfYear(), Carbon::now()]);
    }

    public function scopeLastWeek($query, $column = 'created_at')
    {
        return $query->whereBetween($column, [Carbon::today()->subDays(6), Carbon::now()]);
    }
    public function scopeWeek($query, $column = 'created_at')
    {
        return $query->whereBetween($column, [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
    }
    public function scopeBeforeLastWeek($query, $column = 'created_at')
    {
        return $query->whereBetween($column, [Carbon::today()->subDays(14)->startOfWeek(), Carbon::today()->subDays(14)->endOfWeek()]);
    }

    public function scopeLastMonth($query, $column = 'created_at')
    {
        return $query->whereBetween($column, [Carbon::today()->subDays(29), Carbon::now()]);
    }
    public function scopeBeforeLastMonth($query, $column = 'created_at')
    {
        return $query->whereBetween($column, [Carbon::today()->subDays(29)->startOfMonth(), Carbon::today()->subDays(29)->endOfMonth()]);
    }

    public function scopeLastQuarter($query, $column = 'created_at')
    {
        $now = Carbon::now();
        return $query->whereBetween($column, [$now->startOfQuarter()->subMonths(3), $now->startOfQuarter()]);
    }

    public function scopeLastYear($query, $column = 'created_at')
    {
        return $query->whereBetween($column, [Carbon::now()->subYear(), Carbon::now()]);
    }
    public function scopeYear($query, $column = 'created_at')
    {
        return $query->whereBetween($column, [Carbon::now()->year(), Carbon::now()]);
    }

}
