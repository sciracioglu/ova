<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class TahsilatController extends Controller
{
    public function index()
    {
        $tahsilatlar = collect(DB::select('EXEC [dbo].[spArgWebTahsilatRapor] ?', [session('musteri.hesapkod')]));
        $evrak_tutar = 0;
        $tutar = 0;
        $tasilat_kayit = $tahsilatlar->map(function ($tahsilat) use ($evrak_tutar, $tutar) {
            return [
                'yil' => $tahsilat->_EVRAKYIL,
                'ay' => $tahsilat->_EVRAKAY,
                'evrak_tutar' => $evrak_tutar,
                'tutar' => $tutar,
                'evrakno' => $tahsilat->EVRAKNO,
                'evrak_tarih' => $tahsilat->EVRAKTARIH,
                'hesapkod' => $tahsilat->HESAPKOD,
                'unvan' => $tahsilat->CARKRT_UNVAN,
                'karsi_hesap' => $tahsilat->KARSIHESAPKOD,
                'karsi_unvan' => $tahsilat->CRKKRS_UNVAN,
                'doviz' => $tahsilat->EVRAKDOVIZCINSI,
                'kur' => $tahsilat->EVRAKDOVIZKUR,
                'evrak_tip' => $tahsilat->EVRAKTIP,
                'aciklama' => $tahsilat->ACIKLAMA1,
            ];
        });
        dd($tasilat_kayit);
    }
}
