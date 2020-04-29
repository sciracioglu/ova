<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class Risk extends Mailable
{
    public $bakiye_bakiye;
    public $ust_bakiye;
    public $bakiye;
    public $bakiye_tip;

    /**
     * Create a new message instance.
     *
     */
    public function __construct()
    {

        $this->bakiye_bakiye = DB::select("SELECT GUNCELBAKIYE, GECIKENBAKIYEORTVADE, DOVIZGECIKENBAKIYE,DOVIZBAKIYE AS BAKIYE,
		(CASE WHEN DOVIZCINS = '' THEN 'TL' ELSE DOVIZCINS END) AS [HESAP_PARA_BIRIMI],BAKIYEORTVADE AS [BAKIYE_ORTALAMA_VADESI],
		 BAKIYEVADEFARKGUN*-1 AS [BAKIYE_BEKLEME_SURESI] FROM dbo.XAYBAK WHERE (KARTKOD = ?)", [
            session('musteri.hesapkod')
        ]);

        $this->ust_bakiye = DB::select("SELECT DOVIZBAKIYE AS BAKIYE, (CASE WHEN DOVIZCINS = '' THEN 'TL' ELSE DOVIZCINS END) AS [HESAP_PARA_BIRIMI],BAKIYEORTVADE AS [BAKIYE_ORTALAMA_VADESI], BAKIYEVADEFARKGUN*-1 AS [BAKIYE_BEKLEME_SURESI] 
								FROM dbo.XAYBAK WHERE (KARTKOD = ?)", [
            session('musteri.hesapkod')
        ]);

        $tip = DB::select("SELECT KOD,r.ACIKLAMA FROM dbo.REFKRT r WHERE r.TABLOAD='PRMRIT' AND r.ALANAD='RISKTIP' ORDER BY r.KOD");
        $this->bakiye_tip = [];
        foreach ($tip as $t) {
            $this->bakiye_tip[$t->KOD] = $t->ACIKLAMA;
        }

        $this->bakiye = DB::select("EXEC dbo.SPAPP_RISK @SABLONNO = 0, @SIRKETNO ='019', @HESAPKOD = ?, @GOSTERIMTIP = 0, @DOVIZTIP = 0", [
            session('musteri.hesapkod')
        ]);

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Risk - Bakiye Bilgileri')->view('emails.risk');
    }
}