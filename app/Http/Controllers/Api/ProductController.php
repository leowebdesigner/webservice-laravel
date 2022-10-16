<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProductFormRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;
    
    public function __construct(Product $product)
    {
       $this->product = $product;   
    }

    public function index(Request $request)
    {
       $products = $this->product->getResults($request->all());

       return response()->json($products);
    }

    public function store(StoreUpdateProductFormRequest  $request)
    {
        $product = $this->product->create($request->all());

        return response()->json([$product, 201]);
    }

    public function show($id)
    {
        $product = $this->product->findOrFail($id);
        
        return response()->json($product);
    }

    public function update(StoreUpdateProductFormRequest $request, $id)
    {
        $product = $this->product->findOrFail($id);
        $product->update($request->all());

        return response()->json($product);
    }

  
    public function delete($id)
    {
        $product = $this->product->findOrFail($id);
        $product->delete($product);

        return response()->json(['success' => true, 204]);
    }
}
