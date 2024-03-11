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
        if(count($data) != 0) {
            return response()->json([
                'status' => true,
                'message' => 'Data found !',
                'data' => $data
            ],200);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data empty'
            ],200);
        }
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

        if(!$validator->fails()) {
            $databuku->judul = $request->judul;
            $databuku->pengarang = $request->pengarang;
            $databuku->tanggal_publikasi = $request->tanggal_publikasi;

            $databuku->save();
            
            return response()->json([
                'status' => true,
                'message' => 'Data saved !'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data not saved !',
                'data' => $validator->errors()
            ]);
        }

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
                'message' => 'Data found',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data not found, please check ID !'
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


        if(empty($databuku)) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found, please check ID !'
            ]);
        } if(!$validator->fails()) {
            $databuku->judul = $request->judul;
            $databuku->pengarang = $request->pengarang;
            $databuku->tanggal_publikasi = $request->tanggal_publikasi;

            $databuku->save();

            return response()->json([
                'status' => true,
                'message' => 'Data has been updated !'
            ],200);
            
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data has not been updated !',
                    'data' => $validator->errors()
                ]);
            }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $databuku = Buku::find($id);

        if(!empty($databuku)) {
            $databuku->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data has been deleted !'
            ],200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Please check ID !'
            ],404);
        }
    }
}
