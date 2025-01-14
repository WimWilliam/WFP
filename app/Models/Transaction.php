<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Transaction extends Model
{
    use HasFactory;
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function customer():BelongsTo
    {
        return $this->belongsTo(Customer::class,'customer_id');
        
    }

    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_transaction','transaction_id','product_id')
        ->withPivot('quantity','subtotal');
    }
    public function insertProducts($cart,$user)
    {
    $total = 0;
    foreach ($cart as $c) 
    {
        $subtotal = $c['quantity']* $c['price'];
        $total += $subtotal;
        $this->products()->attach($c['id'],['quantity' => $c['quantity'], 'subtotal' => $subtotal]);
    }
}

    
}