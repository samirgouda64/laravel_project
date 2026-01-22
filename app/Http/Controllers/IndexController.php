<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

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
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'company'  => 'required'
        ]);

        $user = DB::table('users.user_master')
            ->where('username', $request->username)
            ->where('company_code', $request->company)
            ->where('status', 1)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('user_code', $user->user_code);
            Session::put('username', $user->username);
            Session::put('company_code', $user->company_code);
            // Session::put('email', $user->email);
            Session::put('role', $user->role);

            $url = '/dashboard';
            $output['dbStatus'] = 'SUCCESS';
            $output['dbMessage'] = 'You are redirect to dashboard...';
            $output['redirect_url'] = $url;
        } else {
            $output['dbStatus'] = 'FAILURE';
            $output['dbMessage'] = '..Invalid credential....';
        }
        return response()->json($output);

    }

    public function logout(Request $request){
        Session::forget('user_code');
        Session::forget('user_name');
        Session::forget('company_code');

        // if ($decrpt_role_code == "RLSUPADM" || $decrpt_role_code == 'RLSYSADM') {
        //     $page = "/su_login";
        // } else {
        //     $page = "/";
        // }

        $page = "/";
        $output['dbStatus'] = 'SUCCESS';
        $output['dbMessage'] = 'You are successfully logout';
        $output['redirect_url'] = $page;
        return response()->json($output);
    }
}
