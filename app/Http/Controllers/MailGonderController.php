<?php

namespace app\Http\Controllers;


use App\Mail\Cari;
use App\Mail\Cek;
use App\Mail\Detay;
use App\Mail\Geciken;
use App\Mail\Risk;
use App\Mail\SatisAnaliz;
use App\Mail\SatisAnalizMiktar;
use App\Mail\SatisRaporu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Validator;

class MailGonderController
{
    public function satis_analiz_miktar(Request $request){
        $validator =Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        Mail::to($request->email)->send(new SatisAnalizMiktar());
        session()->flash('mesaj','Mail gonderildi!');
        return back();
    }

    public function satis_analiz(Request $request){
        $validator =Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        Mail::to($request->email)->send(new SatisAnaliz());
        session()->flash('mesaj','Mail gonderildi!');
        return back();
    }

    public function satis(Request $request){
        $validator =Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        Mail::to($request->email)->send(new SatisRaporu());
        session()->flash('mesaj','Mail gonderildi!');
        return back();
    }

    public function risk(Request $request){
        $validator =Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        Mail::to($request->email)->send(new Risk());
        session()->flash('mesaj','Mail gonderildi!');
        return back();
    }

    public function cari(Request $request){
        $validator =Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        Mail::to($request->email)->send(new Cari());
        session()->flash('mesaj','Mail gonderildi!');
        return back();
    }

    public function cek(Request $request){
        $validator =Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        Mail::to($request->email)->send(new Cek());
        session()->flash('mesaj','Mail gonderildi!');
        return back();
    }

    public function geciken_bakiye(Request $request){
        $validator =Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        Mail::to($request->email)->send(new Geciken());
        session()->flash('mesaj','Mail gonderildi!');
        return back();
    }

	public function bakiye_detay(Request $request){
        $validator =Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        Mail::to($request->email)->send(new Detay());
        session()->flash('mesaj','Mail gonderildi!');
        return back();
    }
}