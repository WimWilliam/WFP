<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Product extends Model
{
    use HasFactory;

    public function hotels(): BelongsTo
    { 
        return $this->belongsTo(Hotel::class, "hotel_id");
    }

    public function transactions(): BelongsToMany
    {
        //Product::class, tabel hasil dari many to many, id transaction, 
        return $this->belongsToMany(Transaction::class, 'product_transaction', 'product_id', 'transaction_id')->withPivot('quantity','subtotal');
    }
}
