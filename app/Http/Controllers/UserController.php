<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

        // return 'here';

        // abort(404, 'Object not found');

        return response()->json($user, 200);
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());

        return response()->json($user, 200);
    }
}
