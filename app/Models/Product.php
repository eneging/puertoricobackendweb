<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    'name', 'description', 'price', 'stock', 'image_url', 'product_category_id',
    'is_offer', 'offer_price',
];
    protected $table = 'products';

    protected $casts = [
     'price' => 'float',
    'offer_price' => 'float',
    'stock' => 'integer',
    'is_offer' => 'boolean',
    'product_category_id' => 'integer',
    
];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

  

public function offer()
{
    return $this->hasOne(Offer::class);
}


}