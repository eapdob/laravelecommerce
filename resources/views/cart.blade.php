@extends('layouts.main')

@section('title', 'Shopping Cart')

@section('extra-tags')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')

    @component('components.breadcrumbs')
        <a href="#">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>Shopping Cart</span>
    @endcomponent

    <div class="cart-section container">
        <div>
            @if (session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (Cart::instance('default')->count() > 0)
                <h2>{{ Cart::instance('default')->count() }} items in Shopping Cart</h2>
                <div class="cart-table">
                    @foreach (Cart::instance('default')->content() as $item)
                        <div class="cart-table-row">
                            <div class="cart-table-row-left">
                                <a href="{{ route('shop.show', $item->model->slug) }}"><img
                                        src="{{ productImage($item->model->image) }}" alt="item"
                                        class="cart-table-img"></a>
                                <div class="cart-item-details">
                                    <div class="cart-table-item"><a
                                            href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name }}</a>
                                    </div>
                                    <div class="cart-table-description">{{ $item->model->details }}</div>
                                </div>
                            </div>
                            <div class="cart-table-row-right">
                                <div class="cart-table-actions">
                                    <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                                        @csrf
                                        @method('delete')

                                        <button type="submit" class="cart-options">Remove</button>
                                    </form>
                                    <form action="{{ route('cart.switchToSaveForLater', $item->rowId) }}" method="POST">
                                        @csrf

                                        <button type="submit" class="cart-options">Save for Later</button>
                                    </form>
                                </div>
                                <div>
                                    <select name="quantity" onchange="updateQuantitySelector(this)" class="quantity" data-id="{{ $item->rowId }}" data-productQuantity="{{ $item->model->quantity }}">
                                        @foreach ([1,2,3,4,5] as $quantity)
                                            <option value={{ $quantity }} @if ($item->qty == $quantity) selected=""@endif>{{ $quantity }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>{{ presentPrice($item->subtotal) }}</div>
                            </div>
                        </div> <!-- end cart-table-row -->
                    @endforeach
                </div> <!-- end cart-table -->
                @if (!session('coupon'))
                    <div class="checkout-coupons">
                        <a href="#" class="have-code">Have a Code?</a>
                        <form action="{{ route('coupon.store') }}" method="POST">
                            @csrf
                            <input type="text" name="coupon_code" id="coupon_code">
                            <button type="submit" class="button button-plain">Apply</button>
                        </form>
                    </div> <!-- end have-code-container -->
                @endif
                <div class="cart-totals">
                    <div class="cart-totals-left">
                        Shipping is free because we’re awesome like that. Also because that’s additional stuff I don’t
                        feel like figuring out :).
                    </div>
                    <div class="cart-totals-right">
                        <div>
                            Subtotal <br>
                            @if (session('coupon'))
                                Discount ({{ session()->get('coupon')['name'] }}) :
                                <form action="{{ route('coupon.destroy') }}" method="POST"
                                      style="display: inline-block;">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit" style="font-size: 14px;">Remove</button>
                                </form><br>
                                <hr>
                                New Subtotal<br>
                            @endif
                            Tax ({{config('cart.tax')}}%)<br>
                            <span class="checkout-totals-total">Total</span>
                        </div>
                        <div class="cart-totals-subtotal">
                            {{ presentPrice(Cart::instance('default')->subtotal()) }} <br>
                            @if (session('coupon'))
                                -{{ presentPrice($discount) }} <br>
                                <hr>
                                {{ presentPrice($newSubtotal) }}<br>
                            @endif
                            {{ presentPrice($newTax) }} <br>
                            <span
                                class="checkout-totals-total">{{ presentPrice($newTotal) }}</span>
                        </div>
                    </div>
                </div> <!-- end cart-totals -->
                <div class="cart-buttons">
                    <a href="#" class="button">Continue Shopping</a>
                    <a href="{{ route('checkout.index') }}" class="button-primary">Proceed to Checkout</a>
                </div>
            @else
                <h3>No items in Cart!</h3>
                <div class="spacer"></div>
                <a href="{{ route('shop.index') }}" class="button">Continue shopping</a>
                <div class="spacer"></div>
            @endif
            @if (Cart::instance('saveForLater')->count() > 0)
                <h2>{{ Cart::instance('saveForLater')->count() }} items Saved For Later</h2>
                @foreach (Cart::instance('saveForLater')->content() as $item)
                    <div class="saved-for-later cart-table">
                        <div class="cart-table-row">
                            <div class="cart-table-row-left">
                                <a href="{{ route('shop.show', $item->model->slug) }}"><img
                                        src="{{ productImage($item->model->image) }}" alt="item"
                                        class="cart-table-img"></a>
                                <div class="cart-item-details">
                                    <div class="cart-table-item"><a
                                            href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name }}</a>
                                    </div>
                                    <div class="cart-table-description">{{ $item->model->details }}</div>
                                </div>
                            </div>
                            <div class="cart-table-row-right">
                                <div class="cart-table-actions">
                                    <form action="{{ route('saveForLater.destroy', $item->rowId) }}" method="POST">
                                        @csrf
                                        @method('delete')

                                        <button type="submit" class="cart-options">Remove</button>
                                    </form>
                                    <form action="{{ route('saveForLater.switchToCart', $item->rowId) }}" method="POST">
                                        @csrf

                                        <button type="submit" class="cart-options">Move to Cart</button>
                                    </form>
                                </div>
                                <div>{{ $item->model->presentPrice() }}</div>
                            </div>
                        </div> <!-- end cart-table-row -->
                    </div> <!-- end saved-for-later -->
                @endforeach
            @else
                <h3>You have no items Saved for Later.</h3>
            @endif
        </div>
    </div> <!-- end cart-section -->
    @include('partials.might-like')
@endsection

@section('extra-scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        function updateQuantitySelector(sel) {
            let th = sel;
            const id = th.getAttribute('data-id');
            const productQuantity = th.getAttribute('data-productQuantity');

            axios.patch(`/cart/${id}`, {
                quantity: th.value,
                productQuantity: productQuantity
            })
            .then(function (response) {
                // console.log(response);
                window.location.href = '{{ route('cart.index') }}'
            })
            .catch(function (error) {
                // console.log(error);
                window.location.href = '{{ route('cart.index') }}'
            });
        }
    </script>
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>
@endsection
