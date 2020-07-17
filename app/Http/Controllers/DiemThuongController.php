<?php

namespace App\Http\Controllers;

use App\DiemThuong;
use Illuminate\Http\Request;
use Auth;

class DiemThuongController extends Controller
{
    public function index()
    {
        return DiemThuong::where('user_id', Auth::user()->id)->get();
    }

    public function store(Request $req)
    {
        $created = DiemThuong::create([
            'user_id' => Auth::user()->id,
            'card' => $req->card,
            'value_card' => $req->value_card
        ]);

        return response()->json(['data' => $created]);
    }

    public function getRequestPoints()
    {
        return DiemThuong::all();
    }
}
