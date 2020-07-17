<?php

namespace App\Http\Controllers;

use Auth;
use App\ThucPham;
use App\SpendDetail;
use App\Eating;
use App\Mail\MailNotify;
use Illuminate\Http\Request;
use Mail;

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
            $beforeDay = date_create($now);
            date_sub($beforeDay, date_interval_create_from_date_string("{$i} day"));
            $time = $beforeDay->format('Y-m-d');
            $calo7Day[] = $this->getCaloByDate($time)['calo'];
            $weight7Day[] = $this->getWeightByDate($time)['socan'];
        }
        $calo7Day[] = $calo['calo'];
        $weight7Day[] = $weightNow['socan'];

        $data = [
            'id' => $user->id,
            'soSanpham' => ThucPham::active()->count(),
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
        $temp = $user->cannang_from;
        if ($min == 100) {
            $data = [];
            $i = 1;
            $count = 0;
            if ($user->cannang_from !== 0) {
                while (count($data) == 0  && $count != 7) {
                    $beforeDay = date_create($ngay);
                    date_sub($beforeDay, date_interval_create_from_date_string("{$i} day"));
                    $data = $this->getWeightByDate($beforeDay, true);
                    $i++;
                    $count++;
                }
                if (count($data)) {
                    sort($data);
                    $temp = $data[0];
                }
            }
        }
        return ['date' => $ngay, 'socan' => $min == 100 ? $temp : $min];
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

    public function sendEmail()
    {
      $user = auth()->user();
    //   dd($user->name);
      Mail::to($user)->send(new MailNotify($user));
    }
}
