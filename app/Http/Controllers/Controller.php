<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function jsonError($statusCode = 500, $message = "Unexpected Error")
    {

        return response()->json([
            "success" => false,
            "message" => $message
        ], $statusCode);
    }

    public function jsonSuccess($statusCode = 200, $message = "Request Successful")
    {
        return response()->json([
            "success" => true,
            "message" => $message
        ], $statusCode);
    }


    public function cartCount(){
        $user = Auth::user();
        $quantity = 0;
        if ($user->cart !== null) {
            $cart = cart::find($user->cart->id);
            foreach ($cart->cart_items as $item) {
                $quantity += $item->quantity;
            }
            return $quantity;

        } else {
            return $quantity;
        }
    }


    public function checkProductInCart($product_id, $cart_items)
    {

            foreach ($cart_items as $item) {
                if ($product_id == $item->product_id) {
                    return $item;
                }
            }

    }

    public function total()
    {
        $user = Auth::user();
        if ($user !== null) {
            if ($user->cart !== null) {
                $cart_items = $user->cart->cart_items;
                if (!$cart_items) {
                    return $total = 0;
                } else {
                    $total = 0;
                    foreach ($cart_items as $item) {
                        $total = $total + ($item->quantity * $item->price);
                    }
                    return $total;
                }
            }
            return $total = 0;

        }
        // dd($user);

    }
}
