<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Storage;

class ProductController extends Controller
{
    public function store(ProductRequest $request)
    {
        $pathFile = Storage::disk('public')->putFile('products', $request['img']);

        $product = new Product();
        $product->name = $request['name'];
        $product->price = $request['price'];
        $product->img = $pathFile;
        if (!$product->save()) {
            Storage::delete('public/' . $pathFile);
        }

        $data['message'] = 'Berhasil';
        $data['data'] = $product;
        return response()->json($data, 200);
    }

    public function getAll()
    {
        $products = Product::all();
        $data['message'] = 'Berhasil';
        $data['data'] = $products;
        return response()->json($data, 200);
    }
}
