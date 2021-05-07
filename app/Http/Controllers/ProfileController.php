<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curl  = new CurlController();
        $provinces = $curl->getProvince();
        $cities = $curl->getCity();
        $user = Auth::user();
        return view('profile', ['provinces' => $provinces, 'cities' => $cities, 'user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        
        if($user->email == $request->email){
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'telephone' => 'required|string',
                'address' => 'required|string|max:255',
                'birth_date' => 'required|date',
                'province_id' => 'required',
                'city_id' => 'required',
            ]);
        }else{
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'telephone' => 'required|string',
                'address' => 'required|string|max:255',
                'birth_date' => 'required|date',
                'province_id' => 'required',
                'city_id' => 'required',
            ]);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->telephone = $request->telephone;
        $user->province_id = (int)$request->province_id;
        $user->city_id = (int)$request->city_id;
        $user->address = $request->address;
        $user->postal_code = $request->postal_code;
        $user->birth_date = $request->birth_date;
        $user->save();

        return back()->with('success', "Profile berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
