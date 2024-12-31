<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    

    protected static function booted()
    {
        static::deleting(function ($item) {
            $item->locations()->detach();
        });
       
    }

    public function calculateQty()
    {
        $totalQuantity = $this->locations()->sum('quantity');
        $this->quantity_gudang = $totalQuantity;
        $this->saveQuietly();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'item_sale')
                    ->withPivot('quantity', 'total')
                    ->withTimestamps();
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class, 'item_location')
            ->using(ItemLocation::class) // Gunakan model pivot
            ->withPivot('quantity', 'id', 'location_id'); // Sertakan kolom tambahan dari pivot
    }
}
