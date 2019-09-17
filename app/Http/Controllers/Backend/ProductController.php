<?php

namespace App\Http\Controllers\Backend;

use App\Brand;
use App\ColorImage;
use App\Group;
use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('name','ASC')->get();
        return view('backend.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::orderBy('name','ASC')->get()->pluck('name','id');
        $groups = Group::orderBy('name','ASC')->get()->pluck('name','id');
        return view('backend.product.create',compact('brands','groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request;

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'model_number' => 'required|unique:products',
            'price' => 'required',
            'description' => 'required',
            'brand_id' => 'required',
            'group_id' => 'required',
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];

        }
        $inputs = $request->all();
        $inputs['slug'] = str_replace(" ", "-", trim(strtolower($inputs['name'])));
        $product = Product::create($inputs);
        foreach($inputs['color_name'] as $key => $color) {
                $path_one = 'storage/product/'.str_random(6) . '_' . time().'.jpg';
                file_put_contents($path_one,file_get_contents($request->file('image')[$key]));
            $product->colorImages()->create([
                'color_name' => $color,
                'color_code' => $inputs['color_code'][$key],
                'quantity' => $inputs['quantity'][$key],
                'image' => $path_one
            ]);

        }
        session()->flash('success', 'Product Created.');
        return [
            'status' => 'success',
            'return_url' => route('products.index')
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('backend.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $brands = Brand::orderBy('name','ASC')->get()->pluck('name','id');
        $groups = Group::orderBy('name','ASC')->get()->pluck('name','id');
        return view('backend.product.edit', compact('product','brands','groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return array|\Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'model_number' => "required|unique:products,model_number,$product->id,id",
            'price' => 'required',
            'description' => 'required',
            'brand_id' => 'required',
            'group_id' => 'required',
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];

        }
        $inputs = $request->all();
        $product->update($inputs);
        foreach($inputs['color_name'] as $key => $color) {
            $images = $product->colorImages()->get();
            if(isset($request->file('image')[$key])) {
                $path_one = 'storage/product/' . str_random(6) . '_' . time() . '.jpg';
                file_put_contents($path_one, file_get_contents($request->file('image')[$key]));
            }else{
                $path_one = $images[$key]->image;
            }
            if(isset($product->colorImages()->get()[$key])) {
                $product->colorImages()->get()[$key]->update([
                    'color_name' => $color,
                    'color_code' => $inputs['color_code'][$key],
                    'quantity' => $inputs['quantity'][$key],
                    'image' => $path_one
                ]);
            }
            else{
                $product->colorImages()->create([
                    'color_name' => $color,
                    'color_code' => $inputs['color_code'][$key],
                    'quantity' => $inputs['quantity'][$key],
                    'image' => $path_one
                ]);
            }
        }
        session()->flash('success', 'Product Updated.');
        return [
            'status' => 'success',
            'return_url' => route('products.index')
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return array|\Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (!request()->ajax()) {
            return false;
        }
        $product->delete();
        session()->flash('success', 'Product Deleted.');
        return [
            'status' => 'success',
            'return_url' => url('admin/products')
        ];
    }
    public function destroyColorImage($id)
    {
        if (!request()->ajax()) {
            return false;
        }
        ColorImage::find($id)->delete();
        session()->flash('success', 'Product Color And Image Deleted.');
        return [
            'status' => 'success',
//            'return_url' => url('admin/products')
        ];
    }
}
