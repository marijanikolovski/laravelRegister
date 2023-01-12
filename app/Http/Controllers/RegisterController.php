<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function create()
    {
        $countries = DB::table('countries')->get();
        return view('auth.register', ['countries' => $countries]);
    }

    public function store(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = new User();


        $user->name = $validated['name'];
        $user->company = $validated['company'];
        $user->country = $validated['country'];
        $user->email = $validated['email'];
        $user->password = bcrypt($validated['password']);

        $user->save();

        return redirect('/');
    }
}
