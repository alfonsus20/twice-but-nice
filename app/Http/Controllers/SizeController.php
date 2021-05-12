<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    // Menampilkan daftar size
    public function index()
    {
        $sizes = Size::paginate(10);
        return view('admin.size', ['sizes' => $sizes]);
    }

    // Menampilkan form untuk menambahkan size baru
    public function create()
    {
        return view('admin.add-size');
    }

    // Menambahkan size baru 
    public function store(Request $request)
    {
        $request->validate([
            "size_name" => "required|string|unique:sizes,size_name"
        ]);
        $size = new Size;
        $size->size_name = $request->size_name;
        $size->save();
        return redirect('/admin/size/add')->with('success', 'Size berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit size
    public function edit($id)
    {
        $size = Size::find($id);
        return view('admin.edit-size', ['size' => $size]);
    }

    // Mengupdate size produk
    public function update(Request $request, $id)
    {
        $request->validate([
            "size_name" => "required|string|unique:sizes,size_name"
        ]);
        $size = Size::find($id);
        $size->size_name = $request->size_name;
        $size->save();
        return redirect('/admin/size')->with('success', 'Size berhasil diubah');
    }
}
