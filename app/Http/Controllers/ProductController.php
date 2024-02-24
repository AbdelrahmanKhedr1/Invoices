<?php

namespace App\Http\Controllers;

use App\Http\Requests\product\ProductCreate;
use App\Http\Requests\product\ProductEdit;
use App\Models\Product;
use App\Models\Section;

class ProductController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:products', ['only' => ['index']]);
        $this->middleware('permission:add product', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit product', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete product', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $sections = Section::all();
        return view('products.product',compact('products','sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        return view('products.product_create',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCreate $request)
    {
        Product::create($request->validated());
        session()->flash('Add', 'تم اضافة المنتج بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sections = Section::all();
        $product_id = Product::findOrFail($id);
        return view('products.product_edit', compact('product_id','sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductEdit $request, string $id)
    {
        Product::findOrFail($id)->update($request->validated());
        session()->flash('Edit', 'تم تعديل المنتج بنجاح');
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::where('id',$id)->delete();
        session()->flash('Delete', 'تم حذف المنتج بنجاح');
        return back();
    }
}
