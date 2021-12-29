<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class ProductController extends Controller
{
    public function uploadFile(Request $request)
    {
        // $putFile = Storage::disk('s3')->putFile('public/images', $request->file('file'));
    }
}
