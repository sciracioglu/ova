<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class SatisAnalizMiktar extends Mailable
{
    public $yillar;
    public $analiz;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->yillar = DB::select("SELECT EVRAKYIL
                                    FROM VW_ARG_WEB_SATIS_ANALIZ_FINAL
                                    WHERE HESAPKOD = ? GROUP BY EVRAKYIL ORDER BY EVRAKYIL DESC", [session('musteri.hesapkod')]);

        foreach ($this->yillar as $yil) {

            $this->analiz[$yil->EVRAKYIL] = DB::select("SELECT HESAPKOD,UNVAN,UNVAN2,EVRAKYIL,MALKOD,MALAD,BIRIM,OCAK_MIKTAR,SUBAT_MIKTAR,MART_MIKTAR,
                                    NISAN_MIKTAR,MAYIS_MIKTAR,HAZIRAN_MIKTAR,TEMMUZ_MIKTAR,AGUSTOS_MIKTAR,EYLUL_MIKTAR,EKIM_MIKTAR,KASIM_MIKTAR,
                                    ARALIK_MIKTAR,TOPLAM_MIKTAR 
                                    FROM VW_ARG_WEB_SATIS_ANALIZ_MIKTAR
                                    WHERE HESAPKOD = ? AND EVRAKYIL = ?", [session('musteri.hesapkod'), $yil->EVRAKYIL]);
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Satış Analizi Miktar')->view('emails.satis_analiz_miktar');
    }
}