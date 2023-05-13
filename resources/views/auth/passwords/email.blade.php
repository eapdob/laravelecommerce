@extends('layouts.main')

@section('title', 'Email')

@section('extra-css')

@endsection

@section('content')
    <div class="container">
        <div class="auth-pages">
            <div class="auth-left">
                @if (session()->has('status'))
                    <div class="alert alert-success">
                        {{ session()->get('status') }}
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h2>Forgot Password?</h2>
                <div class="spacer"></div>
                <form action="{{ route('password.email') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required
                           autofocus>
                    <div class="login-container">
                        <button type="submit" class="auth-button">Send Password Reset Link</button>
                    </div>
                </form>
            </div>
            <div class="auth-right">
                <h2>Forgotten Password Information</h2>
                <div class="spacer"></div>
                <p>Once you submit your email address, we will send a password reset link to the provided email address.
                    Please allow a few minutes for the email to arrive.</p>
                <div class="spacer"></div>
                <p>If you don't see the email in your inbox, be sure to check your spam or junk folder as well.</p>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
@endsection
