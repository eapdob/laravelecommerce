<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Laravel\Scout\Searchable;

class Product extends Model
{
    protected $table = 'product';

    use HasFactory;

    use SearchableTrait, Searchable;

    protected $fillable = ['quantity'];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'product.name' => 10,
            'product.details' => 5,
            'product.description' => 2,
        ],
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

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

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        $extraFields = [
            'categories' => $this->categories->pluck('name')->toArray(),
        ];

        return array_merge($array, $extraFields);
    }
}
