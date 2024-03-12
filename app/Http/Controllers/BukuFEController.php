<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class BukuFEController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client;
        $url = 'https://api.jsbapps.store/api/buku';

        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if($contentArray['status'] === true) {
            $data = $contentArray['data'];
            return view('buku.index', compact('data'));
        } else {
            echo "Data not found !";
        }

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
        $url = 'https://api.jsbapps.store/api/buku';

        $params = [
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'tanggal_publikasi' => $request->tanggal_publikasi,
        ];

        $response = $client->request('POST', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($params)
        ]);

        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if($contentArray['status'] === true) {
            return redirect()->to('buku')->with('success', $contentArray['message']);
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
        $client = new Client;
        $url = 'https://api.jsbapps.store/api/buku'.$id;

        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if($contentArray['status'] === true) {
            $data = $contentArray['data'];
            return view('buku.index', compact('data'));
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
        $url = 'https://api.jsbapps.store/api/buku/'.$id;

        $params = [
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'tanggal_publikasi' => $request->tanggal_publikasi
        ];

        $response = $client->request('PUT', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($params)
        ]);

        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if($contentArray['status'] === true) {
            return redirect()->to('buku')->with('success', $contentArray['message']);
        } else {
            $error = $contentArray['data'];
            return redirect()->back()->withErrors($error)->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = new Client;
        $url = 'https://api.jsbapps.store/api/buku/'.$id;

        $response = $client->request('DELETE', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if($contentArray['status'] === true) {
            return redirect()->back()->with('success', $contentArray['message']);
        } else {
            $error = $contentArray['message'];
            return redirect()->back()->withErrors($error);
        }
    }
}
