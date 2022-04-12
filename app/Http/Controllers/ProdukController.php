<?php

namespace App\Http\Controllers;

use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nama' => 'required',
            'harga'=> 'required|numeric',
            'jenis' => 'required|in:makanan,minuman,makeup',
            'expired' => 'required|date'
        ]);

        if($validator->fails()){
            return response()->json($validator->messages())->setStatusCode(422);
        }

        $validated = $validator->validate();

        Product::create([
            'nama' => $validated['nama'],
            'harga' => $validated['harga'],
            'jenis' => $validated['jenis'],
            'expired' => $validated['expired']
        ]);

        return response()->json([
            'messages' => 'Data Berhasil Disimpan !'
        ])->setStatusCode(201);
    }

    public function show(){
        $products = Product::all();
        return response()->json($products)->setStatusCode(200);
    }

    public function detail($id){
        $products = Product::find($id);

        if ($products){
            return response()->json($products)->setStatusCode(200);
        }
        return response()->json([
            'messages'=>"Data tidak ditemukan"
        ])->setStatusCode(404);
    }

    public function filter($nama){
        $products = Product::where('nama','like','%'.$nama.'%')->get();

        if($products){
            return response()->json($products)->setStatusCode(200);
        }
        return response()->json([
            'messages' => 'produk tidak ditemukan'
        ])->setStatusCode(404);
    }

    public function update(Request $request, $id){

        //Validasi Data
        $validator = Validator::make($request->all(),[
            'nama' => 'required',
            'harga'=> 'required|numeric',
            'jenis' => 'required|in:makanan,minuman,makeup',
            'expired' => 'required|date'
        ]);
        if($validator->fails()){
            return response()->json($validator->messages())->setStatusCode(422);
        }

        $validated = $validator->validate();

        $checkData = Product::find($id);
            if($checkData){

                Product::where('id', $id)
                        ->update([
                            'nama' => $validated['nama'],
                            'harga' => $validated['harga'],
                            'jenis' => $validated['jenis'],
                            'expired' => $validated['expired']
                        ]);
                    
                return response()->json([
                    'messages' => "Data berhasil dirubah"
                ])->setStatusCode(200);

            }

            return response()->json([
                'messages' => "gagal rek!, delo meneh"
            ])->setStatusCode(404);

    }

    public function delete($id){
        $checkData = Product::find($id);

        if($checkData){
            Product::destroy($id);
            return response()->json([
                'messages' => "Data berhasil dihapus"
            ])->setStatusCode(200);
        }

        return response()->json([
            'messages' => 'Gagal dihapus, mungkin ini kenangan manis'
        ])->setStatusCode(404);
    }
}
