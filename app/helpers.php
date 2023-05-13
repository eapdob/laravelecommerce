<?php

function presentPrice($price)
{
//        return money_format('$%i', $this->price / 100);

    $fmt = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
    return str_replace(',', '', $fmt->formatCurrency($price / 100, 'USD'));
}

function setCategoryActive($slug) {
    return request()->category === $slug ? 'active' : '';
}

function productImage($path) {
    return (($path !== null) && file_exists('storage/' . $path)) ? asset('storage/' . $path) : asset('img/not-found.jpg');
}

function getNumbers()
{
    $tax = config('cart.tax') / 100;
    $discount = session()->get('coupon')['discount'] ?? 0;
    $code = session()->get('coupon')['name'] ?? null;
    $newSubtotal = (Cart::subtotal() - $discount);
    if ($newSubtotal < 0) {
        $newSubtotal = 0;
    }
    $newTax = $newSubtotal * $tax;
    $newTotal = $newSubtotal * (1 + $tax);

    return collect([
        'tax' => $tax,
        'discount' => $discount,
        'code' => $code,
        'newSubtotal' => $newSubtotal,
        'newTax' => $newTax,
        'newTotal' => $newTotal,
    ]);
}
