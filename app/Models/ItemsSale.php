<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemsSale extends Model
{
    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function sales()
    {
        return $this->belongsTo(Sales::class, 'sales_id');
    }
}
