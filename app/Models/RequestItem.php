<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestItem extends Model
{
    protected $table = 'request_items';
    protected $fillable = [
        'staff_id', 'status', 'processed_by', 'nama_pemohon'
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
        return $this->hasMany(ItemsRequestDetail::class, 'request_id');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
