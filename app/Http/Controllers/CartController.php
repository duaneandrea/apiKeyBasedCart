<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $user = Auth::user();
        $total = $this->total();
        if ($user->cart) {
            $cart = Cart::find($user->cart->id);
             return response()->json([
            'success' => true,
            'cart' => $cart,
                 'total'=>$total,
        ]);
        } else {
            $cart = [];
             return response()->json([
            'success' => true,
            'cart' => $cart, 'total'=>$total,
        ]);
        }
    }

       public function addToCart(Request $request){

        $this->validate($request, [
            'product_id' => 'required',
            'quantity'=>'required|numeric|min:1'
        ]);

        $user = Auth::user();
        if ($user->cart !== null){
            $cart = cart::find($user->cart->id);
        } else {
            $cart = new cart();
            $cart->user_id = $user->id;
            $cart->save();
        }

        $product = Products::find($request->input('product_id'));

        if ($request->input('quantity') > $product->quantity_in_stock) {
            return response()->json([
            'success' => false,
            'message' => 'product is out of stock',
        ]);
        } else {
            if ($cart_item = $this->checkProductInCart($product->id, $cart->cart_items ?? [])) {
                $cart_item = CartItems::find($cart_item->id);
                if(($cart_item->quantity +$request->input('quantity')) >$product->quantity_in_stock ){
                           return response()->json([
            'success' => false,
            'message' => 'your  quantity is greater than whats in our stock',
        ]);
                }
                $cart_item->quantity = $cart_item->quantity + $request->input('quantity');
                $cart_item->save();
            } else {
                $cart_item = new CartItems();
                $cart_item->quantity = $request->input('quantity');
                $cart_item->product_id = $request->input('product_id');
                $cart_item->price = $product->price;
                $cart_item->cart_id = $cart->id;
            }
            $cart_item->save();
             return response()->json([
            'success' => true,
            'message' => 'product added to cart',
        ]);
        }
    }

      public function deleteCartItem(Request $request)
    {
        $this->validate($request, [
            'cart_item_id' => 'required',
        ]);
        $user = Auth::user()->id;
        $cart_item = CartItems::find($request->input('cart_item_id'));
        if ($cart_item != null) {
            $cart_item->delete();
            return response()->json([
            'success' => true,
            'message' => 'item removed successfully',
        ]);
        } else {
            return response()->json([
            'success' => false,
            'message' => 'failed to deduct from cart',
        ]);

        }

    }

    public function increment(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required'
        ]);
        $user = auth::user();

        if ($cart_item = $this->checkProductInCart($request->input('product_id'), $user->cart->cart_items)) {
            $cart_item = CartItems::find($cart_item->id);
            //quantity in stock
            $cart_item->quantity++;
            $cart_item->save();

             return response()->json([
                    'success' => true,
                    'message' => 'incremented successfully',
                ]);
        }
         return response()->json([
                    'success' => false,
                    'message' => 'failed to increment',
                ]);
    }

    //decrement product in cart through authenticated Api
    public function decrement(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',

        ]);
        $user = auth::user();
        if ($cart_item = $this->checkProductInCart($request->input('product_id'), $user->cart->cart_items)) {
            $cart_item = CartItems::find($cart_item->id);
            if($cart_item->quantity == 1){
               return response()->json([
                    'success' => false,
                    'message' => 'Failed to Decrement',
                ]);
            }
            $cart_item->quantity--;
            $cart_item->save();
            return response()->json([
                    'success' => true,
                    'message' => 'decremented successfully',
                ]);
        }

    }
}
