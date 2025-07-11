<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = ['name', 'description'];

     protected $table = 'product_categories';
    
    public function products()
{
    return $this->hasMany(Product::class, 'product_category_id');
}
}