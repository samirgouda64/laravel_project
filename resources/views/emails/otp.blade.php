<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif; background:#f4f6f8; padding:20px;">
    <div style="max-width:600px; margin:auto; background:#ffffff; border-radius:6px; padding:20px;">

        <h2 style="color:#1f838a; text-align:center;">
            {{ $companyName }}
        </h2>

        <p>Hello <strong>{{ $username }}</strong>,</p>

        <p>
            We received a request to reset your password.
            Please use the OTP below to proceed:
        </p>

        <div style="text-align:center; margin:25px 0;">
            <span style="
                font-size:26px;
                letter-spacing:6px;
                font-weight:bold;
                background:#1f838a;
                color:#ffffff;
                padding:12px 20px;
                border-radius:4px;
                display:inline-block;
            ">
                {{ $otp }}
            </span>
        </div>

        <p style="color:#555;">
            This OTP is valid for <strong>5 minutes</strong>.
            Do not share this OTP with anyone.
        </p>

        <p style="color:#777; font-size:13px;">
            If you did not request this, please ignore this email.
        </p>

        <hr>

        <p style="font-size:12px; color:#999; text-align:center;">
            © {{ $companyName }} | ERP Support Team
        </p>

    </div>
</body>
</html>
