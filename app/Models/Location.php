<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    use HasFactory;
    protected $fillable = [
        'name'
    ];
    public $timestamps = false;

    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_location');
    }

}
