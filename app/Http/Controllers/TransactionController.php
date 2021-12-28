<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function checkout(Request $request)
    {
        $message = [
            'user_id.required' => 'Kolom user ID harus diisi!',
            'user_id.numeric' => 'Kolom user ID harus angka!',
            'product_id.required' => 'Kolom product ID harus diisi!',
            'product_id.numeric' => 'Kolom product ID harus angka!',
            'product_qty.required' => 'Kolom product quantity harus diisi!',
            'product_qty.numeric' => 'Kolom product quantity harus angka!',
        ];
        $validator = Validator::make($request->all(),[
            'user_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'product_qty' => 'required|numeric',

        ], $message);

        if( $validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
            ]);
        }else {
            try {
                $transaction = Transaction::create([
                    'user_id' => $request->user_id,
                    'product_id' => $request->product_id,
                    'product_qty' => $request->product_qty,
                ]);
                return response()->json([
                    'message' => 'Checkout Product Success',
                    'data' => ' '

                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'message' => 'Checkout Product Failed',
                ]);
            }
        }
    }

    public function userHistory($id)
    {
        try {
            $user = User::find($id);
            $product = Transaction::with('product')->where('user_id', $id)->get();
            return response()->json([
                'message' => 'Berhasil',
                'data' => [
                    'user' => $user,
                    'transaction' => $product,
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'History failed!'
            ]);
        }


    }
}
