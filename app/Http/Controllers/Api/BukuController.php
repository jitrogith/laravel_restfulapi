<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Buku::orderBy('id', 'desc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data found !',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $databuku = new Buku;
        
        $rules = [
            'judul' => 'required',
            'pengarang' => 'required',
            'tanggal_publikasi' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Fails to store data !',
                'data' => $validator->errors()
            ]);
        }
        

        $databuku->judul = $request->judul;
        $databuku->pengarang = $request->pengarang;
        $databuku->tanggal_publikasi = $request->tanggal_publikasi;

        $databuku->save();

        return response()->json([
            'status' => true,
            'message' => 'Data save succeed !',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Buku::find($id);
        if($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data found !',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data not found !'
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
