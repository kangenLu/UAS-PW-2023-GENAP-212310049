<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminsResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminsController extends Controller
{
    public function index()
    {
        $admins = User::all();

        return new AdminsResource(true, 'Data Admin', $admins);
    }

    public function show($id)
    {
        $admins = User::find($id);

        if ($admins) {
            return new AdminsResource(true, 'Data Admin Ditemukan !', $admins);
        } else {
            return response()->json([
                'message' => 'Data not found !'
            ], 422);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:user,email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $admins = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return new AdminsResource(true, 'Data berhasil tersimpan !', $admins);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:user,email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $admins = User::find($id);

            if ($admins) {
                $admins->name = $request->name;
                $admins->email = $request->email;
                $admins->password = Hash::make($request->password);
                $admins->save();

                return new AdminsResource(true, 'Data berhasil terupdate !', $admins);
            } else {
                return response()->json([
                    'message' => 'Data not found !'
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $admins = User::find($id);

        if ($admins) {
            $admins->delete();

            return new AdminsResource(true, 'Data berhasil terhapus !', '');
        } else {
            return response()->json([
                'message' => 'Data not found !'
            ]);
        }
    }
}
