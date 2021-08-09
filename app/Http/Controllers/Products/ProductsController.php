<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\SystemSetting;
use App\Category;
use App\Product;
use App\ProductVariation;
use App\Attribute;
use App\ProductVariationValue;
use  App\RelatedProduct;
use App\Review;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\ProductsFilter\AttributesFilter;







class ProductsController extends Controller
{

    public function __construct()
    {	  
	  $this->settings =  SystemSetting::first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function  index(Request $request,Category $category)  {

        $page_title = implode(" ",explode('-',$category->slug));
        $category_attributes = $category->attribute_parents()->has('children')->get();
         

        //dd($this->getFilters($category_attributes));
        $products = ProductVariation::whereNotNull('name')->where('allow',true)->whereHas('categories',function(Builder  $builder) use ($category){
            $builder->where('categories.name',$category->name);
        })->filter($request,$this->getFilters($category_attributes))->latest()->paginate($this->settings->products_items_per_page);
        $products->appends(request()->all());
        $products->load('product');
        if($request->ajax())
        { 
        return response()->json([
            'products' => $products->toArray(),
            'category_attributes' => $category_attributes->count()
        ]); 
        }

        $breadcrumb = $category->name; 
        //$products =  $category->product_variants()->orderBy('created_at','desc')->paginate($this->settings->products_items_per_page);
        return  view('products.index',compact(
            'category',
            'page_title',
            'category_attributes',
            'breadcrumb',
            'products'
        ));     
    }


    public function getFilters($category_attributes){
        $filters = [];
        foreach ($category_attributes as $category_attribute){
           $filters[$category_attribute->attribute->slug] = AttributesFilter::class;
        }
        return $filters;
    }


    public function quickView(Request $request)
    {
        $product_variation  = ProductVariation::findOrFail($request->id);
        $data= [];
        if ( null !== $product_variation->product){
            foreach ($product_variation->product->parent_attributes as  $parent_attribute) {
                if ($parent_attribute->p_attribute_children()){
                    $data[$parent_attribute->name] = $parent_attribute->p_attribute_children();
                }
            }
        }
        $inventory = $this->product_inventory($product_variation); 
        $stock = $this->product_stock($product_variation); 
        $attributes =  collect($data);
        $attributes = $attributes->count() && $product_variation->product->product_type == 'variable' ? $attributes : '{}';
        $product_variation->load(["images","product.variants","product.variants.images"]);
        return view('_partials.quick_view',compact('inventory','stock','attributes','product_variation'));
    }
    



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Category $category,ProductVariation $product_variation)  { 

        
        $page_title = "{$product_variation->name}";
        $favorites ='';
        $data= [];

        if (!$product_variation->product->allow){
            return redirect('404');
        }

        if ( null !== $product_variation->product){
            foreach ($product_variation->product->parent_attributes as  $parent_attribute) {
                if ($parent_attribute->p_attribute_children()){
                    $data[$parent_attribute->name] = $parent_attribute->p_attribute_children();
                }
            }
        }
        $inventory = $this->product_inventory($product_variation); 
        $stock = $this->product_stock($product_variation); 
        $attributes =  collect($data);
        $attributes = $attributes->count() && $product_variation->product->product_type == 'variable' ? $attributes : '{}';
        $product_variation->load(["images"]);

        if ($request->debug){
            dd($product_variation);
       }
    	return view('products.show',compact('inventory','stock','category','attributes','product_variation','page_title'));
    }


    public function product_inventory($product_variation)
	{
		$inventory  = [];
		$attributes  = [];
		$stock = [];
		$a = [];
        foreach ($product_variation->product->product_variations as  $variant) {
			$first = ProductVariationValue::where("product_variation_id", $variant->id)->orderBy('attribute_parent_id','asc')->first();
			foreach ($variant->product_variation_values->slice(1) as  $variation_value) {
				$stock[$first->name][optional($variation_value->parent_attribute)->name][ $variation_value->name ] = $variation_value->name;
			}
		}
        $inventory = collect($stock);
        $stock = "[$inventory]";
		return $stock;
    }
    

    public function search(Request $request){
        $filtered_array = $request->only(['q', 'field']);
		if (empty( $filtered_array['q'] ) )  { 
			return redirect('/errors');
        }
        $breadcrumb = 'Search Results for  ' .$filtered_array['q'] ; 

		if($request->has('q')){
			$filtered_array = array_filter($filtered_array);
                $query = ProductVariation::whereNotNull('name')->whereHas('categories', function( $query ) use ( $filtered_array ){
                    $query->where('categories.name','like','%' .$filtered_array['q'] . '%')
                        ->orWhere('product_variations.name', 'like', '%' .$filtered_array['q'] . '%')
                        ->orWhere('product_variations.sku', 'like', '%' .$filtered_array['q'] . '%');
                });
        }
			
        $products = $query->groupBy('product_variations.id')->latest()->paginate($this->settings->products_items_per_page);
        $products->appends(request()->all());
        $products->load('product');
        if($request->ajax())
        { 
            return response()->json([
                'products' => $products->toArray(),
            ]); 
        }

        return view('products.index',compact('products','breadcrumb'));  
    }


    public function sizeGuide(){
        return view("products.size");
    }

    

    public function product_stock($product_variation)
	{
		$inventory  = [];
		$attribute  = [];
        foreach ($product_variation->product->product_variations as  $variant) {
		    $inventory[
			   implode('_',$variant->product_variation_values->pluck('name')->toArray())
		    ] =  array_merge(
						    $variant->toArray(),[
							   'images' => $variant->images->toArray()
						]);
		}
        $inventory = collect($inventory);
        $stock = "[$inventory]";
		return $stock;
	}


}
