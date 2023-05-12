<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
       
        $user_orders = Products::join('carts','products.id','=','carts.p_id')
                                ->join('payments','carts.id','=','payments.c_id')
                                ->join('checkouts','payments.c_id','=','checkouts.c_id')
                                ->join('shipings','checkouts.c_id','=','shipings.c_id')
                                ->get(['products.title','products.image_url','carts.price','carts.qty','carts.total','checkouts.payment_status','checkouts.order_number','shipings.addres']);

     return view('orders.index')->with(compact('user_orders'));

    }
}
