<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Forgot Password | Workzen Technologies</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        body {
            background: linear-gradient(to right, rgb(31,131,138), rgb(35,138,146));
            font-family: 'Open Sans', sans-serif;
        }

        .forgot-box {
            max-width: 420px;
            margin: 80px auto;
            background: #fff;
            border-radius: 6px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .forgot-box h3 {
            text-align: center;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .forgot-box p {
            text-align: center;
            font-size: 13px;
            color: #666;
            margin-bottom: 25px;
        }

        .form-group {
            position: relative;
        }

        .form-group i {
            position: absolute;
            top: 15px;
            left: 12px;
            color: #999;
        }

        .form-control {
            padding-left: 35px;
            height: 42px;
        }

        .btn-reset {
            width: 100%;
            height: 42px;
            background: rgb(31,131,138);
            color: #fff;
            border: none;
            font-weight: 600;
            border-radius: 4px;
        }

        .btn-reset:hover {
            background: rgb(22,104,110);
        }

        .back-login {
            text-align: center;
            margin-top: 15px;
        }

        .back-login a {
            font-size: 13px;
            color: rgb(31,131,138);
            text-decoration: none;
            font-weight: 600;
        }

        .logo {
            text-align: center;
            margin-bottom: 15px;
        }

        .logo img {
            width: 50px;
        }

    </style>
</head>

<body>

<div class="forgot-box">

    <!-- LOGO -->
    <div class="logo text-center">
        <img src="{{ asset('assets/icons/workgen_icon2.png') }}" width="50">
    </div>

    <!-- STEP 1 : USERNAME OR EMAIL -->
    <div id="step1">
        <h3>Forgot Password</h3>
        <p>Enter your username and email to receive OTP</p>

        <form id="forgotForm">
            @csrf

            <div class="form-group">
                <i class="fa fa-user"></i>
                <input type="text"
                       id="fp_user"
                       class="form-control"
                       placeholder="Username">
            </div>
            <div class="form-group">
                <i class="fa fa-envelope"></i>
                <input type="text"
                       id="fp_email"
                       class="form-control"
                       placeholder="Email">
            </div>
            <div class="form-group">
                <i class="fa fa-building"></i>
                <select id="cmbCompany" name="cmbCompany" class="form-control">
                    <option value="">Select Company</option>
                    <option value="COMP001">Workzen Technologies</option>
                    <option value="COMP002">XYZ Solutions</option>
                    <option value="COMP003">ABC Corp</option>
                </select>
            </div>


            <button type="submit" class="btn-reset">
                <i class="fa fa-paper-plane"></i> Send OTP
            </button>
        </form>
    </div>

    <!-- STEP 2 : OTP SECTION -->
    <div id="step2" style="display:none;">
        <h3>Verify OTP</h3>
        <p>Please enter the OTP sent to your email</p>

        <form id="otpForm">
            <div class="form-group">
                <i class="fa fa-lock"></i>
                <input type="text"
                    id="fp_otp"
                    class="form-control"
                    placeholder="Enter OTP"
                    maxlength="6"
                    inputmode="numeric"
                    autocomplete="one-time-code">

            </div>

            <button type="submit" class="btn-reset">
                <i class="fa fa-check"></i> Verify OTP
            </button>
        </form>

        <div class="back-login">
            <a href="#" id="resendOtp">
                <i class="fa fa-refresh"></i> Resend OTP
            </a>
        </div>
    </div>

    <!-- STEP 3 : CHANGE PASSWORD -->
    <div id="step3" style="display:none;">
        <h3>Change Password</h3>
        <p>Please set your new password</p>

        <form id="resetForm">

            <div class="form-group">
                <i class="fa fa-key"></i>
                <input type="password" id="old_password"
                       class="form-control"
                       placeholder="Old Password">
            </div>

            <div class="form-group">
                <i class="fa fa-lock"></i>
                <input type="password" id="new_password"
                       class="form-control"
                       placeholder="New Password">
            </div>

            <div class="form-group">
                <i class="fa fa-lock"></i>
                <input type="password" id="confirm_password"
                       class="form-control"
                       placeholder="Confirm Password">
            </div>

            <button type="submit" class="btn-reset">
                <i class="fa fa-save"></i> Update Password
            </button>
        </form>
    </div>

</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>

    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }
    /* STEP 1 → STEP 2 */
    $('#forgotForm').on('submit', function(e){
        e.preventDefault();

        
        let user = $('#fp_user').val().trim();
        let email = $('#fp_email').val().trim();
        let company = $('#cmbCompany').val();

        if(user === ''){
            toastr.error('Please enter Username');
            $('#fp_user').focus();
            return;
        }

        if(email === ''){
            toastr.error('Please enter Email');
            $('#fp_email').focus();
            return;
        }

        if(!isValidEmail(email)){
            toastr.error('Please enter a valid Email');
            $('#fp_email').focus();
            return;
        }

        if(company === ''){
            toastr.error('Please choose a Company');
            $('#cmbCompany').focus();
            return false;
        }

        toastr.success('OTP sent successfully');
        $('#step1').hide();
        $('#step2').fadeIn();
    });

    /* STEP 2 → STEP 3 */
    $('#fp_otp').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('#otpForm').submit(function(e){
        e.preventDefault();

        let otp = $('#fp_otp').val().trim();

        if(otp === ''){
            toastr.error('Please enter OTP');
            $('#fp_otp').focus();
            return;
        }

        if(!/^\d+$/.test(otp)){
            toastr.error('Only numeric digits allowed');
            $('#fp_otp').focus();
            return;
        }

        if(otp.length !== 6){
            toastr.error('Enter correct OTP (6 digits)');
            $('#fp_otp').focus();
            return;
        }

        toastr.success('OTP verified successfully');
        $('#step2').hide();
        $('#step3').fadeIn();
    });


    /* STEP 3 → PASSWORD CHANGE */
    $('#resetForm').on('submit', function(e){
        e.preventDefault();

        let oldPwd = $('#old_password').val();
        let newPwd = $('#new_password').val();
        let confPwd = $('#confirm_password').val();

        let pwdPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/;

        if(oldPwd === ''){
            toastr.error('Please enter old password');
            $('#old_password').focus();
            return;
        }

        if(newPwd === ''){
            toastr.error('Please enter new password');
            $('#new_password').focus();
            return;
        }

        if(newPwd === oldPwd){
            toastr.error('New password cannot be same as old password');
            $('#new_password').focus();
            return;
        }

        if(!pwdPattern.test(newPwd)){
            toastr.error('Password must contain uppercase, number & special character');
            $('#new_password').focus();
            return;
        }

        if(confPwd === ''){
            toastr.error('Please confirm password');
            $('#confirm_password').focus();
            return;
        }

        if(newPwd !== confPwd){
            toastr.error('Passwords do not match');
            $('#confirm_password').focus();
            return;
        }

        toastr.success('Password updated successfully');
    });
</script>


</body>
</html>
