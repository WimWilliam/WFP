<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use HasFactory;
    public function products(): HasMany
    {

        //Product::class = dari model
        //"hotel_id", "id" = foreign key table products
        return $this->hasMany(Product::class, "hotel_id", "id");
    }
}
