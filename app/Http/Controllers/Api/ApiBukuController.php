<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $databuku = Buku::orderBy('id', 'desc')->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Data found !',
            'data' => $databuku
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
                'message' => 'Data saved failed, please complete the fields !',
                'data' => $validator->errors()
            ]);
        } else {
            $databuku->judul = $request->judul;
            $databuku->pengarang = $request->pengarang;
            $databuku->tanggal_publikasi = $request->tanggal_publikasi;
            $databuku->save();

            return response()->json([
                'status' => true,
                'message' => 'Data save success !',
                'data' => $databuku
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $databuku = Buku::find($id);

        if($databuku) {
            return response()->json([
                'status' => true,
                'message' => 'Data found !',
                'data' => $databuku
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data not found, Please check the ID !'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $databuku = Buku::find($id);
        $rules = [
            'judul' => 'required',
            'pengarang' => 'required',
            'tanggal_publikasi' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $rules);
        if(!$databuku) {
            return response()->json([
                'status' => false,
                'message' => 'The ID not found !',
            ]);
        } elseif($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data saved failed, please complete the fields !',
                'data' => $validator->errors()
            ]);
        } else {
            $databuku->judul = $request->judul;
            $databuku->pengarang = $request->pengarang;
            $databuku->tanggal_publikasi = $request->tanggal_publikasi;
            $databuku->save();

            return response()->json([
                'status' => true,
                'message' => 'Data update success !',
                'data' => $databuku
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $databuku = Buku::find($id);

        if($databuku) {
            $databuku->delete();
            return response()->json([
                'status' => true,
                'message' => 'Data delete success !',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Delete failed, please check the ID !'
            ]);
        }
    }
}
