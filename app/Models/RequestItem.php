<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestItem extends Model
{
    protected $table = 'request_items';
    protected $fillable = [
        'customer_id', 'status', 'processed_by'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function requestDetails()
    {
        return $this->hasMany(ItemsRequestDetail::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
