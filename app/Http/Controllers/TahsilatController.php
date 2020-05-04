<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class TahsilatController extends Controller
{
    public function index()
    {
        $tahsilatlar = collect(DB::select('EXEC [dbo].[spArgWebTahsilatRapor] ?', [session('musteri.hesapkod')]));

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
                // 'doviz' => $tahsilat->EVRAKDOVIZCINSI,
                'kur' => $tahsilat->EVRAKDOVIZKUR,
                'evrak_tip' => $tahsilat->EVRAKTIP,
                'aciklama' => $tahsilat->ACIKLAMA1,
            ];
        }));
        dump($tasilat_kayit->groupBy('yil'));
        dd($tasilat_kayit->groupBy('yil')->sum('evrak_tutar'));
    }
}
