<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Foreach_;

class CartController extends Controller
{
    //

    public function index(Request $request)
    {
        $total = 0;
        $productsInCart = [];

        $productsInSession = $request->session()->get('products');
        if ($productsInSession) {
            $productsInCart = Product::findMany(array_keys($productsInSession));
            $total = Product::sumPricesByQuantities($productsInCart, $productsInSession);
        }

        $viewData = [];
        $viewData['title'] = 'Cart - Online Store';
        $viewData['subtitle'] = 'Shopping Cart';
        $viewData['total'] = $total;
        $viewData['products'] = $productsInCart;

        return view('cart.index')->with('viewData', $viewData);
    }

    public function add(Request $request, $id)
    {
        $products = $request->session()->get('products');
        $products[$id] = $request->input('quantity');
        $request->session()->put('products', $products);

        return redirect()->route('cart.index');
    }

    public function delete(Request $request)
    {
        $request->session()->forget('products');
        return back();
    }

    public function purchase(Request $request)
    {

        $productsInSession = $request->session()->get("products");
        if ($productsInSession) {
            $total = 0;
            // 1. create order
            $order = new Order();
            $user = Auth::user();
            $userId = $user->getId();
            $order->setUser_id($userId);
            $order->setTotal($total);
            $order->save();

            // 2. calculate order total and update it
            $productsInCart = Product::findMany(array_keys($productsInSession));
            foreach ($productsInCart as $product) {
                $productId = $product->getId();
                $quantity = $productsInSession[$productId];
                $price = $product->getPrice();
                $sum = $price * $quantity;
                $total = $total + $sum;

                $item = new Item();
                $item->setQuantity($quantity);
                $item->setPrice($price);
                $item->setProduct_id($productId);
                $item->setOrder_id($order->getId());
                $item->save();
            }
            $order->setTotal($total);
            $order->save();

            // 3. withdraw it from user balance account
            $newBalance = $user->getBalance() - $total;
            $user->setBalance($newBalance);
            $user->save();

            // 4. remove items from cart
            $request->session()->forget('products');


            $viewData = [];
            $viewData['title'] = 'Purchase - Online Store';
            $viewData['subtitle'] = 'Purchase Status';
            $viewData['order'] = $order;
            // $products = [];
            // $items = $order->items();
            // foreach ($items as $item) {
            //     $product = $item->product();
            //     $quantity = $item->getQuantity();;
            //     $newProduct = [$product, "quantity" => $quantity];
            //     array_push($products, $newProduct);
            // }

            // $viewData['products'] = $products;
            return view('cart.purchase')->with('viewData', $viewData);
        } else {
            return redirect()->route('cart.index');
        }
    }
}