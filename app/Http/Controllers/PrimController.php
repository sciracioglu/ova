<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VwWebSatisPrimIade;

class PrimController extends Controller
{

    private $hesapkod;

    function __construct()
    {

        $this->middleware(function ($request, $next) {

            $this->hesapkod = session('musteri.hesapkod');

            return $next($request);
        });


    }


    public function index()
    {
        $data['tipler'] = VwWebSatisPrimIade::where('HESAPKOD',$this->hesapkod)
                                            ->groupBy('EVRAKTIP','EVRAKTIPAD')
                                            ->get([
                                                'EVRAKTIP',
                                                'EVRAKTIPAD',
                                                \DB::raw('sum(TOPLAM) AS GENELTOPLAM'),
                                                \DB::raw('sum(NETTUTAR) AS GENELNETTOPLAM'),
                                                \DB::raw('sum(KDV) AS GENELKDV')
                                                ]);

        $data['yillar'] = VwWebSatisPrimIade::where('HESAPKOD',$this->hesapkod)
                                            ->groupBy('EVRAKTIP','EVRAKYIL')
                                            ->get([
                                                'EVRAKYIL',
                                                'EVRAKTIP',
                                                \DB::raw('sum(TOPLAM) AS GENELTOPLAM'),
                                                \DB::raw('sum(NETTUTAR) AS GENELNETTOPLAM'),
                                                \DB::raw('sum(KDV) AS GENELKDV')
                                            ]);

        $data['aylar'] = VwWebSatisPrimIade::where('HESAPKOD',$this->hesapkod)
                                            ->groupBy('EVRAKTIP','EVRAKYIL','EVRAKAY')
                                            ->get([
                                                'EVRAKTIP',
                                                'EVRAKYIL',
                                                'EVRAKAY',
                                                \DB::raw('sum(TOPLAM) AS GENELTOPLAM'),
                                                \DB::raw('sum(NETTUTAR) AS GENELNETTOPLAM'),
                                                \DB::raw('sum(KDV) AS GENELKDV')
                                                ]);

        $data['veriler'] = VwWebSatisPrimIade::where('HESAPKOD',$this->hesapkod)
                                                ->get(); 
        
        return view('prim',$data);
    }
}
