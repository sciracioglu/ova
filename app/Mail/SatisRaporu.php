<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class SatisRaporu extends Mailable
{
    public $grup;
    public $detay;

    /**
     * Create a new message instance.
     *
     */
    public function __construct()
    {

        $this->grup = DB::select("SELECT * FROM VW_WEB_MUSTERI_STOK_GRUP WHERE HESAPKOD=? ORDER BY EVRAKYIL DESC, EVRAKAY DESC", [session('musteri.hesapkod')]);

        $this->detay = [];
        foreach ($this->grup as $g) {
            $this->detay[$g->EVRAKYIL][$g->EVRAKAY] = DB::select("SELECT EVRAKTIPI, EVRAKNO, EVRAKTARIH, MALKOD, MALAD, MIKTAR, FIYAT, FIYATDOVIZCINS, FIYATDOVIZKUR, DOVIZTUTAR,
								DOVIZISKONTO, DOVIZKDV, _DOVIZNETTUTAR, _DOVIZTOPLAM FROM dbo.VW_WEB_MUSTERI_STOK_1
                                WHERE (HESAPKOD = ?) AND EVRAKYIL = ? AND EVRAKAY = ? AND EVRAKTIPI != 'Satışdan İade Faturası' ORDER BY EVRAKTARIH DESC", [
                session('musteri.hesapkod'),
                $g->EVRAKYIL,
                $g->EVRAKAY
            ]);
        }

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Satış Raporu')->view('emails.satis');
    }
}