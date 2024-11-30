<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Requests\StoreOrderDetailRequest;
use App\Http\Requests\UpdateOrderDetailRequest;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function showAll()
    {
        return view('manage.orders.index', [
            'page' => 'Manage Orders',
            'orders' => Order::latest()->get()
        ]);
    }
    
    public function showDetails(Order $order)
    {
        return view('manage.orders.show', [
            'page' => 'Manage Orders',
            'orderDetails' => OrderDetail::where('order_id', $order->id)->get()
        ]);
    }

    public function show()
    {
        if (!Order::where('user_id', auth()->user()->id)->where('is_paid', false)->exists()) {
            Order::create([
                'user_id' => auth()->user()->id,
                'is_paid' => false
            ]);
        }

        $order = Order::where('user_id', auth()->user()->id)->where('is_paid', false)->first();

        $orderDetails = OrderDetail::where('order_id', $order->id)->get();

        $totalPrice = 0;

        foreach($orderDetails as $orderDetail) {
            $totalPrice += $orderDetail->product->price * $orderDetail->qty;
        }

        return view('orders.show', [
            'page' => 'Make Order',
            'order' => $order,
            'orderDetails' => OrderDetail::where('order_id', $order->id)->get(),
            'totalPrice' => $totalPrice
        ]);
    }

    public function order(Product $product)
    {
        return view('orders.order', [
            'page' => 'Make Order',
            'product' => $product
        ]);
    }

    public function makeOrder(StoreOrderDetailRequest $request)
    {

        if (!Order::where('user_id', auth()->user()->id)->where('is_paid', false)->exists()) {
            Order::create([
                'user_id' => auth()->user()->id,
                'is_paid' => false
            ]);
        }

        $order = Order::where('user_id', auth()->user()->id)->where('is_paid', false)->first();

        $newOrder = $request->validate([
            'product_id' => 'required',
            'qty' => 'required|numeric'
        ]);

        $newOrder['order_id'] = $order->id;

        if (OrderDetail::where('order_id', $order->id)->where('product_id', $newOrder['product_id'])->exists()) {
            $oldOrder = OrderDetail::where('order_id', $order->id)->where('product_id', $newOrder['product_id'])->first();

            OrderDetail::where('order_id', $order->id)->where('product_id', $newOrder['product_id'])
            ->update([
                'qty' => $oldOrder->qty + $newOrder['qty']
            ]);

            return redirect('/menu')->with('success', 'Product quantity successfully added to order!');
        }
        
        OrderDetail::create($newOrder);

        return redirect('/menu')->with('success', 'Product successfully added to order!');
    }

    public function editOrder(UpdateOrderDetailRequest $request, OrderDetail $orderDetail)
    {
        $editOrder = $request->validate([
            'qty' => 'required|numeric'
        ]);

        OrderDetail::where('id', $orderDetail->id)->update($editOrder);

        return redirect('/orders');
    }
    
    public function payOrder(UpdateOrderRequest $request, Order $order)
    {
        $payOrder = $request->validate([
            'name' => 'required',
            'total_price' => 'required',
            'total_paid' => 'required'
        ]);

        $payOrder['is_paid'] = true;

        Order::where('id', $order->id)->update($payOrder);

        return redirect('/orders')->with('successPay', 'Order paid successfully!');
    }

    public function deleteOrder(OrderDetail $orderDetail)
    {
        OrderDetail::destroy($orderDetail->id);

        return redirect('/orders')->with('success', 'Product has been deleted from orders!');
    }

}
