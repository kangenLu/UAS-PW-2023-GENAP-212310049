<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function dashboard()
    {
        $data = Transaction::get();
        $user_logged = Auth::user();
        return view('transaction.dashboardtransaction', compact('data', 'user_logged'));
    }

    public function reporting()
    {
        $data = Transaction::where('status', 'Lunas')->get();
        $user_logged = Auth::user();
        return view('reporting.dashboardreporting', compact('data', 'user_logged'));
    }

    public function create()
    {
        $data_product = Product::get();
        return view('transaction.createtransaction', compact('data_product'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_ordered' => 'required',
            'quantity' => 'required|numeric',
            'price_item' => 'required',
            'total_price' => 'required',
            'total_paid' => 'required|numeric',
            'total_unpaid' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            $data['product_ordered'] = $request->product_ordered;
            $data['quantity'] = $request->quantity;
            $data['price_item'] = $request->price_item;
            $data['total_price'] = $request->total_price;
            $data['total_paid'] = $request->total_paid;
            $data['total_unpaid'] = $request->total_unpaid;
            $data['status'] = $request->status;

            Transaction::create($data);
            return redirect()->route('admin.dashboard-transaction');
        }
    }

    public function edit(Request $request, $id)
    {
        $data = Transaction::find($id);
        $data_product = Product::get()->where('product_name', '!=', $data->product_ordered);

        return view('transaction.edittransaction', compact('data', 'data_product'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'product_ordered' => 'required',
            'quantity' => 'required|numeric',
            'price_item' => 'required',
            'total_price' => 'required',
            'total_paid' => 'required|numeric',
            'total_unpaid' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            $data['product_ordered'] = $request->product_ordered;
            $data['quantity'] = $request->quantity;
            $data['price_item'] = $request->price_item;
            $data['total_price'] = $request->total_price;
            $data['total_paid'] = $request->total_paid;
            $data['total_unpaid'] = $request->total_unpaid;
            $data['status'] = $request->status;

            Transaction::whereId($id)->update($data);
            return redirect()->route('admin.dashboard-transaction');
        }
    }

    public function delete(Request $request, $id)
    {
        $data = Transaction::find($id);

        if ($data) {
            $data->delete();
        }

        return redirect()->route('admin.dashboard-transaction');
    }
}
