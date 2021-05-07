<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CurlController;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $curl  = new CurlController();
        $provinces = $curl->getProvince();
        $cities = $curl->getCity();
        return view('auth.register', ['provinces' => $provinces, 'cities' => $cities]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'telephone' => 'required|string',
            'address' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'province_id' => 'required',
            'city_id' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'province_id' => (int)$request->province_id,
            'city_id' => (int)$request->city_id,
            'password' => Hash::make($request->password),
        ]);

        // var_dump((int)$request->province_id, $request->city_id);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
