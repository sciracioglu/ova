<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class Bakiye extends Mailable
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

        $this->geciken = DB::select("EXEC [dbo].[SP_ARG_BAKIYE_DETAY] ?", [session('musteri.hesapkod')]);
        
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
        return $this->subject('Bakiye Detay')->view('emails.bakiye');
    }
}