<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gregwar\Captcha\CaptchaBuilder;

class LoginController extends Controller
{
    public function guvenlikKodu()
    {
        $builder = new CaptchaBuilder();
        $builder->build();
        session()->put('phrase', $builder->getPhrase());

        return $builder->inline();
    }

    //
    public function getLogin()
    {
        $metin = $this->guvenlikKodu();

        return view('login.login', compact('metin'));
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'kullanici' => 'required',
            'sifre' => 'required|min:4',
            'gkod' => 'required|min:3'
        ]);
        if (session('phrase') != $request->get('gkod')) {
            return redirect('/login')->with('warning', 'Güvenlik kodu hatalı!');
        }

        $kullanicilar = DB::select('select dbo.CheckPassword(?,WEBPASSWORD) AS SAYI FROM  vwwusr WHERE USERNAME =?', [
            $request->get('sifre'),
            $request->get('kullanici')
        ]);

        if (!$kullanicilar) {
            return Redirect::to('login')->with('warning', 'Hatali bilgi girdiniz!');
        }

        $eposta = DB::select('SELECT EMAIL FROM vwwusr WHERE USERNAME	 =?', [
            $request->get('kullanici')
        ]);

        $tip = DB::select("SELECT KOD, SUBSTRING( dbo.refkrt.ACIKLAMA,5,100) ACIKLAMA FROM refkrt
							WHERE dbo.refkrt.ALANAD	='EVRAKTIP' AND dbo.refkrt.TABLOAD	='EVRBAS'");
        $evraktip = [];
        foreach ($tip as $t) {
            $evraktip[$t->KOD] = $t->ACIKLAMA;
        }
        Session::put('evraktip', $evraktip);

        foreach ($kullanicilar as $k) {
            if ($k->SAYI == 1) {
                session()->put('kullanici.username', $request->get('kullanici'));

                return Redirect::to('/');
            }
        }

        return Redirect::to('login')->with('warning', 'Hatalı bilgi girdiniz!');
    }

    public function logout()
    {
        Session::flush();

        return Redirect::to('/login');
    }
}
