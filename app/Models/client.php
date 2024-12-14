<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    protected $table = 'clients';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'address', 'phone'];
    public $timestamps = false;


    public function items()
    {
        return $this->belongsToMany(Item::class, 'request_item');
    }
}
