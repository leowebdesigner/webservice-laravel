<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   
    private $category;

    public function __construct(Category $category)
    {
       $this->category = $category;
    }

    public function index(Request $request)
    {
        $categories = $this->category->getResults($request->name);

        return response()->json($categories,200);
    }

    public function store(Request $request)
    {
        $category = $this->category->create($request->all());

        return response()->json($category,201);
    }

    public function update (Request $request, $id)
    {   
        $category = $this->category->findOrFail($id);
        $category->update($request->all());

        return response()->json($category,200);
        
    }
}
