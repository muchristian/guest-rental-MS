<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <style>
    * {
        padding:0;
        margin:0;
        box-sizing:border-box;
    }
    .verify-container {
        background:white;
        text-align: center;
        margin: auto;
        max-width: 800px;
        height: 350px;
        border-top: 3px solid dodgerblue;
    }
    .verify-container h1 {
        padding-top: 25px;
        line-height: 5;
        color: dodgerblue;
    }
    .verify-container h4 {
        padding: 0 0 20px;
    }
    .verify-container p {
        color: rgba(0, 0, 0, 0.5);
    }
    .verify-container a {
        text-decoration: none;
        background-color: dodgerblue;
        color: white;
        padding: 15px;
        text-transform: capitalize;
        line-height: 6;
    }
    </style>
</head>
<body>
<div class="verify-container">
<h1>NY</h1>
<h4>Hi {{ $name }},</h4>
<p>Thank you for creating an account with us. Don't forget to complete your registration!.<br>
    Please click on the link below or copy it into the address bar of your browser to confirm your email address:</p>
    <a href="{{ url('user/verify', $verification_code)}}">reset password</a>
</div>
</body>
</html>