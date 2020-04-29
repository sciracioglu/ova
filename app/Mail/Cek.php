<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class Cek extends Mailable
{
    public $ceksenet;
    public $yil_ay;


    /**
     * Create a new message instance.
     *
     */
    public function __construct()
    {
        $this->ceksenet = DB::select("EXEC [dbo].[spArgWebGetCekSenet2] ?", [session('musteri.hesapkod')]);
       
        $this->yil_ay = DB::select('[dbo].[spArgWebGetCekSenetAY] ?', [session('musteri.hesapkod')]);
        // $data['toplam'] = 0;
        // foreach($data['yil_ay'] as $yil){
        //     $data['toplam'] += $yil->TUTAR; 
        // }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Çek Senet Bilgileri')->view('emails.cek_senet');
    }
}