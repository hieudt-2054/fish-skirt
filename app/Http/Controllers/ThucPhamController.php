<?php

namespace App\Http\Controllers;

use App\ThucPham;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ThucPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ThucPham::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json(['data' => ThucPham::create($request->all())]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ThucPham  $thucPham
     * @return \Illuminate\Http\Response
     */
    public function show(ThucPham $thucPham)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ThucPham  $thucPham
     * @return \Illuminate\Http\Response
     */
    public function edit(ThucPham $thucPham)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ThucPham  $thucPham
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ThucPham $thucPham)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ThucPham  $thucPham
     * @return \Illuminate\Http\Response
     */
    public function destroy(ThucPham $thucPham)
    {
        //
    }

    public function fetchData(Request $request)
    {
        $client = new Client();
        $result = $client->request('GET', $request->url);
        return response()->json(['data' => $result->getBody()->getContents()]);
    }
}
