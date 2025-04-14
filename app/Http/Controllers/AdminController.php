<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function storeUser(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_as' => $request->role,
        ]);
        
        return redirect()->route('admin.dashboard')->with('success', 'User berhasil ditambahkan.');
    }
}
