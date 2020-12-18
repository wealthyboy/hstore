<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProductVariation extends Model
{
    //
    protected $table ='category_product_variation';

    protected $fillable = ['product_variation_id','category_id'];

    public function product_variation(){
        return $this->belongsTo(ProductVariation::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }


}
