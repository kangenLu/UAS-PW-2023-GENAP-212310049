<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionsResource;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionsController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();

        return response()->json([
            'success' => true,
            'message' => 'Data Admin',
            'data' => $transactions
        ]);
    }

    public function show($id)
    {
        $transactions = Transaction::find($id);

        if ($transactions) {
            return new TransactionsResource(true, 'Data Transaksi Ditemukan !', $transactions);
        } else {
            return response()->json([
                'message' => 'Data not found !'
            ], 422);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_ordered' => 'required',
            'quantity' => 'required|numeric',
            'price_item' => 'required|numeric',
            'total_price' => 'required|numeric',
            'total_paid' => 'required|numeric',
            'total_unpaid' => 'required|numeric',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ada kesalahan',
                'data' => $validator->errors()
            ]);
        } else {
            $transactions = Transaction::create([
                'product_ordered' => $request->product_ordered,
                'quantity' => $request->quantity,
                'price_item' => $request->price_item,
                'total_price' => $request->total_price,
                'total_paid' => $request->total_paid,
                'total_unpaid' => $request->total_unpaid,
                'status' => $request->status,
            ]);

            return new TransactionsResource(true, 'Data berhasil tersimpan !', $transactions);
        }
    }

    // public function update(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required',
    //         'email' => 'required|unique:user,email',
    //         'password' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     } else {
    //         $admins = User::find($id);

    //         if ($admins) {
    //             $admins->name = $request->name;
    //             $admins->email = $request->email;
    //             $admins->password = Hash::make($request->password);
    //             $admins->save();

    //             return new AdminsResource(true, 'Data berhasil terupdate !', $admins);
    //         } else {
    //             return response()->json([
    //                 'message' => 'Data not found !'
    //             ]);
    //         }
    //     }
    // }

    public function destroy($id)
    {
        $transactions = Transaction::find($id);

        if ($transactions) {
            $transactions->delete();

            return new TransactionsResource(true, 'Data berhasil terhapus !', '');
        } else {
            return response()->json([
                'message' => 'Data not found !'
            ]);
        }
    }
}
