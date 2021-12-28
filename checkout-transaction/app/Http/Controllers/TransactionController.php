<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Validator;

class TransactionController extends Controller
{

    public function index(Type $var = null)
    {
        $transaction = Transaction::all();

        if ($transaction) {
            $response = [
                'message' => 'Berhasil',
                'data' => $transaction
            ];

            return response()->json($response, 200);
        } else {
            $response = [
                'message' => 'Produk Tidak Ditemukan!',
                'data' => null
            ];

            return response()->json($response, 400);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'qty' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            $response = [
                'message' => $validator->errors(),
                'data' => null,
            ];
            return response()->json($response, 400);
        }

        $transaksi = new Transaction();
    }
}
