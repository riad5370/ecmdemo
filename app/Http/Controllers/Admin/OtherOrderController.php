<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BillingDetails;
use App\Models\CustolerLogin;
use Illuminate\Http\Request;
use App\Models\Order;

class OtherOrderController extends Controller
{
    
    public function pendingOrders(){
        $orders = Order::where('status', 1)->orderBy('created_at', 'DESC')->get();
        return view('admin.order.pendingOrder',[
            'orders'=>$orders 
        ]);
    }

    public function completeOrders(){
        $orders = Order::where('status', 6)->orderBy('created_at', 'DESC')->get();
        return view('admin.order.completeOrder',[
            'orders'=>$orders 
        ]);
    }


    //customer-section-start
    public function customerList(){
        $customers = CustolerLogin::orderBy('created_at', 'DESC')->get();
        return view('admin.customer.customerList',[
            'customers'=>$customers 
        ]);
    }
    public function billingCustomer(){
        $billingCustomers = BillingDetails::orderBy('created_at', 'DESC')->get();
        return view('admin.customer.billingCustomer',[
            'billingCustomers'=>$billingCustomers 
        ]);
    }
    public function customerDelete($id){
        $customer = CustolerLogin::find($id);
        $customer->delete();
        return redirect()->back()->with('success', 'Customer deleted successfully.');
    }
}
