<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
class chart extends Model
{
 protected $table = 'chart';
 public $timestamps = false;


 public function item(){
  return $this->belongsTo(Item::class, 'item_id', 'id');
 }


}
