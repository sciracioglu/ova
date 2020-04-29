<?php

namespace App\Http\Controllers;

use App\VW_ARG_WEB_CIRO_RAPOR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CiroController extends Controller
{
    private $hesapkod;
    function __construct()
    {

        $this->middleware(function ($request, $next) {

            $this->hesapkod = session('musteri.hesapkod');
            // $this->odeme = VWSIP_ODEMESEKLI::all();
            // $this->nakliye = VWSIP_NAKLIYETIPI::all();
            // $this->sevk = VWSIP_SEVKYERI::where('ANAHESAPKOD', session('musteri.hesapkod'))->get();

            return $next($request);
        });
    }

    public function store(){
        list($gun1,$ay1,$yil1) = explode('/',request('tarih1'));
        list($gun2,$ay2,$yil2) = explode('/',request('tarih2'));
        $tarih1 = $yil1.$ay1.$gun1;
        $tarih2 = $yil2.$ay2.$gun2;
       $cirolar = DB::select('exec dbo.[spArgWebCiroRapor] ?, ?, ?',[$this->hesapkod, $tarih1, $tarih2]);

               
       return view('ciro_liste',compact('cirolar'));
    }

    public function create(){
        return view('ciro_create');
    }
}
