<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'message'=>'success',
            'data'=>Product::all()
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name'=>'required',
            'product_price'=>'required|numeric',
            'image'=>'required|mimes:jpg,png,jpeg'
        ]);
        try {
            $image = $request->image->store('/images','s3','public');
            $url = Storage::disk('s3')->url($image);
            // return ['url'=>$url,'name'=>basename($image)];
            $product = Product::create([
                'product_name'=>$request->product_name,
                'product_price'=>$request->product_price,
                'image_name'=>basename($image),
                'image_url'=>$url
            ]);
            return response()->json([
                'message'=>'success',
                'data'=>$product
            ],201);
        } catch (\Throwable $th) {
            // return $th;
            return response()->json([
                'message'=>'failed',
                'data'=>$th
            ],400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // return Storage::disk('s3')->response('images/' . $product->image_name);
        return response()->json([
            'message'=>'success',
            'data'=>$product
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            //code...
            Storage::disk('s3')->delete($product->image_name);
            $product->delete();
            return response()->json([
                'message'=>'success'
            ],200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message'=>'failed'
            ],400);
        }
    }
}
