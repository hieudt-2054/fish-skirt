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
        $now = date('Y-m-d');
        $calo = $this->getCaloByDate($now);
        $calo7Day = [];
        for ($i=6; $i > 0; $i--) { 
            $time = date('Y-m-d', strtotime("-{$i} day"));
            $calo7Day[] = $this->getCaloByDate($time)['calo'];
        }
        $calo7Day[] = $calo['calo'];

        $data = [
            'id' => $user->id,
            'soSanpham' => ThucPham::count(),
            'soCalo' => $calo,
            'soCaloConLai' => $user->caloonday - $calo['calo'],
            'calo7Day' => $calo7Day,
        ];

        return response()->json(['data' => $data]);
    }

    public function calculateCaloFromThucPham($thucPhamId, $soGram)
    {
        $prod = ThucPham::find($thucPhamId);
        if (!is_null($prod)) {
            $avg = $prod->nangluong / 100;
            return ['name' => $prod->tensp, 'calo' => $avg * $soGram];
        } else {
            return ['name' => 'Err', 'calo' => 0];
        }
    }

    public function getCaloByDate($ngay)
    {
        $user = Auth::user();
        $calo = 0;
        $history = [];
        $dataEat = $user->eatings()->where('ngay', $ngay)->get();
        foreach ($dataEat as $item) {
            $data = $this->calculateCaloFromThucPham($item->thucpham_id, $item->sogram);
            $calo += $data['calo'];
            $history[] = $data;
        }

        return ['history' => $history, 'calo' => $calo];
    }
}
