<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\SellerProductsDataTable;
use App\Models\Product;
use App\DataTables\SellerPendingProductsDataTable;
class SellerProductController extends Controller
{
    /* Get Sellers Product */
    public function index(SellerProductsDataTable $dataTable)
    {
        return $dataTable->render('admin.product.seller-product.index');
    }

    public function pendingProducts(SellerPendingProductsDataTable $dataTable)
    {
        return $dataTable->render('admin.product.seller-pending-product.index');
    }

    public function changeApproveStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->is_approved = $request->value ;
        $product->save();
        return response(['message' => 'Product Approve Status Has Been Changed']);
    }
}
