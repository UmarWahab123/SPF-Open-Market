@extends('frontend.amazy.layouts.app')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Complete</title>
</head>
<style>

.custom-container {
    text-align: center;
    background-color: #ffffff;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
   
}

.custom-check-icon {
    margin-bottom: 20px;
}

.custom-title {
    font-size: 60px;
    color: #17361f;
    margin-bottom: 10px;
}

.custom-paragraph {
    font-size: 20px;
    color: #333;
    line-height: 1.5;
}

.custom-paragraph a {
    color: #1976d2;
    text-decoration: none;
}

.custom-paragraph a:hover {
    text-decoration: underline;
}

.custom-btn {
    background-color: #17361f;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 20px;
    opacity: 0.9;
    color:#ffffff;
    font-size: 21px;
    font-family: 'Roboto-Regular';
}

.custom-btn:hover {
    background-color: #17361f;  
}


</style>

@section('content')
    <div class="custom-container">
        <div class="custom-check-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 16 16">
                <path fill="#17361f" d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-4.5 4.75a.75.75 0 0 1-1.08-.02l-2-2.5a.75.75 0 1 1 1.16-.96l1.56 1.95 3.78-3.77z"/>
                <path fill="#17361f" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1z"/>
            </svg>
        </div>
        <h1 class="custom-title">Your sign up is now complete.</h1>
        <p class="custom-paragraph">Your account is now under review, and you'll be able to log in once approved by the admin.</p>
        <p class="custom-paragraph"><a href="{{ url('/login') }}">Click Here</a> to login to your customer portal</p>
        <a href="{{ url('/') }}"><button class="custom-btn">Continue to homepage</button></a>
    </div>
@endsection
