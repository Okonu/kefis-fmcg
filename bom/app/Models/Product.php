<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function getTotalCost()
    {
        $totalCost = 0;

        foreach ($this->items as $item) {
            foreach ($item->materials as $material) {
                $totalCost += $material->price;
            }
        }

        return $totalCost;
    }
}
