<?php

namespace App\Http\Controllers;

use App\DiemThuong;
use App\User;
use Illuminate\Http\Request;
use Auth;

class DiemThuongController extends Controller
{
    public function index()
    {
        $data = DiemThuong::where('user_id', Auth::user()->id)->latest()->get();

        $data = $data->map(function ($value) {
            return [
                'answer' => $value->answer,
                'card' => $value->card,
                'created_at' => $value->created_at->format('Y.m.d H:i:s'),
                'id' => $value->id,
                'status' => $value->status,
                'updated_at' => $value->updated_at,
                'user_id' => $value->user_id,
                'value_card' => $value->value_card
            ];
        });

        return response()->json($data);
    }

    public function store(Request $req)
    {
        $created = DiemThuong::create([
            'user_id' => Auth::user()->id,
            'card' => $req->card,
            'value_card' => $req->value_card
        ]);

        $u = User::find(Auth::user()->id);
        $value = $req->value_card / 1000;
        $u->diemthuong = $u->diemthuong - $value;
        $u->save();

        return response()->json(['data' => $created]);
    }

    public function getRequestPoints()
    {
        $data = DiemThuong::latest()->get();
        $data = $data->map(function ($value) {
            return [
                'answer' => $value->answer,
                'card' => $value->card,
                'created_at' => $value->created_at->format('Y.m.d H:i:s'),
                'id' => $value->id,
                'status' => $value->status,
                'updated_at' => $value->updated_at,
                'user_id' => $value->user_id,
                'value_card' => $value->value_card,
                'user_name' => $value->user->name
            ];
        });

        return response()->json($data);
    }

    public function progressPoints(Request $req)
    {
        $record = DiemThuong::find($req->id);
        $record->status = $req->status;
        $record->answer = $req->answer;
        $record->save();
        if ($req->status == 1) {
            $u = User::find($record->user->id);
            $value = $record->value_card / 1000;
            $u->diemthuong = $u->diemthuong - $value;
            $u->save();
        } else {
            $u = User::find($record->user->id);
            $value = $record->value_card / 1000;
            $u->diemthuong = $u->diemthuong + $value;
            $u->save();
        }

        return response()->json(true);
    }
}
