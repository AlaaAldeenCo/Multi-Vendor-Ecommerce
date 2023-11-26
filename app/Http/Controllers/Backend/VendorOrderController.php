<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\VendorOrderDataTable;
use App\Models\Order;
class VendorOrderController extends Controller
{
    public function index(VendorOrderDataTable $dataTable)
    {
        return $dataTable->render('vendor.order.index');
    }

    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('vendor.order.show', compact('order'));
    }


    public function orderStatus(Request $request, string $id)
    {
        $order = Order::findOrFail($id);
        $order->order_status = $request->status;
        $order->save();
        toastr('Status Updated Successfully!', 'success', 'Success');
        return redirect()->back();
    }
}
