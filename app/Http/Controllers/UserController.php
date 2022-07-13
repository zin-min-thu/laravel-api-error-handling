<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Str;

class UserController extends Controller
{
    public function getUser(User $user)
    {

        return $user;
    }

    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function show(User $user)
    {
        // $user = User::find($id);

        // return $user;

        $token = Str::random(80);

        // $data['hash_token'] = Hash::make($token);

        // return $data;

        $user->forceFill([
            'api_token' => $token,
        ])->save();

        return ['token' => $token];

        abort(404, 'Object not found');

        return response()->json($user, 200);
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());

        return response()->json($user, 200);
    }
}
