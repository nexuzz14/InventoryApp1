<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class Item extends Model
{
    protected $table = 'items';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }


    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'item_supplier');
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class, 'item_location')->withPivot('quantity');
    }
}
