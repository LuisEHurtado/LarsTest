<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity',
        'sales_price',
        'orders_id',
        'products_id',
    ];

    public function products(){
        return $this->belongsTo('App\Models\Products','products_id');
    }
}
