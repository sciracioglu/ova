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
        $tasilat_yil = $tahsilatlar->groupBy('EVRAKYIL')
                                ->each(function ($tahsilat) use ($evrak_tutar,$tutar) {
                                    dd($tahsilat);
                                    $evrak_tutar += $tahsilat['EVRAKTUTAR'];
                                    $tutar += $tahsilat['TUTAR'];
                                })
                                ->map(function ($tahsilat) use ($evrak_tutar, $tutar) {
                                    return ['yil' => $tahsilat['_EVRAKYIL'],
                                        'evrak_tutar' => $evrak_tutar,
                                        'tutar' => $tutar];
                                });
        dd($tasilat_yil);
    }
}
