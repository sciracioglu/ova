<?php

namespace App\Http\Controllers;

use App\Tahsilat;
use Illuminate\Support\Facades\DB;

class TahsilatController extends Controller
{
    public function index()
    {
        $data = [];
        $data['yillar'] = Tahsilat::where('HESAPKOD', [session('musteri.hesapkod')])
                            ->groupBy('_EVRAKYIL')
                            ->get(DB::raw('_EVRAKYIL as yil, sum(EVRAKTUTAR) as evrak_tutar, sum(TUTAR) as tutar'));

        $data['aylar'] = Tahsilat::where('HESAPKOD', [session('musteri.hesapkod')])
                            ->groupBy('_EVRAKYIL', '_EVRAKAY')
                            ->get(DB::raw('_EVRAKYIL as yil, _EVRAKAY as ay, sum(EVRAKTUTAR) as evrak_tutar, sum(TUTAR) as tutar'));
        $data['tahsilatlar'] = Tahsilat::where('HESAPKOD', [session('musteri.hesapkod')])->get();

        return view('tahsilat', $data);
    }
}
