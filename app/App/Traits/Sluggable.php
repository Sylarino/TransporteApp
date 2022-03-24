<?php

namespace App\App\Traits;

trait Sluggable
{
    public function scopeBySlug($query,$slug)
    {
        return $query->where('slug',$slug);
    }

    public static function findBySlug($slug)
    {
        return static::where('slug',$slug)->first();
    }

    public static function slugExists($slug,$id)
    {
        return static::where('slug',$slug)->where('id','<>',$id)->first();
    }


}
