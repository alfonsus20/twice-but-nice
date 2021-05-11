<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = Size::paginate(10);
        return view('admin.size', ['sizes' => $sizes]);
    }

    public function create()
    {
        return view('admin.add-size');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $size = Size::find($id);
        return view('admin.edit-size', ['size' => $size]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
