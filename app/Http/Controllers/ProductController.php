<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::with('category', 'tags')->get();
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());
        $product->tags()->sync($request->tags);
        return response()->json($product, 201);
    }

    public function show($id)
    {
        return Product::with('category', 'tags')->find($id);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        $product->tags()->sync($request->tags);
        return response()->json($product, 200);
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return response()->json(null, 204);
    }
}
