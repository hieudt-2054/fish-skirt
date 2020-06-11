<?php

namespace App\Http\Controllers;

use Auth;
use App\CanNang;
use Illuminate\Http\Request;
use App\Http\Requests\CannangRequest;

class CanNangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(CannangRequest $request)
    {
        try {
            foreach ($request->all() as $item) {
                CanNang::create([
                    'user_id' => Auth::user()->id,
                    'socan' => (float) $item['socan'],
                    'ngay' => \Carbon\Carbon::createFromFormat('d/m/Y', $item['ngay'])->format('Y-m-d')
                ]);
            }
            return response()->json(['data' => 'success']);
        } catch (\Exception $e) {
            return response($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CanNang  $canNang
     * @return \Illuminate\Http\Response
     */
    public function show(CanNang $canNang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CanNang  $canNang
     * @return \Illuminate\Http\Response
     */
    public function edit(CanNang $canNang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CanNang  $canNang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CanNang $canNang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CanNang  $canNang
     * @return \Illuminate\Http\Response
     */
    public function destroy(CanNang $canNang)
    {
        //
    }
}
