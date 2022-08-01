<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function presentPrice()
    {
//        return money_format('$%i', $this->price / 100);

        $fmt = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
        return str_replace(',', '', $fmt->formatCurrency($this->price / 100, 'USD'));
    }

    public function scopeMightAlsoLike($query)
    {
        return $query->inRandomOrder()->take(4);
    }
}
