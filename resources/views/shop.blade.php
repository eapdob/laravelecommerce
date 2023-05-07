@extends('layouts.main')

@section('title', 'Products')

@section('extra-tags')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')

    @component('components.breadcrumbs')
        <a href="/">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>Shop</span>
    @endcomponent

    <div class="products-section container">
        <div class="sidebar">
            <h3>By Category</h3>
            <ul>
                @foreach ($categories as $category)
                    <li class="{{ setCategoryActive($category->slug) }}"><a
                            href="{{ route('shop.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div> <!-- end sidebar -->
        <div>
            <div class="products-header">
                <h1 class="stylish-heading">{{ $categoryName }}</h1>
                <div>
                    <strong>Price</strong>
                    <a href="{{ route('shop.index', ['category' => request()->category, 'sort' => 'low_high']) }}">Low
                        to High</a> |
                    <a href="{{ route('shop.index', ['category' => request()->category, 'sort' => 'high_low']) }}">High
                        to Low</a>
                </div>
            </div>
            <div class="products text-center">
                @forelse ($products as $item)
                    <div class="product">
                        <a href="{{ route('shop.show', $item->slug) }}"><img src="{{ productImage($item->image) }}"
                                                                             alt="product"></a>
                        <a href="{{ route('shop.show', $item->slug) }}">
                            <div class="product-name">{{ $item->name }}</div>
                        </a>
                        <div class="product-price">{{ $item->presentPrice() }}</div>
                    </div>
                @empty
                    <div style="text-align: left">No items found</div>
                @endforelse
            </div> <!-- end products -->
            <div class="pagination">
                {!! $products->links() !!}
            </div>
        </div>
    </div>

@endsection

@section('extra-scripts')
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>
@endsection
