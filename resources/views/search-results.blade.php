@extends('layouts.main')

@section('title', 'Search')

@section('extra-css')

@endsection

@section('content')

    @component('components.breadcrumbs')
        <a href="/">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span><a href="{{ route('shop.index') }}">Shop</a></span>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>Search</span>
    @endcomponent

    <div class="search-container container">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores commodi minus nostrum reiciendis.
        Accusamus, ad atque, beatae corporis doloremque eum fugit laudantium libero mollitia odit quam quasi quia
        similique vero.
    </div> <!-- end search-container -->

@endsection

@section('extra-scripts')
@endsection
