<?php

namespace App\Domain\Contact;

use App\Domain\Supplier\Supplier;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['first_name','last_name','phones','email','address'];

    public function supplier()
    {
        return $this->belongsToMany(Supplier::class,'supplier_contacts','contact_id','supplier_id')->withPivot('center_id');
    }
}
