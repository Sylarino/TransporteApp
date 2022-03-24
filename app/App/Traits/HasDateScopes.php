<?php

namespace App\App\Traits;

use Carbon\Carbon;

trait HasDateScopes
{
	public function scopeMonth($query,$field,$value)
	{
		return $query->whereMonth($field,$value);
	}

	public function scopeLastMonth($query,$field)
    {
        return $this->scopeMonth($query,$field,Carbon::now()->subMonth()->month);
    }

	public function scopeYear($query,$field,$value)
	{
		return $query->whereYear($field,$value);
	}

	public function scopeDay($query,$field,$value)
	{
		return $query->whereDay($field,$value);
	}

	public function scopeDate($query,$field,$value)
	{
		return $query->whereDate($field,$value);
	}

	public function scopeThisMonth($query,$field)
	{
		return $this->scopeMonth($query,$field,Carbon::now()->month);
	}

	public function scopeToday($query,$field)
	{
		return $this->scopeDay($query,$field,Carbon::now()->day);
	}

	public function scopeTomorrow($query,$field)
	{
		return $this->scopeDay($query,$field,Carbon::now()->addDay()->day);
	}

	public function scopeThisYear($query,$field)
	{
		return $this->scopeYear($query,$field,Carbon::now()->year);
	}

	public function scopeThisWeek($query,$field, $format = 'Y-m-d')
	{
		return $this->scopeBetween($query,$field,
			Carbon::now()->startOfWeek()->format($format),
			Carbon::now()->endOfWeek()->format($format)
		);
	}

	public function scopePastWeeks($query,$field,$weeks,$format = 'Y-m-d')
    {
        return $this->scopeBetween($query,$field,
            Carbon::now()->startOfWeek()->subWeeks($weeks)->format($format),
            Carbon::now()->endOfWeek()->subWeeks($weeks)->format($format)
        );
    }

	public function scopeLastWeek($query,$field, $format = 'Y-m-d')
	{
		return $this->scopeBetween($query,$field,
			Carbon::now()->startOfWeek()->subWeek()->format($format),
			Carbon::now()->endOfWeek()->subWeek()->format($format)
		);
	}
	public function scopeBetween ($query,$field,$start,$end)
	{
		return $query->whereBetween($field,[$start,$end]);
	}
}
