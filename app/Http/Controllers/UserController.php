<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function queryMyUserData()
    {
        return response()->json(Auth::user());
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required','string',Rule::unique('users', 'name')->ignore(Auth::id()),'max:20','regex:/^[0-9a-z]+$/'],
            'email' => ['required','string','email:filter',Rule::unique('users', 'email')->ignore(Auth::id()),'max:30'],
        ]);

        return User::where('id', Auth::id())->update([
          'email' => $request->input('email'),
          'name' => $request->input('name')
        ]);
    }
    public function delete()
    {
        return User::where('id', Auth::id())->forceDelete();
    }
}
