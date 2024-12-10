<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemsRequestDetail extends Model
{
    protected $guarded = [];
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function request()
    {
        return $this->belongsTo(RequestItem::class, 'request_id');
    }
}
