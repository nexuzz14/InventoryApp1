<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
class ItemLocation extends Pivot
{
    protected $table = 'item_location';
    protected $guarded = ['id']; 
    protected $fillable = ['item_id', 'location_id', 'quantity'];


    protected static function booted()
    {
        static::saved(function ($pivot) {
            // Panggil calculateQty setelah data pivot disimpan
            $item = $pivot->item;
            $item->calculateQty();
        });

        static::deleted(function ($pivot) {
            // Panggil calculateQty jika data pivot dihapus
            $item = $pivot->item;
            $item->calculateQty();
            $item->saveQuietly();
        });
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
