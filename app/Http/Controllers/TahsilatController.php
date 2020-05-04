<?php

namespace App\Http\Controllers;

use App\Tahsilat;
use Illuminate\Support\Facades\DB;

class TahsilatController extends Controller
{
    public function index()
    {
        $tahsilatlar = Tahsilat::where('HESAPKOD', [session('musteri.hesapkod')])
                            ->groupBy('_EVRAKYIL')
                            ->get(DB::raw('sum(EVRAKTUTAR) as evrak_tutuar, sum(TUTAR) as tutar'));
        dd($tahsilatlar);
        $tasilat_kayit = collect($tahsilatlar->map(function ($tahsilat) {
            return [
                'yil' => $tahsilat->_EVRAKYIL,
                'ay' => $tahsilat->_EVRAKAY,
                'evrak_tutar' => $tahsilat->EVRAKTUTAR,
                'tutar' => $tahsilat->TUTAR,
                'evrakno' => $tahsilat->EVRAKNO,
                'evrak_tarih' => $tahsilat->EVRAKTARIH,
                'hesapkod' => $tahsilat->HESAPKOD,
                'unvan' => $tahsilat->CARKRT_UNVAN,
                'karsi_hesap' => $tahsilat->KARSIHESAPKOD,
                'karsi_unvan' => $tahsilat->CRKKRS_UNVAN,
                'doviz' => isset($tahsilat->EVRAKDOVIZCINSI) ? $tahsilat->EVRAKDOVIZCINSI : '',
                'kur' => $tahsilat->EVRAKDOVIZKUR,
                'evrak_tip' => $tahsilat->EVRAKTIP,
                'aciklama' => $tahsilat->ACIKLAMA1,
            ];
        }));
        $yillar = $tasilat_kayit->groupBy('yil');
        dump($yillar);
        $aylar = $yillar->groupBy('ay');
        dd($aylar);
        dd($tasilat_kayit->groupBy('yil')->sum('evrak_tutar'));
    }
}
