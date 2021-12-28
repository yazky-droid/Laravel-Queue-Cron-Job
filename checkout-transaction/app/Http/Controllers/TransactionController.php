<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class TransactionController extends Controller
{

    public function history($id)
    {

        $transaction = Transaction::where('user_id', $id)->get();

        if ($transaction != null) {
            $response = [
                'message' => 'Berhasil',
                'data' => $transaction
            ];

            return response()->json($response, 200);
        }

        if ($transaction == null) {
            $response = [
                'message' => 'Transaksi Tidak Ditemukan!',
                'data' => null
            ];

            return response()->json($response, 400);
        }
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'qty' => 'required|numeric',
            'product_id' => 'required|numeric',
            'user_id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            $response = [
                'message' => $validator->errors(),
                'data' => null,
            ];
            return response()->json($response, 400);
        }

        //cek produk
        $dataProduk = Product::where('id', $request->product_id)->first();

        if (!$dataProduk) {
            $response = [
                'message' => 'Produk Tidak Ditemukan!',
                'data' => null
            ];

            return response()->json($response, 400);
        }

        //cek data user
        $dataUser = User::where('id', $request->user_id)->first();

        if (!$dataUser) {
            $response = [
                'message' => 'User Tidak Ditemukan!',
                'data' => null
            ];

            return response()->json($response, 400);
        }


        //save transaksi
        $transaksi = new Transaction();
        $expire = date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))));
        $transaksi->expired_at = $expire;
        $transaksi->qty = $request->qty;
        $transaksi->total = $request->qty * $dataProduk->price;
        $transaksi->product_id = $request->product_id;
        $transaksi->user_id = $request->user_id;

        if (!$transaksi->save()) {
            $response = [
                'message' => 'Gagal Menyimpan Data!',
                'data' => null,
            ];

            return response()->json($response, 400);
        }

        if ($transaksi->save()) {
            $response = [
                'message' => 'Checkout Berhasil!',
                'data' => $transaksi,
            ];

            return response()->json($response, 200);
        }
    }
}
