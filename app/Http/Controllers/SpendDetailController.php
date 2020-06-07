<?php

namespace App\Http\Controllers;

use Auth;
use App\SpendDetail;
use Illuminate\Http\Request;

class SpendDetailController extends Controller
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
        \DB::beginTransaction();
        try {
            foreach ($request->all() as $item) {
                SpendDetail::create([
                    'user_id' => Auth::user()->id,
                    'sotien' => (float) $item['sotien'],
                    'mota' => $item['mota'],
                    'loai_id' => $item['loai'],
                    'category_id' => $item['danhmuc'],
                    'ngay' => \Carbon\Carbon::createFromFormat('d/m/Y', $item['ngay'])->format('Y-m-d')
                ]);
            }
            // return response()->json(['data' => 'success']);

            \DB::commit();

            return response()->json(['data' => 'success']);
        } catch (\Exception $e) {
            \DB::rollBack();

            return response($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SpendDetail  $spendDetail
     * @return \Illuminate\Http\Response
     */
    public function show(SpendDetail $spendDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SpendDetail  $spendDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(SpendDetail $spendDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SpendDetail  $spendDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpendDetail $spendDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SpendDetail  $spendDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpendDetail $spendDetail)
    {
        //
    }
}
