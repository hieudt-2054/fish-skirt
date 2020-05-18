<?php

namespace App\Http\Controllers;

use Auth;
use App\ThucPham;
use App\Eating;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getData()
    {
        $user = Auth::user();
        $calo = 0;
        $now = date('Y-m-d');
        $dataEat = $user->eatings()->where('ngay', $now)->get();
        foreach ($dataEat as $item) {
            $calo += $this->calculateCaloFromThucPham($item->thucpham_id, $item->sogram);
        }
        $data = [
            'id' => $user->id,
            'soSanpham' => ThucPham::count(),
            'soCalo' => $calo,
            'soCaloConLai' => $user->caloonday - $calo,
        ];

        return response()->json(['data' => $data]);
    }

    public function calculateCaloFromThucPham($thucPhamId, $soGram)
    {
        $prod = ThucPham::find($thucPhamId);
        if (!is_null($prod)) {
            $avg = $prod->nangluong / 100;
            return $avg * $soGram;
        } else {
            return 0;
        }
    }
}
