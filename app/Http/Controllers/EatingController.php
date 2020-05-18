<?php

namespace App\Http\Controllers;

use App\Eating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EatingController extends Controller
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
    public function store(Request $request)
    {
        try {
            foreach ($request->all() as $item) {
                Eating::create([
                    'user_id' => Auth::user()->id,
                    'thucpham_id' => $item['thucpham_id'],
                    'sogram' => (float) $item['sogram'],
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
     * @param  \App\Eating  $eating
     * @return \Illuminate\Http\Response
     */
    public function show(Eating $eating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Eating  $eating
     * @return \Illuminate\Http\Response
     */
    public function edit(Eating $eating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Eating  $eating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Eating $eating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Eating  $eating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Eating $eating)
    {
        //
    }
}
