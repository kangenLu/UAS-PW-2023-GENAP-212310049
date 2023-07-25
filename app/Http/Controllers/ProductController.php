<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function dashboard()
    {
        $data = Product::get();
        $user_logged = Auth::user();
        return view('product.dashboardproduct', compact('data', 'user_logged'));
    }

    public function create()
    {
        return view('product.createproduct');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'price_item' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            $data['product_name'] = $request->product_name;
            $data['price_item'] = $request->price_item;

            Product::create($data);
            return redirect()->route('admin.dashboard-product');
        }
    }

    public function edit(Request $request, $id)
    {
        $data = Product::find($id);

        return view('product.editproduct', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'price_item' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            $data['product_name'] = $request->product_name;
            $data['price_item'] = $request->price_item;

            Product::whereId($id)->update($data);
            return redirect()->route('admin.dashboard-product');
        }
    }

    public function delete(Request $request, $id)
    {
        $data = Product::find($id);

        if ($data) {
            $data->delete();
        }

        return redirect()->route('admin.dashboard-product');
    }
}
