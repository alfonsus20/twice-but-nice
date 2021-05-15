<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Shipping;
use App\Models\Product;
use App\Models\ProductsImage;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $sold = Product::where('available', 0)->count();
        $not_sold = Product::where('available', 1)->count();
        $income = Order::where('paid', 1)->sum('total');
        $sent = Shipping::where('delivered', 1)->count();
        $not_sent = Shipping::where('delivered', 0)->count();
        $newest_orders = Order::where('paid', 1)
            ->join('users', 'users.id', 'orders.user_id')
            ->join('payments', 'payments.order_id', 'orders.id')
            ->select('orders.*', 'users.name', 'payments.type', 'payments.updated_at as payment_time')
            ->get();

        return view('admin.index', [
            'income' => $income,
            'sold' => $sold,
            'not_sold' => $not_sold,
            'sent' => $sent,
            'not_sent' => $not_sent,
            'newest_orders' => $newest_orders
        ]);
    }

    public function getOrderDetail($id)
    {
        $order = Order::where('orders.id', $id)->join('shippings', 'orders.id', 'shippings.order_id')
            ->select('orders.*', 'shippings.cost',  'shippings.courier', 'shippings.service')
            ->first();
        $order_items = OrderItem::where('order_id', $id)
            ->get();
        $products = Product::whereIn('products.id', $order_items->pluck('product_id')->toArray())
            ->join('sizes', 'products.size_id', "sizes.id")
            ->select('products.*', 'sizes.size_name')
            ->get();
        $products_images = ProductsImage::getProductImage();
        $payment = Payment::where('order_id', $order->id)->first();
        $user = User::where('id', $order->user_id)->first();
        $shipping = Shipping::where('order_id', $order->id)->first();

        return view('admin.order-detail', [
            'products' => $products,
            'products_images' => $products_images,
            'order' => $order,
            'payment'=> $payment,
            'user'=> $user,
            'shipping'=> $shipping,
        ]);
    }
}
