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
        background:#fafafa;
        text-align: center;
        margin: auto;
        max-width: 800px;
        height: 350px;
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
<p>Well done, your guest house has been approved. Now you can login</p>
</div>
</body>
</html>