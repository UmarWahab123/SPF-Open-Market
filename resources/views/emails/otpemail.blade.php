<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #F8F8F8;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            color: #0070BA;
            margin: 0;
        }
        .content {
            font-size: 16px;
        }
        .button {
            display: inline-block;
            padding: 12px 20px;
            margin-top: 20px;
            background-color: #0070BA;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #888;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>OTP Verification</h1>
        </div>
        <div class="content">
            <p>Hello </p>
            <p>We’re pleased to inform you that your subscription has been approved. To finalize the setup, please review and approve your PayPal billing agreement at the link provided below:</p>
            <p style="text-align: center;">
                <a>{{$otp}}</a>
            </p>
            <p>If you have any questions or need assistance, feel free to contact us at support@example.com.</p>
            <p>Thank you for choosing our service. We’re excited to have you with us!</p>
        </div>
        <div class="footer">
            &copy; Your Company Name. All rights reserved.
        </div>
    </div>
</body>
</html>