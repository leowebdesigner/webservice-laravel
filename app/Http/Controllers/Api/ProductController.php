<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
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

        $data = $request->all();
     
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $name = Str::of($request->name)->kebab();
            $extension = $request->image->extension();

            $nameFile = "{$name}"."{$extension}";
            $data['image'] = $nameFile;

            $upload = $request->image->storeAs('products', $nameFile);

            if(!$upload)
               return response()->json(['error' => 'Fail_Upload'], 500);

        }

        $product = $this->product->create($data);

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
