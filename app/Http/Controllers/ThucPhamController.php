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
        $unique = ThucPham::where('tensp', $request->tensp)->get();
        if (count($unique)) {
            return response()->json(['msg' => 'Bị trùng dữ liệu'], 500);
        }

        return response()->json(['data' => ThucPham::create($request->all())]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ThucPham  $thucPham
     * @return \Illuminate\Http\Response
     */
    public function show($thucPham)
    {
        return response()->json(['data' => ThucPham::find($thucPham)]);
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
        try {
            $tp = ThucPham::find($request->id);
            return response()->json(['status' => $tp->update($request->except(['created_at', 'updated_at']))]);
        } catch (\Exception $ex) {
            return response()->json(['status' => 'error'], 500);
        }
        
    }

    public function deletetp($thucPham)
    {
        $data =ThucPham::where('id', $thucPham)->firstOrFail();

        return response()->json(['data' => $data->delete()]);
    }

    public function fetchData(Request $request)
    {
        $client = new Client();
        $result = $client->request('GET', $request->url);
        return response()->json(['data' => $result->getBody()->getContents()]);
    }
}
