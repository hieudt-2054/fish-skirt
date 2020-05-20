<?php

namespace App\Http\Controllers;

use App\SpendCategory;
use Illuminate\Http\Request;

class SpendCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(SpendCategory::all());
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SpendCategory  $spendCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SpendCategory $spendCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SpendCategory  $spendCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SpendCategory $spendCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SpendCategory  $spendCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpendCategory $spendCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SpendCategory  $spendCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpendCategory $spendCategory)
    {
        //
    }
}
