<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Havale;

class HavaleController extends Controller
{
    public function store(){
        list($gun1,$ay1,$yil1) = explode('/',request('tarih1'));
        list($gun2,$ay2,$yil2) = explode('/',request('tarih2'));

       $havaleler = Havale::whereBetween('EVRAKTARIH',[$yil1.$ay1.$gun1, $yil2.$ay2.$gun2])
                ->orderBy('EVRAKTARIH')
                ->get();
       return view('havale_liste',compact('havaleler'));
    }

    public function create(){
        return view('havale_create');
    }
}
