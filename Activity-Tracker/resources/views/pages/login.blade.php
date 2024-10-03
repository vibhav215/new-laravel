@extends('master')

@section('site-content')
<style>
    /* Form Container */
    .form-container {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
    }

    /* Form Header */
    .form-header {
        text-align: center;
        margin-bottom: 20px;
    }

    /* Form Fields */
    .form-input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    /* Submit Button */
    .submit-btn {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 5px;
        background-color: #d60222;
        color: #fff;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .submit-btn:hover {
        background-color: #ba021e;
    }

    /* Link Style */
    .form-link {
        
        color: #007bff;
        transition: color 0.3s;
    }

    .form-link:hover {
        color: #0056b3;
    }
</style>

<center>
    <div class="form-container">
        <div class="form-header">
            <h2>User Login &#128204;</h2>
        </div>
        <hr>
        <form action="{{url('user/login')}}" method="POST">
            @csrf
            <input type="email" name="email" class="form-input" placeholder="Enter Email" required>
            <input type="password" name="password" class="form-input" placeholder="Enter Password" required>
            <button type="submit" class="submit-btn">Login</button>
        </form>
    </div>
    <p>Don't have an account? <a href="{{'register'}}" class="form-link">Register here</a></p>
</center>
@endsection