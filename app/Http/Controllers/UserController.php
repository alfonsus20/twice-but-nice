<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Tampilkan semua user di database
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('admin.users', ["users" => $users]);
    }

    public function makeAdmin($id){
        $user = User::find($id);
        $user->assignRole('admin');
        return back()->with('success', $user->name . " berhasil dijadikan admin");
    }

    public function withdrawAdmin($id){
        $user = User::find($id);
        $user->removeRole('admin');
        return back()->with('success', $user->name . " berhasil dijadikan member");
    }
}