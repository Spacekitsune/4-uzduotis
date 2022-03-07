<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $sortCollumn = $request->sortCollumn; //name
        $sortOrder = $request->sortOrder; // ASC

        if(empty($sortCollumn) || empty($sortOrder)) {
            $productCategory = ProductCategory::paginate(3);
        } else {
            $productCategory = ProductCategory::orderBy($sortCollumn, $sortOrder )->get();
        }   

        $select_array =  array_keys($productCategory->first()->getAttributes());
        array_pop($select_array);
        array_pop($select_array);

       

    
    return view('productcategory.index', [
        'productCategory' => $productCategory, 'sortCollumn' =>$sortCollumn, 'sortOrder'=> $sortOrder, 'select_array' => $select_array
    ]);


    

}



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productCategory = new ProductCategory();
        $productCategory->title = $request->productcategory_title;
        $productCategory->description = $request->productcategory_description;

        $productCategory->save();

        return redirect()->route('productcategory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory)
    {
        return view('productcategory.edit', ['productCategory' => $productCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductCategoryRequest  $request
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        $productCategory->title = $request->productcategory_title;
        $productCategory->description = $request->productcategory_description;

        $productCategory->save();

        return redirect()->route('productcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory)
    {
        $products = $productCategory->categoryProducts;
        if (count($products) != 0) {
            return redirect()->route('productcategory.index')->with('error_message', 'Delete is not possible while category has products.');
        } 
        $productCategory->delete();
        return redirect()->route('productcategory.index')->with('success_message', 'Category was deleted.');
    }
}
