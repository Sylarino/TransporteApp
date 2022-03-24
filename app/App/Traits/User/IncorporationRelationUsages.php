<?php

namespace App\App\Traits\User;

use App\App\Traits\HasDateScopes;
use App\Domain\Contract\Incorporation\Incorporation;

trait IncorporationRelationUsages
{
    public function completed_incorporations()
    {
        return $this->incorporations()->whereNotNull('incorporations.completed_at');
    }

    public function pending_incorporations()
    {
        return $this->incorporations()->where('incorporations.is_pending',1);
    }

    public function rejected_incorporations()
    {
        return $this->incorporations()->whereNotNull('incorporations.rejected_at');
    }
    // THIS WEEK
    public static function thisWeekIncorporations()
    {
        return [
            'incorporations as this_week_incorporations' => function($q){
                $q->thisWeek('created_at');
            },
            'completed_incorporations as this_week_completed_incorporations'=> function($q){
                $q->thisWeek('completed_at');
            },
            'pending_incorporations as this_week_pending_incorporations' => function($q){
                $q->thisWeek('received_at');
            },
            'rejected_incorporations as this_week_rejected_incorporations' => function($q){
                $q->thisWeek('rejected_at');
            },
        ];
    }
    //lastWeek
    public static function lastWeekIncorporations()
    {
        return [
            'incorporations as last_week_incorporations' => function($q){
                $q->lastWeek('created_at');
            },
            'completed_incorporations as last_week_completed_incorporations'=> function($q){
                $q->lastWeek('completed_at');
            },
            'pending_incorporations as last_week_pending_incorporations' => function($q){
                $q->lastWeek('received_at');
            },
            'rejected_incorporations as last_week_rejected_incorporations' => function($q){
                $q->lastWeek('rejected_at');
            },
        ];
    }
    //thisMonth
    public static function thisMonthIncorporations()
    {
        return [
            'incorporations as this_month_incorporations' => function($q){
                $q->thisMonth('created_at');
            },
            'completed_incorporations as this_month_completed_incorporations'=> function($q){
                $q->thisMonth('completed_at');
            },
            'pending_incorporations as this_month_pending_incorporations' => function($q){
                $q->thisMonth('received_at');
            },
            'rejected_incorporations as this_month_rejected_incorporations' => function($q){
                $q->thisMonth('rejected_at');
            },
        ];
    }
    //thisMonth
    public static function lastMonthIncorporations()
    {
        return [
            'incorporations as last_month_incorporations' => function($q){
                $q->lastMonth('created_at');
            },
            'completed_incorporations as last_month_completed_incorporations'=> function($q){
                $q->lastMonth('completed_at');
            },
            'pending_incorporations as last_month_pending_incorporations' => function($q){
                $q->lastMonth('received_at');
            },
            'rejected_incorporations as last_month_rejected_incorporations' => function($q){
                $q->lastMonth('rejected_at');
            },
        ];
    }
}
