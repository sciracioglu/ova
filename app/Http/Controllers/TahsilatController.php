<?php

namespace App\Http\Controllers;

use App\Tahsilat;
use Illuminate\Support\Facades\DB;

class TahsilatController extends Controller
{
    public function index()
    {
        $yillar = Tahsilat::where('HESAPKOD', [session('musteri.hesapkod')])
                            ->groupBy('_EVRAKYIL')
                            ->get(DB::raw('_EVRAKYIL as yil, sum(EVRAKTUTAR) as evrak_tutuar, sum(TUTAR) as tutar'));

        $aylar = Tahsilat::where('HESAPKOD', [session('musteri.hesapkod')])
                            ->groupBy('_EVRAKYIL', '_EVRAKAY')
                            ->get(DB::raw('_EVRAKYIL as yil, _EVRAKAY as ay, sum(EVRAKTUTAR) as evrak_tutuar, sum(TUTAR) as tutar'));
        dd($aylar);
    }
}
