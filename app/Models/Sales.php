<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'sales';
    protected $fillable = [
        'status',
        'code_invoice',
        'code_proyek',
        'client_id',
        'total',
    ];

    public function client()
    {
        return $this->belongsTo(client::class, 'client_id');
    }
}
