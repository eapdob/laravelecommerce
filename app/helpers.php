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
