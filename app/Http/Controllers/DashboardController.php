<?php

namespace App\Http\Controllers;

use Auth;
use App\ThucPham;
use App\SpendDetail;
use App\Eating;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getData(Request $req)
    {
        $user = Auth::user();
        $now = $req->date ?? date('Y-m-d');
        $calo = $this->getCaloByDate($now);
        $weightNow = $this->getWeightByDate($now);
        $calo7Day = [];
        $weight7Day = [];
        for ($i=6; $i > 0; $i--) { 
            $time = date('Y-m-d', strtotime("-{$i} day"));
            $calo7Day[] = $this->getCaloByDate($time)['calo'];
            $weight7Day[] = $this->getWeightByDate($time)['socan'];
        }
        $calo7Day[] = $calo['calo'];
        $weight7Day[] = $weightNow['socan'];

        $data = [
            'id' => $user->id,
            'soSanpham' => ThucPham::count(),
            'soCalo' => $calo,
            'soCaloConLai' => $user->caloonday - $calo['calo'],
            'calo7Day' => $calo7Day,
            'weight7Day' => $weight7Day,
            'weightInDay' => $this->getWeightByDate($now, true),
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

    public function getWeightByDate($ngay, $showDay = false)
    {
        $user = Auth::user();
        $min = 100;
        $history = [];
        $dataEat = $user->cannangs()->where('ngay', $ngay)->get();
        foreach ($dataEat as $item) {
            if ($item->socan <= $min) {
                $min = $item->socan;
            }
            $history[] = $item->socan;
        }
        if ($showDay) {
            return $history;
        }
        return ['date' => $ngay, 'socan' => $min == 100 ? $user->cannang_from : $min];
    }

    public function getDataSpend()
    {
        $user = Auth::user();
        $now = date('Y-m-d');
        $thu = $this->getSpendByDate($now, SpendDetail::THU);
        $chi = $this->getSpendByDate($now, SpendDetail::CHI);

        $data = [
            'id' => $user->id,
            'thu' => $thu,
            'chi' => $chi,
        ];

        return response()->json(['data' => $data]);
    }

    public function getSpendByDate($ngay, $type)
    {
        $user = Auth::user();
        $total = 0;
        $dataEat = $user->spends()->where('ngay', $ngay)->where('loai_id', $type)->get();
        foreach ($dataEat as $item) {
            $total += $item->sotien;
        }

        return $total;
    }

}
