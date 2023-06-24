<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ktp;
use App\Models\User;

class KtpController extends Controller
{
    //
    public function store(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            // dd($user);
            $ktp = Ktp::create([
                'user_id' => $id,
                'idNumber' => $request['idNumber'],
            ]);
            
            return response()->json($ktp, 201);
        } catch (\Exception $error) {
            // Handle the error
            \Log::error('error>>>', ['error' => $error->getMessage()]);
            return response()->json(['error' => $error->getMessage()], 400);
        }
    }
}
