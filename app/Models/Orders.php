<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'total',
        'tax',
        'status',
        'user_id',
        'comment',
    ];
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function details(){
        return $this->hasMany('App\Models\OrderDetails');
    }
}
