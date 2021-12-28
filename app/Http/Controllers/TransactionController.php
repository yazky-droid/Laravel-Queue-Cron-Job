<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function checkout(Request $request)
    {
        $message = [
            'user_id.required' => 'Kolom User ID harus di isi !',
            'user_id.numeric' => 'Kolom User ID harus Angka !',
            'product_id.required' => 'Kolom Produk ID harus di isi !',
            'product_id.numeric' => 'Kolom Produk ID harus Angka !',
            'product_qty.required' => 'Kolom Product Kuantiti harus di isi !',
            'product_qty.numeric' => 'Kolom Product Kuantiti harus Angka !'
        ];

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'product_qty' => 'required|numeric'
        ], $message);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ]);
        } else {
            try {
                $expiredTime = date('Y-m-d H:i:s', strtotime('+1 hour', strtotime('Y-m-d H:i:s')));
                $transaction = Transaction::create([
                    'user_id' => $request->user_id,
                    'product_id' => $request->product_id,
                    'product_qty' => $request->product_qty,
                ]);

                return response()->json([
                    'message' => 'Add to transaction success',
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'message' => 'Add to transaction Failed'
                ]);
            }
        }
    }

    public function userHistory($id)
    {
        try {
            $user = User::find($id);
            $transaction = Transaction::with('product')->where('user_id', $id)->get();

            return response()->json([
                'message' => 'Success',
                'data' => [
                    'user' => $user,
                    'data' => $transaction
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Get data failed !'
            ], 400);
        }
    }
}
