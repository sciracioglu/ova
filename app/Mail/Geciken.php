<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class Geciken extends Mailable
{
    public $geciken;
    public $detay;
    public $evr_tip;


    /**
     * Create a new message instance.
     *
     */
    public function __construct()
    {

        $this->geciken = DB::select("EXEC [dbo].[SP_ARG_GECIKEN_BAK] ?", [session('musteri.hesapkod')]);
        $this->detay = DB::select("EXEC [dbo].[SP_ARG_GECIKEN_BAK_DETAY] ?", [session('musteri.hesapkod')]);
        $kod = DB::select("SELECT KOD,ACIKLAMA from refkrt where ALANAD='EVRAKTIP' AND TABLOAD='EVRBAS'");
        foreach($kod as $k){
            $this->evr_tip[$k->KOD] = $k->ACIKLAMA;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Geciken Bakiye')->view('emails.geciken');
    }
}