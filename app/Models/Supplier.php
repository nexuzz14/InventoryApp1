<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'address', 'phone'];
    public $timestamps = false;


    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_supplier');
    }
}
