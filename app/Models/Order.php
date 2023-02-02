<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'brand',
        'sim',
        'charger',
        'damage',
        'errors',
        'price',
        'status',
        'diagnostic'
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class,'id','client_id');
    }
}
