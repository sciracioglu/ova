<?php namespace App\Http\Controllers;

use App\CARKRT;
use App\EVRBAS;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Mail\SatisAnalizMiktar;
use App\STKHAR;
use App\VWSIP_NAKLIYETIPI;
use App\VWSIP_ODEMESEKLI;
use App\VWSIP_SEVKYERI;
use App\VWSIP_STOKKART;
use App\VWWSIP;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MusteriController extends Controller
{

    private $hesapkod;
    private $odeme;
    private $nakliye;
    private $sevk;

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

    public function siparis()
    {

        if (session()->has('evrakno')) {
            session()->forget('evrakno');
        }
        $odeme = $this->odeme;
        $nakliye = $this->nakliye;
        $sevk = $this->sevk;


        $odm = [];
        foreach ($odeme as $o) {
            $odm[$o->KOD] = $o->ACIKLAMA;
        }
        $nak = [];
        foreach ($nakliye as $n) {
            $nak[$n->KOD] = $n->ACIKLAMA;
        }
        $svk = [];
        foreach ($sevk as $s) {
            $svk[$s->HESAPKOD] = $s->SEVKUNVAN;
        }


        return view('siparis', compact('odm', 'nak', 'svk'));

    }

    public function opsiyon(Request $request)
    {
        $tarih = Carbon::now()->addDays($request->get('ops'));
        $tarih = $tarih->format('d.m.Y');
        return $tarih;
    }

    public function siparisDuzenle($id)
    {
        session()->put('evrakno', $id);

        $siparis = DB::table('XARWSB')->where('HESAPKOD', session('musteri.hesapkod'))->where('EVRAKNO', $id)->first();


        $odeme = $this->odeme;
        $nakliye = $this->nakliye;
        $sevk = $this->sevk;

        $odm = [];
        foreach ($odeme as $o) {
            $odm[$o->KOD] = $o->ACIKLAMA;
        }
        $nak = [];
        foreach ($nakliye as $n) {
            $nak[$n->KOD] = $n->ACIKLAMA;
        }
        $svk = [];
        foreach ($sevk as $s) {
            $svk[$s->HESAPKOD] = $s->SEVKUNVAN;
        }


        return view('siparis_edit', compact('siparis', 'odm', 'nak', 'svk'));
    }


    public function urunSevk(Request $request)
    {
        $sevk = VWSIP_SEVKYERI::where('HESAPKOD', $request->get('hsp'))->first();

        return $sevk->TESLIMADRES1 . ' ' . $sevk->TESLIMADRES2 . ' ' . $sevk->TESLIMADRES3 . ' ' . $sevk->TESLIMADRES4 . ' ' . $sevk->SEHIRAD;
    }

    public function urunFiyat(Request $request)
    {

        $fiyat = DB::select("exec dbo.[spArgWebGetFiyatIskonto] ?,?", [$request->get('kod'), session('musteri.hesapkod')]);
        foreach ($fiyat as $f) {
            $fyt['liste'] = number_format($f->FIYAT, 2, '.', ',');
            $fyt['iskonto'] = $f->ISKONTOORAN;
            $fyt['kdv'] = number_format($f->KDVORAN, 2, '.', ',');

            $iskonto = $f->FIYAT - (($f->FIYAT * $f->ISKONTOORAN) / 100);
            $fyt['fiyat'] = number_format($iskonto, 2, '.', ',');
        }

        return json_encode($fyt);
    }

    public function urunListe()
    {
        $urun_liste = VWSIP_STOKKART::all();
        $grup_liste = DB::select('SELECT GRUPKOD FROM VWSIP_STOKKART GROUP BY GRUPKOD');


        return view('siparis_urun_liste', compact('urun_liste', 'grup_liste'));
    }

    public function siparislerim()
    {
        $siparisler = DB::select("SELECT * FROM XARWSB WHERE EVRAKDURUM = 0 AND KULLANICI =?", [session('kullanici.username')]);

        return view('siparislerim', compact('siparisler'));
    }


    public function postSiparis(Request $request)
    {


        $response['status'] = 0;
        if (!session()->has('evrakno')) {
            $evrakno = DB::select("EXEC [dbo].[spSipGetEvrakNo]");
            session()->put('evrakno', $evrakno[0]->EVRAKNO);

            list($g, $a, $y) = explode('/', $request->get('teslim'));
            $teslim_tarihi = $y . $a . $g;
            $ops = (int)$request->get('opsiyon');
            $evrakno = session('evrakno');
            $aciklama = $request->get('aciklama');
            $sevk = $request->get('sevk');
            $odeme = $request->get('odeme');
            $nakliye = $request->get('nakliye');
            $kullanici = session('kullanici.username');
            $ust_baslik = DB::select("EXEC [dbo].[spSipInsEvrBas] '{session('musteri.hesapkod')}','{$sevk}','{$odeme}','{$nakliye}','{$teslim_tarihi}',{$ops},'{$aciklama}', '{$evrakno}','{$kullanici}'");

        }
        $evrakno = session('evrakno');

        /*
        Kalem Kaydi
        */
        $kdv = 0;
        if ($request->has('kdv')) {
            $kdv = 1;
        }

        $malkod = $request->get('malkod');
        $oran = $request->get('oran');
        $fiyat = $request->get('fiyat');
        $urun_fiyat = $request->get('urun_fiyat');
        $miktar = $request->get('miktar');

        $kalem = DB::select("EXEC [dbo].[spSipInsStkHar] '{$evrakno}','{session('musteri.hesapkod')}', '{$malkod}','{$oran}','{$urun_fiyat}','{$fiyat}','{$kdv}','{$miktar}'");


        $response['status'] = 1;
        return $response;

    }

    public function siparisGuncel(Request $request, $id)
    {
        $response['status'] = 0;

        /*
         * Siparis basligi duzenleme eklenecek.
         */
        $evrakno = $id;
        /*
                Kalem Kaydi
                */
        $kdv = 0;
        if ($request->has('kdv')) {
            $kdv = 1;
        }

        $malkod = $request->get('malkod');
        $oran = $request->get('oran');
        $fiyat = $request->get('fiyat');
        $urun_fiyat = $request->get('urun_fiyat');
        $miktar = $request->get('miktar');

        DB::select("EXEC [dbo].[spSipInsStkHar] '{$evrakno}','{session('musteri.hesapkod')}', '{$malkod}','{$oran}','{$fiyat}','{$urun_fiyat}','{$kdv}','{$miktar}'");

        $response['status'] = 1;
        return $response;
    }

    public function kalemListe(Request $request)
    {
        $kalemler = DB::select("SELECT * FROM XARWSP WHERE EVRAKNO = ? AND AKTARILDI = '0' ORDER BY HID", [
            session('evrakno')
        ]);

        return view('kalem_liste', compact('kalemler'));
    }

    /**
     * remove the specified resource from storage.
     * @delete('siparis/kalem/{id}')
     * @param  int $id
     * @return response
     */

    public function kalemSil($id)
    {
        $response['status'] = 0;

        $sil = DB::table('XAYSPH')->where('ID', $id)->where('AKTARILDI', 0)->delete();
        if ($sil)
            $response['status'] = 1;

        return $response;

    }

    public function musteri()
    {
        $musteri = CARKRT::where('hesapkod', session('musteri.hesapkod'))->first();

        return view('musteri_bilgi', compact('musteri'));

    }

    /**
     * @return \Illuminate\View\View
     */
    public function cari(Request $request)
    {


        $cari = DB::select("EXEC [dbo].[spArgWebCariEkstre] ?", [session('musteri.hesapkod')]);;

        return view('cari', compact('cari', 'format'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function bakiye()
    {

        $bakiye = DB::select("SELECT GUNCELBAKIYE, GECIKENBAKIYEORTVADE, DOVIZGECIKENBAKIYE,DOVIZBAKIYE AS BAKIYE,
		(CASE WHEN DOVIZCINS = '' THEN 'TL' ELSE DOVIZCINS END) AS [HESAP_PARA_BIRIMI],BAKIYEORTVADE AS [BAKIYE_ORTALAMA_VADESI],
		 BAKIYEVADEFARKGUN*-1 AS [BAKIYE_BEKLEME_SURESI] FROM dbo.XAYBAK WHERE (KARTKOD = ?)", [
            session('musteri.hesapkod')
        ]);


        return view('bakiye', compact('bakiye'));

    }

    /**
     * @return \Illuminate\View\View
     */
    public function risk()
    {

        $bakiye_bakiye = DB::select("SELECT GUNCELBAKIYE, GECIKENBAKIYEORTVADE, DOVIZGECIKENBAKIYE,DOVIZBAKIYE AS BAKIYE,
		(CASE WHEN DOVIZCINS = '' THEN 'TL' ELSE DOVIZCINS END) AS [HESAP_PARA_BIRIMI],BAKIYEORTVADE AS [BAKIYE_ORTALAMA_VADESI],
		 BAKIYEVADEFARKGUN*-1 AS [BAKIYE_BEKLEME_SURESI] FROM dbo.XAYBAK WHERE (KARTKOD = ?)", [
            session('musteri.hesapkod')
        ]);

        $ust_bakiye = DB::select("SELECT DOVIZBAKIYE AS BAKIYE, (CASE WHEN DOVIZCINS = '' THEN 'TL' ELSE DOVIZCINS END) AS [HESAP_PARA_BIRIMI],BAKIYEORTVADE AS [BAKIYE_ORTALAMA_VADESI], BAKIYEVADEFARKGUN*-1 AS [BAKIYE_BEKLEME_SURESI] 
								FROM dbo.XAYBAK WHERE (KARTKOD = ?)", [
            session('musteri.hesapkod')
        ]);

        $tip = DB::select("SELECT KOD,r.ACIKLAMA FROM dbo.REFKRT r WHERE r.TABLOAD='PRMRIT' AND r.ALANAD='RISKTIP' ORDER BY r.KOD");
        $bakiye_tip = [];
        foreach ($tip as $t) {
            $bakiye_tip[$t->KOD] = $t->ACIKLAMA;
        }

        $bakiye = DB::select("EXEC dbo.SPAPP_RISK @SABLONNO = 0, @SIRKETNO = '019', @HESAPKOD = ?, @GOSTERIMTIP = 0, @DOVIZTIP = 0", [
            session('musteri.hesapkod')
        ]);
        return view('risk', compact('bakiye', 'bakiye_tip', 'ust_bakiye', 'bakiye_bakiye'));

    }

    /**
     * @return \Illuminate\View\View
     */
    public function satis()
    {

        $grup = DB::select("SELECT * FROM VW_WEB_MUSTERI_STOK_GRUP WHERE HESAPKOD=? ORDER BY EVRAKYIL DESC, EVRAKAY DESC", [session('musteri.hesapkod')]);

        $detay = [];
        foreach ($grup as $g) {
            $detay[$g->EVRAKYIL][$g->EVRAKAY] = DB::select("SELECT EVRAKTIPI, EVRAKNO, EVRAKTARIH, MALKOD, MALAD, MIKTAR, FIYAT, FIYATDOVIZCINS, FIYATDOVIZKUR, DOVIZTUTAR,
								DOVIZISKONTO, DOVIZKDV, _DOVIZNETTUTAR, _DOVIZTOPLAM FROM dbo.VW_WEB_MUSTERI_STOK_1
                                WHERE (HESAPKOD = ?) AND EVRAKYIL = ? AND EVRAKAY = ? AND EVRAKTIPI != 'Satışdan İade Faturası' ORDER BY EVRAKTARIH DESC", [
                session('musteri.hesapkod'),
                $g->EVRAKYIL,
                $g->EVRAKAY
            ]);
        }


        return view('satis', compact('grup', 'detay'));
    }


    public function satis_analiz()
    {

        $yillar = DB::select("SELECT EVRAKYIL
                                    FROM VW_ARG_WEB_SATIS_ANALIZ_FINAL
                                    WHERE HESAPKOD = ? GROUP BY EVRAKYIL ORDER BY EVRAKYIL DESC", [session('musteri.hesapkod')]);

        foreach ($yillar as $yil) {

            $analiz[$yil->EVRAKYIL] = DB::select("SELECT CARKRT_UNVAN ,EVRAKYIL ,HESAPKOD ,MALKOD ,STKKRT_MALAD ,Ocak_Net_Satis ,Subat_Net_Satis ,Mart_Net_Satis ,
                                    Nisan_Net_Satis ,Mayis_Net_Satis ,Haziran_Net_Satis ,Temmuz_Net_Satis ,Agustos_Net_Satis ,Eylul_Net_Satis ,
                                    Ekim_Net_Satis ,Kasim_Net_Satis ,Aralik_Net_Satis ,Toplam_Net_Satis 
                                    FROM VW_ARG_WEB_SATIS_ANALIZ_FINAL
                                    WHERE HESAPKOD = ? AND EVRAKYIL = ?", [session('musteri.hesapkod'), $yil->EVRAKYIL]);
        }


        return view('satis_analiz', compact('yillar', 'analiz'));
    }



    public function satis_analiz_miktar()
    {

        $yillar = DB::select("SELECT EVRAKYIL
                                    FROM VW_ARG_WEB_SATIS_ANALIZ_FINAL
                                    WHERE HESAPKOD = ? GROUP BY EVRAKYIL ORDER BY EVRAKYIL DESC", [session('musteri.hesapkod')]);

        foreach ($yillar as $yil) {

            $analiz[$yil->EVRAKYIL] = DB::select("SELECT HESAPKOD,UNVAN,UNVAN2,EVRAKYIL,MALKOD,MALAD,BIRIM,OCAK_MIKTAR,SUBAT_MIKTAR,MART_MIKTAR,
                                    NISAN_MIKTAR,MAYIS_MIKTAR,HAZIRAN_MIKTAR,TEMMUZ_MIKTAR,AGUSTOS_MIKTAR,EYLUL_MIKTAR,EKIM_MIKTAR,KASIM_MIKTAR,
                                    ARALIK_MIKTAR,TOPLAM_MIKTAR 
                                    FROM VW_ARG_WEB_SATIS_ANALIZ_MIKTAR
                                    WHERE HESAPKOD = ? AND EVRAKYIL = ?", [session('musteri.hesapkod'), $yil->EVRAKYIL]);
        }


        return view('satis_analiz_miktar', compact('yillar', 'analiz'));
    }


    /**
     * @return \Illuminate\View\View
     */

    public function siparisler()
    {

        return view('siparis_liste');
    }

    public function siparisListe()
    {

        $liste = DB::select("SELECT DISTINCT EVRAKNO, EVRAKTARIH, EVRAKTIP  FROM VWWSIP 
							where EVRAKTIP = 14 and HESAPKOD =? ORDER BY EVRAKTARIH DESC", [session('musteri.hesapkod')]);

        return view('sip_liste', compact('liste'));
    }

    public function siparisSil($id)
    {
        $response['status'] = 0;
        $sil = DB::table('XAYSPH')->where('HESAPKOD', session('musteri.hesapkod'))->where('EVRAKNO', $id)->where('AKTARILDI', '0')->delete();

        if ($sil > 0) {
            $response['status'] = 1;
        }

        return $response;
    }

    public function siparisDetay($id)
    {
        $siparis = DB::table("XARWSP")->where('HESAPKOD', session('musteri.hesapkod'))->where('EVRAKNO', $id)->first();
        $kalemler = DB::table("XARWSP")->where('HESAPKOD', session('musteri.hesapkod'))->where('EVRAKNO', $id)->get();
        session()->put('evrakno', $id);


        return view('sip_detay', compact('siparis', 'kalemler'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function cekSenet()
    {
        $data['ceksenet'] = DB::select("EXEC [dbo].[spArgWebGetCekSenet2] ?", [session('musteri.hesapkod')]);
       
        $data['yil_ay'] = DB::select('[dbo].[spArgWebGetCekSenetAY] ?', [session('musteri.hesapkod')]);
        $data['toplam'] = 0;
        $data['say'] = [];
        foreach($data['ceksenet'] as $cek){
            if(!isset($data['say'][$cek->AY])){
                $data['say'][$cek->AY] = 0;
            }   
            $data['say'][$cek->AY]++; 
        }
        foreach($data['yil_ay'] as $yil){
            $data['toplam'] += $yil->TUTAR; 
        }

        return view('cek_senet', $data);

    }

	public function bakiye_detay(){
        $geciken =  DB::select("EXEC [dbo].[SP_ARG_BAKIYE_DETAY] ?", [session('musteri.hesapkod')]);
        
        $kod = DB::select("SELECT KOD,ACIKLAMA from refkrt where ALANAD='ISLEMTIP' AND TABLOAD='CARHAR'");
        foreach($kod as $k){
            $evr_tip[$k->KOD] = $k->ACIKLAMA;
        }
        return view('detay', compact('geciken', 'evr_tip'));
    }

    public function geciken_bakiye(){
        $geciken =  DB::select("EXEC [dbo].[SP_ARG_GECIKEN_BAK] ?", [session('musteri.hesapkod')]);
		$detay = DB::select("EXEC [dbo].[SP_ARG_GECIKEN_BAK_DETAY] ?", [session('musteri.hesapkod')]);
        $kod = DB::select("SELECT KOD,ACIKLAMA from refkrt where ALANAD='ISLEMTIP' AND TABLOAD='CARHAR'");
        foreach($kod as $k){
            $evr_tip[$k->KOD] = $k->ACIKLAMA;
        }
        return view('geciken', compact('geciken','detay', 'evr_tip'));
    }

    public function musteriSatis(){
        list($gun,$ay,$yil) = explode('/',request('baslangic'));
        $baslangic = $yil.$ay.$gun;
        list($gun,$ay,$yil) = explode('/',request('bitis'));
        $bitis = $yil.$ay.$gun;

        $data['veriler'] = collect(DB::select("EXEC [dbo].[spArgWebMusteriSatisRapor] ?, ?, ?",[$baslangic,$bitis,request('bolge')]));
        
        return view('musteri-satis-sonuc',$data);
    }

    public function musteriSatisForm(){
        
        $data['bolgeler'] = collect(DB::select("select KOD,ACIKLAMA from  refkrt where ALANAD='BOLGEKOD' AND TABLOAD='CARKRT' AND KOD NOT IN('','ADMIN','014','013')"));
        
        return view('musteri-satis', $data);
    }
}
