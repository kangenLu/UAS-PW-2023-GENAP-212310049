<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function dashboard()
    {
        $data = User::get();
        $user_logged = Auth::user();
        return view('admin.dashboardadmin', compact('data', 'user_logged'));
    }

    public function create()
    {
        return view('admin.createadmin');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'photo' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            $photo = $request->file('photo');
            $filename = date('Y-m-d') . $photo->getClientOriginalName();
            $path = 'user-photo/' . $filename;

            Storage::disk('public')->put($path, file_get_contents($photo));

            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['password'] = Hash::make($request->password);
            $data['photo'] = $filename;

            User::create($data);
            return redirect()->route('admin.dashboard-admin');
        }
    }

    public function edit(Request $request, $id)
    {
        $data = User::find($id);

        return view('admin.editadmin', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'photo' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            $photo = $request->file('photo');
            if ($photo) {
                $filename = date('Y-m-d') . $photo->getClientOriginalName();
                $path = 'user-photo/' . $filename;
                Storage::disk('public')->put($path, file_get_contents($photo));

                $data['photo'] = $filename;
            }

            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['password'] = Hash::make($request->password);

            User::whereId($id)->update($data);
            return redirect()->route('admin.dashboard-admin');
        }
    }

    public function delete(Request $request, $id)
    {
        $data = User::find($id);

        if ($data) {
            $data->delete();
        }

        return redirect()->route('admin.dashboard-admin');
    }
}
