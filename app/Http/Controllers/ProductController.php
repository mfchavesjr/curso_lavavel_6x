<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdadeProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, Product $product)
    {
        $this->request = $request;
        $this->repository = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$products = Product::all();
        //$products = Product::get();
        $products = Product::latest()->paginate();

        return view('admin.pages.products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdadeProductRequest;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdadeProductRequest $request)
    {
        $data = $request->only('name', 'description', 'price');

        if($request->hasFile('image') && $request->image->isValid()){
            $imagePath = $request->image->store('products');

            $data['image'] = $imagePath;
        }

        Product::create($data);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$product = Product::where('id', $id)->first();

        if(!$product = Product::find($id))
            return redirect()->back();

        return view('admin.pages.products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$product = Product::find($id))
            return redirect()->back();

        return view('admin.pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdadeProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdadeProductRequest $request, $id)
    {
        if(!$product = Product::find($id)){
            return redirect()->back();
        }

        $data = $request->all();

        if($request->hasFile('image') && $request->image->isValid()){

            if($product->image && Storage::exists($product->image)){
                Storage::delete($product->image);
            }

            $imagePath = $request->image->store('products');
            $data['image'] = $imagePath;
        }

        $product->update($data);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$product = Product::find($id)){
            return redirect()->back();
        }
        if($product->image && Storage::exists($product->image)){
            Storage::delete($product->image);
        }
        $product->delete();
        return redirect()->route('products.index');
    }

    /**
     * Search Products
    */

    public function search(Request $request)
    {

        $filters = $request->except('_token');

        $products = $this->repository->search($request->filter);

        return view('admin.pages.products.index', [
            'products' => $products,
            'filters' => $filters,
        ]);
    }
}
