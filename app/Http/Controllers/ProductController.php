<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $sortCollumn = 'category_id';
        $category = ProductCategory::orderBy('title', 'asc' )->get();
        $sortOrder = $request->sortOrder;

        if (empty($sortOrder)) {
            $product = Product::paginate(4);
        } else {

            $sortBool = true;

            if ($sortOrder === 'asc') {
                $sortBool = false;
            }

            $product = Product::get()->sortBy(function ($query) {
                return $query->productsCategory->title;
            }, SORT_REGULAR, $sortBool)->all();
        }
        return view('product.index', ['product' => $product, 'category' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $selected_values = ProductCategory::all();
        return view('product.create', ['selected_values' => $selected_values]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {
        $product = new Product();

        $productName = 'image' . time() . '.' . $request->product_imageUrl->extension();

        $request->product_imageUrl->move(public_path('images'), $productName);

        $product->title = $request->product_title;
        $product->description = $request->product_description;
        $product->price = $request->product_price;
        $product->category_id = $request->product_categoryId;
        $product->image_url = $productName;

        $product->save();

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $selected_values = ProductCategory::all();
        return view('product.edit', ['product' => $product], ['selected_values' => $selected_values]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if ($request->has('product_imageUrl')) {
            $productName = 'image' . time() . '.' . $request->product_imageUrl->extension();
            $request->product_imageUrl->move(public_path('images'), $productName);
            $product->image_url = $productName;
        }

        $product->title = $request->product_title;
        $product->description = $request->product_description;
        $product->price = $request->product_price;
        $product->category_id = $request->product_categoryId;

        $product->save();

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (strpos($product->image_url, "http") === 0) {
            $product->delete();
            return redirect()->route('product.index')->with('success_message', 'Product was deleted.');
        } else {
            $dir = "images";
            unlink($dir . '/' . $product->image_url);
            $product->delete();
            return redirect()->route('product.index')->with('success_message', 'Product was deleted.');
        }
    }

    public function filter(Request $request)
    {

        $category_id = $request->category_id;
        $product = Product::where('category_id', '=' , $category_id)->get();
        return view('product.search', ['product' =>$product]);
    }
}
