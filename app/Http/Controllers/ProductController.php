<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\Products;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productAttributes = ['name', 'sku', 'price'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new Products(Product::with(['categories'])->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $product = new Product($request->all());
            $product->save();

            $categories = $request->input('categories');
            if (!empty($categories)) {
                $productCategories = [];
                foreach ($categories as $category) {
                    $productCategories[] = Category::firstOrCreate(['name' => $category]);
                }
                $product->categories()->saveMany($productCategories);
            }
            return response()->json($product, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new Products(Product::with(['categories'])->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            foreach ($this->productAttributes as $attribute) {
                $newValue = $request->input($attribute);
                if (!empty($newValue)) {
                    $product[$attribute] = $newValue;
                }
            }
            $product->save();
            $categories = $request->input('categories');
            if (!empty($categories)) {
                $productCategories = [];
                foreach ($categories as $category) {
                    $productCategories[] = Category::firstOrCreate(['name' => $category]);
                }
                $product->categories()->saveMany($productCategories);
                return new Products(Product::with(['categories'])->find($id));
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Product::destroy($id);
            return response()->json(['message' => "Product {$id} deleted"], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
