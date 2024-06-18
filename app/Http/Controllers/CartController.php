<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function applyDiscount(Request $request)
    {
        $couponCode = $request->input('coupon_code');
        $validCoupons = [
            'DISCOUNT10' => 10, // 10% discount
            'DISCOUNT20' => 20, // 20% discount
            'DISCOUNT30' => 30, // 30% discount
        ];

        $discountPercentage = 0;
        if (array_key_exists($couponCode, $validCoupons)) {
            $discountPercentage = $validCoupons[$couponCode];
        }

        $discountAmount = 0;
        $total = 0;
        $cart = session('cart');
        $validRooms = ['Kamar Deluxe', 'Kamar Suite', 'Kamar Superior'];

        foreach ($cart as $item) {
            $total += $item['quantity'] * $item['price'];
            foreach ($validRooms as $room) {
                if (strpos($item['name'], $room) !== false) {
                    $discountAmount += ($item['price'] * $item['quantity']) * ($discountPercentage / 100);
                    break;
                }
            }
        }

        session(['discount' => $discountAmount]);

        return redirect()->back()->with('success', 'Coupon applied successfully!');
    }
}
