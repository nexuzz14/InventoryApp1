<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class itemSale extends Model
{
    protected $guarded = [];

    protected $table = 'items_sales';
    protected $fillable = ['sale_id', 'item_id', 'quantity', 'total'];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    public function calculateTotal()
    {
        return $this->quantity * $this->item->price;
    }   
    
}
