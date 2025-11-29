<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    //supplier
    public function supplier()
    {
        return $this->belongsTo(Contact::class, 'supplier_id');
    }
}
