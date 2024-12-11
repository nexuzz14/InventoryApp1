<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];
    public function customer()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function itemsRequest()
    {
        return $this->belongsTo(RequestItem::class, 'requests_id');
    }
}
