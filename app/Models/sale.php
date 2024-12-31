<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class sale extends Model
{
    protected $table = 'sales';
    protected $fillable = [
        'status',
        'code_invoice',
        'code_proyek',
        'client_id',
        'total',
    ];

    protected static function booted()
    {
        static::creating(function ($sale) {
            $sale->code_invoice = $sale->generateInvoiceCode();
        });
        static::deleting(function ($requestItem) {
            $requestItem->requestDetails()->detach();
        });
    }

    public function generateInvoiceCode()
    {
        $month = Carbon::now()->month; 
        $year = Carbon::now()->year % 100; 
        $romanMonths = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 
            6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX', 
            10 => 'X', 11 => 'XI', 12 => 'XII'
        ];
        $monthRoman = $romanMonths[$month];
        $count = sale::whereMonth('created_at', $month)->count();
        $serialNumber = str_pad($count + 1, 3, '0', STR_PAD_LEFT); 
        return 'INV3L-' . $monthRoman . '-' . $year . $serialNumber;
    }
    
   
    public function client()
    {
        return $this->belongsTo(client::class, 'client_id');
    }
    public function items()
    {
        return $this->belongsToMany(Item::class, 'items_sales')
                    ->withPivot('quantity', 'total')
                    ->withTimestamps();
    }
    public function calculateTotal()
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item->pivot->total;
        }

        return $total;
    }
    public function itemSale(){
        return $this->hasMany(itemSale::class, 'sale_id');        
    }
}
