<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'user_id',
    ];
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}
