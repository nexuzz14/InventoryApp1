<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemSalesLocation extends Model
{
    protected $table = "items_sales_location";
    public $timestamps = false;

    protected $fillable = [
        'item_sales_id',
        'location_id',
        'quantity'
    ];
    public function locations()
    {
        return $this->hasMany(ItemSalesLocation::class, 'item_sales_id');
    }
}
