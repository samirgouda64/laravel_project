<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{

    public function showForgetPassword(Request $request){
        $company_name = DB::table('company.company_master')
            ->select('company_code', 'company_name')
            ->where('status', 1)
            ->orderBy('company_code')
            ->get();
        return view('forgetPassword', compact('company_name'));
    }

    public function sendOtp(Request $request){
        
        $request->validate([
            'username'=> 'required|string',
            'email' => 'required|email',
            'company' => 'required',
        ]);

        $user = DB::table('users.user_master')
        ->where('username', $request->username)
        ->where('company_code', $request->company)
        ->where('status', 1)
        ->first();

        if(!$user){
            return response()->json([
                'dbStatus' => 'FAILURE',
                'dbMessage' => 'User not Found'
            ]);
        }

        // Generate OTP (plain)
        $plainOtp = rand(100000, 999999);

        // Hash OTP
        $hashedOtp = Hash::make($plainOtp);
        
        $exist = DB::table('users.password_resets')
        ->where('email', $request->email)
        ->first();

        if($exist){
            //update
            $result = DB::table('users.password_resets')
            ->where('email', $request->email)
            ->update(['otp' => $hashedOtp, 'created_at'=>now()]);
        } else {
            //insert
           $result =  DB::table('users.password_resets')
            ->insert(['email' => $request->email, 'otp' => $hashedOtp]);
        }

         // Send OTP via email

         $companyDetails = DB::table('company.company_master')
        ->where('company_code', $request->company)
        ->where('status', 1)
        ->first();

        $email    = $request->email;
        $username = $user->username;
        $companyName  = $companyDetails->company_name;

        Mail::send('emails.otp', [
            'username' => $username,
            'otp'      => $plainOtp,
            'companyName'  => $companyName
        ], function ($message) use ($email, $companyName) {
            $message->to($email)
                    ->subject($companyName . ' | Password Reset OTP');
        });

        if($result){
            $output['dbStatus']  = 'SUCCESS';
            $output['dbMessage'] = 'OTP sent successfully';
        } else {
            $output['dbStatus']  = 'FAILURE';
            $output['dbMessage'] = 'Something went to be Wrong...';
        }

        return response()->json($output);
    }

    public function verifyOtp(Request $request){
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric|digits:6'
        ]);

        $record = DB::table('users.password_resets')
        ->where('email', $request->email)
        ->first();

        if(!$record){
            $output['dbStatus'] = 'FAILURE';
            $output['dbMessage'] = 'No OTP found for this Email';
            return response()->json($output);
        }

         // Check OTP expiry (5 minutes)
        $otpCreated = Carbon::parse($record->created_at);
        if ($otpCreated->addMinutes(5)->lt(now())) {
            $output['dbStatus']  = 'FAILURE';
            $output['dbMessage'] = 'OTP expired, please request a new one';
            return response()->json($output);
        }

        if(Hash::check($request->otp, $record->otp)){
            $output['dbStatus'] = 'SUCCESS';
            $output['dbMessage'] = 'OTP verified Successfully';
        } else {
            $output['dbStatus'] = 'FAILURE';
            $output['dbMessage'] = 'Incorrect OTP';
        }
        return response()->json($output);
    }
    
    public function forgotPassword(Request $request){
        $request->validate([
            'oldPwd' => 'required',
            'newPwd' => 'required',
            'email'  => 'required',
            'company'=> 'required'
        ]);

        $user = DB::table('users.user_master')
        ->where('email', $request->email)
        ->where('company_code', $request->company)
        ->where('status', 1)
        ->first();

        if(!$user){
            $output['dbStatus'] = 'FAILURE';
            $output['dbMessage'] = 'User not Found';
            return response()->json($output);
        }

        // Check old Password
        if(!Hash::check($request->oldPwd, $user->password)){
            $output['dbStatus'] = 'FAILURE';
            $output['dbMessage'] = 'Old password is incorrect';
            return response()->json($output);
        }

        // Old & New Password same check
        if(Hash::check($request->newPwd, $user->password)){
            $output['dbStatus'] = 'FAILURE';
            $output['dbMessage'] = 'New password cannot be same as old password';
            return response()->json($output);
        }

        $updated = DB::table('users.user_master')
        ->where('email', $request->email)
        ->where('company_code', $request->company)
        ->where('status', 1)
        ->update([
            'password' => Hash::make($request->newPwd),
            'updated_at' => now()
        ]);

        if($updated){

            // Delete OTP after success
            DB::table('users.password_resets')
            ->where('email', $request->email)
            ->delete();

            $url = '/';
            $output['dbStatus'] = 'SUCCESS';
            $output['dbMessage'] = 'Password updated successfully';
            $output['redirect_url'] = $url;
        } else {
            $output['dbStatus'] = 'FAILURE';
            $output['dbMessage'] = 'Unable to update password...';
        }
        return response()->json($output);
    }
}

?>