<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Forgot Password</title>

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
                            <?php
                                foreach ($company_name as $key=>$value)
                                {
                                    echo '<option value="'.$value->company_code.'">'.$value->company_name.'</option>';
                                }
                            ?>
                    </select>
                </div>


                <button type="submit" id="btnSendOtp" class="btn-reset">
                    <i class="fa fa-paper-plane"></i> Send OTP
                </button>
            </form>
        </div>

        <!-- STEP 2 : OTP SECTION -->
        <div id="step2" style="display:none;">
            <h3>Verify OTP</h3>
            <p>Please enter the OTP sent to your email <strong id="maskedEmail"></strong></p>
            <p>OTP expires in: <span id="otpExpiryText">05:00</span></p>

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

                <button type="submit" id="otpVerify" class="btn-reset">
                    <i class="fa fa-check"></i> Verify OTP
                </button>
            </form>

            <div class="back-login">
                <span id="otpTimer" class="text-muted">
                    Resend OTP in <strong>01:00</strong>
                </span>

                <a href="#" id="resendOtp" style="display:none;">
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

                <button type="submit" id="passwordUpdate" class="btn-reset">
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
            
            $("#btnSendOtp").html('<i class="fa fa-cog fa-spin"></i> OTP Sending...');

            $.ajax({
                url:'/sendOtp',
                type:'POST',
                data:{
                    username:user,
                    email: email,
                    company:company,
                    _token: '{{ csrf_token() }}'
                },
                success:function(result){
                    if(result.dbStatus == 'SUCCESS'){
                        toastr.success(result.dbMessage);
                        $("#btnSendOtp").html('<i class="fa fa-paper-plane"></i> Send OTP');
                        $('#maskedEmail').text(maskEmail(email));
                        $('#step1').hide();
                        $('#step2').fadeIn();
                        startOtpTimer();
                        startOtpExpiryTimer();
                    } else if(result.dbStatus == 'FAILURE'){
                        toastr.error(result.dbMessage);
                        $("#btnSendOtp").html('<i class="fa fa-paper-plane"></i> Send OTP');
                    }
                },
                error:function(){
                    toastr.error('Unable to process please contact support');
                }
            });
        });

        /* STEP 2 → STEP 3 */

        $('#fp_otp').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        $('#otpForm').submit(function(e){
            e.preventDefault();

            let otp = $('#fp_otp').val().trim();
            let email = $('#fp_email').val().trim();

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

            $("#otpVerify").html('<i class="fa fa-cog fa-spin"></i> OTP Verifying...');

            $.ajax({
                url:'/verifyOtp',
                type:'POST',
                data:{
                    otp:otp,
                    email:email,
                    _token: '{{ csrf_token() }}'
                },
                success:function(result){
                    if(result.dbStatus == 'SUCCESS'){
                        toastr.success(result.dbMessage);
                        $("#otpVerify").html('<i class="fa fa-check"></i> Verify OTP');
                        $('#step2').hide();
                        $('#step3').fadeIn();
                    }
                    else if(result.dbStatus == 'FAILURE'){
                        toastr.error(result.dbMessage);
                        $("#otpVerify").html('<i class="fa fa-check"></i> Verify OTP');
                    }
                },
                error:function(){
                    toastr.error('Unable to process please contact support');
                }
            });
        });

        $('#resendOtp').on('click', function(e){
            e.preventDefault();

            let user    = $('#fp_user').val().trim();
            let email   = $('#fp_email').val().trim();
            let company = $('#cmbCompany').val();
            $('#fp_otp').val('').focus();

            $("#resendOtp").html('<i class="fa fa-spinner fa-spin"></i> Resending...');

            $.ajax({
                url:'/sendOtp',
                type:'POST',
                data:{
                    username:user,
                    email:email,
                    company:company,
                    _token:'{{ csrf_token() }}'
                },
                success:function(result){
                    if(result.dbStatus === 'SUCCESS'){
                        toastr.success('OTP resent successfully');
                        $("#resendOtp").html('<i class="fa fa-refresh"></i> Resend OTP');
                        startOtpTimer();
                        startOtpExpiryTimer();
                    } else {
                        toastr.error('Unable to resend OTP');
                        $("#resendOtp").html('<i class="fa fa-refresh"></i> Resend OTP');
                    }
                },
                error:function(){
                    toastr.error('Unable to process please contact support');
                }
            });
        });


        /* STEP 3 → PASSWORD CHANGE */
        $('#resetForm').on('submit', function(e){
            e.preventDefault();

            let oldPwd = $('#old_password').val();
            let newPwd = $('#new_password').val();
            let confPwd = $('#confirm_password').val();
            let email  = $('#fp_email').val().trim();
            let company = $('#cmbCompany').val();

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

            $("#passwordUpdate").html('<i class="fa fa-spinner fa-spin"></i> Password Resetting...');

            $.ajax({
                url:'/forgotPassword',
                type:'POST',
                data:{
                    oldPwd:oldPwd,
                    newPwd:newPwd,
                    email:email,
                    company:company,
                    _token:'{{ csrf_token() }}'
                },
                success:function(result){
                    if(result.dbStatus == 'SUCCESS'){
                        toastr.success(result.dbMessage);
                        $("#passwordUpdate").html('<i class="fa fa-refresh"></i> Update Password');
                        window.location.href = result.redirect_url;
                    } else {
                        toastr.error(result.dbMessage);
                        $("#passwordUpdate").html('<i class="fa fa-refresh"></i> Update Password');
                    }
                },
                error:function(){
                    toastr.error('Unable to process please contact support');
                }
            })
        });

        // Email Masking to display
        function maskEmail(email){
            let parts = email.split('@');
            let name  = parts[0];
            let domain = parts[1];

            if(name.length <= 5){
                return email;
            }

            let firstPart = name.substring(0, 3);
            let lastPart  = name.substring(name.length - 2);
            let masked    = '*'.repeat(name.length - 5);

            return firstPart + masked + lastPart + '@' + domain;
        }

        // OTP Resend Timer
        let otpTimer;
        let timeLeft = 60;

        function startOtpTimer() {
            timeLeft = 60;
            $('#resendOtp').hide();
            $('#otpTimer').show();

            otpTimer = setInterval(function () {
                let min = Math.floor(timeLeft / 60);
                let sec = timeLeft % 60;

                $('#otpTimer').html(
                    `Resend OTP in <strong>${String(min).padStart(2, '0')}:${String(sec).padStart(2, '0')}</strong>`
                );

                timeLeft--;

                if (timeLeft < 0) {
                    clearInterval(otpTimer);
                    $('#otpTimer').hide();
                    $('#resendOtp').fadeIn();
                }
            }, 1000);
        }

        // OTP Expired Timer
        let otpExpiryTimer;
        let otpExpiryTime = 300;

        function startOtpExpiryTimer() {
            otpExpiryTime = 300;

            clearInterval(otpExpiryTimer);

            otpExpiryTimer = setInterval(function () {
                let min = Math.floor(otpExpiryTime / 60);
                let sec = otpExpiryTime % 60;

                $('#otpExpiryText').text(`${String(min).padStart(2,'0')}:${String(sec).padStart(2,'0')}`);

                otpExpiryTime--;

                if (otpExpiryTime < 0) {
                    clearInterval(otpExpiryTimer);
                }
            }, 1000);
        }

    </script>
</body>
</html>
