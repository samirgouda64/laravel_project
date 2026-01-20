<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $sliders = DB::table('image.slider_images')
            ->where('status', 1)
            ->orderBy('id')
            ->get();

        $company_name = DB::table('company.company_master')
            ->select('company_code', 'company_name')
            ->where('status', 1)
            ->orderBy('company_code')
            ->get();

        return view('index', compact('sliders', 'company_name'));
    }

    public function postLogin(Request $request)
    {
        // 1️⃣ Validate input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'company'  => 'required'
        ]);

        // 2️⃣ Fetch user using DB (NO Student model)
        $user = DB::table('users.user_master')
            ->where('username', $request->username)
            ->where('company_code', $request->company)
            ->where('status', 1)
            ->first();

        // 3️⃣ User not found
        if (!$user) {
            return response()->json([
                'status'  => 'error',
                'message' => 'User not found'
            ], 401);
        }

        // 4️⃣ Password check (bcrypt)
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Invalid password'
            ], 401);
        }
    }
}
