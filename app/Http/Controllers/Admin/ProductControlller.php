<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdectRequest;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductControlller extends Controller
{

    public function index (){

        $products = Product::latest()->paginate(20);

        return api_success([
            'products'   => ProductResource::collection($products),
            'pagination' => new PaginationResource($products),
        ], 'Products retrieved successfully');
    }


    
      public function store(ProdectRequest $request)
    {
        $product = Product::create($request->all());

        return api_success(new ProductResource($product), 'Product created successfully');

    }

        public function show( $id)
    {

        $product = Product::find($id);
                return api_success(new ProductResource($product), 'Product retrieved successfully');
    }


      public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());

        return api_success(new ProductResource($product), 'Product updated successfully');
    }

      public function destroy($id)
    {
        Product::destroy($id);

        return api_success(null, 'Product deleted successfully');
    }
}
