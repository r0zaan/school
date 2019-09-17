<?php

namespace App\Http\Controllers\Backend;

use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('name','ASC')->get();
        return view('backend.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'self_product' => 'required',
            'image' => 'required'
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];

        }
        $inputs = $request->all();
        if($request->hasFile('image')){
            $path_one = 'storage/brand/'.str_random(6) . '_' . time().'.'.$request->file('image')->getClientOriginalExtension();
            file_put_contents($path_one,file_get_contents($request->file('image')));
            $inputs['image'] = $path_one;
        } else {
            $inputs['image'] = "";
        }
        Brand::create($inputs);
        session()->flash('success', 'Brand Created.');
        return [
            'status' => 'success',
            'return_url' => route('brands.index')
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return view('backend.brand.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('backend.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return array|\Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'self_product' => 'required'
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];

        }
        $inputs = $request->all();
        if($request->hasFile('image')){
            $path_one = 'storage/brand/'.str_random(6) . '_' . time().'.'. $request->file('image')->getClientOriginalExtension();;
            file_put_contents($path_one,file_get_contents($request->file('image')));
            $inputs['image'] = $path_one;
        }else{
            $inputs['image'] = $brand->image;
        }
        $brand->update($inputs);
        session()->flash('success', 'Brand Updated.');
        return [
            'status' => 'success',
            'return_url' => route('brands.index')
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return array|\Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if (!request()->ajax()) {
            return false;
        }
        $brand->delete();
        session()->flash('success', 'Brand Deleted.');
        return [
            'status' => 'success',
            'return_url' => url('admin/brands')
        ];
    }
}
