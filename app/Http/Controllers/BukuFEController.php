<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class BukuFEController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $client = new Client;
        $url = 'http://127.0.0.1:8000/api/buku';
        $response = $client->request('GET', $url);

        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];

        return view('index', compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $client = new Client;
        $url = 'http://127.0.0.1:8000/api/buku';

        $judul = $request->judul;
        $pengarang = $request->pengarang;
        $tanggal_publikasi = $request->tanggal_publikasi;

        $param = [
            'judul' => $judul,
            'pengarang' => $pengarang,
            'tanggal_publikasi' => $tanggal_publikasi,
        ];

        $response = $client->request('POST', $url, [
            'headers' => ['Content-Type'=>'application/json'],
            'body' => json_encode($param)
        ]);

        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if($contentArray['status'] === true) {
            return redirect()->to('buku')->with('success', 'Data berhasil disimpan !');
        } else {
            $error = $contentArray['data'];
            return redirect()->to('buku')->withErrors($error)->withInput();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = new Client();
        $url = 'http://localhost:8000/api/buku/'.$id;
        $response = $client->request('GET', $url);

        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
       
        if($contentArray['status'] === true) {
            $data = $contentArray['data'];
            return view('index', compact('data'));
        } else {
            $error = $contentArray['message'];
            return redirect()->to('buku')->withErrors($error);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = new Client;
        $url = 'http://127.0.0.1:8000/api/buku/'.$id;

        $parameter = [
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'tanggal_publikasi' => $request->tanggal_publikasi,
        ];

        $response = $client->request('PUT', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($parameter)
        ]);

        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if($contentArray['status'] === true) {
            return redirect()->to('buku')->with('success', 'Data has been updated !');
        } else {
            $error = $contentArray['data'];
            return redirect()->to('buku')->withErrors($error)->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = new Client;
        $url = 'http://127.0.0.1:8000/api/buku/'.$id;

        $response = $client->request('DELETE', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if($contentArray['status'] === true) {
            return redirect()->to('buku')->with('success', 'Data has been deleted !');
        } else {
            $error = $contentArray['message'];
            return redirect()->to('buku')->withErrors($error);
        }
    }
}
