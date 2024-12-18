<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class RequestItem extends Model
{
    protected $table = 'request_items';
    protected $fillable = [
        'staff_id', 'status', 'processed_by', 'nama_pemohon', 'client_id'
    ];

    protected static function booted()
    {
        static::creating(function ($requestItem) {
            $requestItem->code = $requestItem->generateRequestItemCode();
        });
    }

    public function generateRequestItemCode()
    {
        $month = Carbon::now()->month;  // Hasilnya: 12 (Desember)
        $monthFormatted = str_pad($month, 2, '0', STR_PAD_LEFT); // '12'
        $count = RequestItem::whereMonth('created_at', Carbon::now()->month)->count();
        $serialNumber = $count + 1;
        return 'req/' . $monthFormatted . '/' . $serialNumber;
    }
    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function requestDetails()
    {
        return $this->hasMany(ItemsRequestDetail::class, 'request_id');
    }

    public function client(){
        return $this->belongsTo(client::class, 'client_id');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'staff_id');
    }
}
