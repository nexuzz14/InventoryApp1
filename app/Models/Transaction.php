<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];
    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function requestItem()
    {
        return $this->belongsTo(RequestItem::class, 'request_id', 'id');
    }


    
}
