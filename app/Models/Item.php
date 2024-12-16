<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class Item extends Model
{
    protected $table = 'items';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function calculateQty()
    {
        $totalQuantity = $this->locations()->sum('quantity');
        $this->update([
            'quantity' => $totalQuantity,
            'status' => $totalQuantity > 0 ? 'tersedia' : 'tidak tersedia',
        ]);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    
    public function locations()
    {
        return $this->belongsToMany(Location::class, 'item_location')
            ->using(ItemLocation::class) 
            ->withPivot('quantity'); 
    }
}
