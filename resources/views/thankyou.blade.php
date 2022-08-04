@extends('layouts.main')

@section('title', 'Thank You')

@section('extra-css')

@endsection

@section('content')

    <div class="container">
        <div class="thank-you-section mt-5">
            <h1>Thank you for <br> Your Order!</h1>
            <p>A confirmation email was sent</p>
            <div class="spacer"></div>
            <div>
                <a href="{{ url('/') }}" class="button">Home Page</a>
            </div>
        </div>
    </div>

@endsection
