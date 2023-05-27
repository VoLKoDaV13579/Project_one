<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::get();
        return response()->json([
            'code' => 200,
            'message' =>'get',
            'users' => $users
        ]);
    }
    public function create(Request $request)
    {
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['password'],
        ]);
        $users = User::get();
        return response()->json([
            'code' => 200,
            'message' => 'created',
            'users' => $users
        ]);
    }
    public function update(Request $request)
    {
        $user = User::find($request['id']);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = $request['password'];
        $user->save();
        $users = User::get();
        return response()->json([
            'code' => 200,
            'message' => 'updated',
            'users' => $users
        ]);
    }
    public function delete(Request $request)
    {
        $user = User::find($request['id']);
        $user->delete();
        $users = User::get();
        return response()->json([
            'code' => 200,
            'message' => 'deleted',
            'users' => $users
        ]);
    }
}
