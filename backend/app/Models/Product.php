<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public const REORDER_QUANTITY = 10;

    // public const REORDER_LEVEL = 10;

    protected $fillable = ['name', 'inventory'];

    public function fulfilledOrders()
    {
        return $this->hasMany(FulfilledOrder::class);
    }
}
