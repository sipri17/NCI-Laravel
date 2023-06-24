<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    //
    public function index()
    {
        try {
            $users = User::with('ktp')->get();
            return response()->json($users, 200);
        } catch (\Exception $error) {
            // Handle the error
            \Log::error('error>>>', ['error' => $error->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {

            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => $request['password']
            ]);
            return response()->json($user, 201);
        } catch (\Exception $error) {
            // Handle the error
            \Log::error('error>>>', ['error' => $error->getMessage()]);
            return response()->json(['error' => $error->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $user = User::findOrFail($id);
            $user->fill([
                'name' => $request['name'],
                'email' => $request['email']
            ]);
            $user->save();
            return response()->json($user, 201);
        } catch (\Exception $error) {
            // Handle the error
            \Log::error('error>>>', ['error' => $error->getMessage()]);
            return response()->json(['error' => $error->getMessage()], 400);
        }
    }
}