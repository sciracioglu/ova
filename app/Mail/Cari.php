<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class Cari extends Mailable
{
    public $cari;


    /**
     * Create a new message instance.
     *
     */
    public function __construct()
    {

        $this->cari = DB::select("EXEC [dbo].[spArgWebCariEkstre] ?", [session('musteri.hesapkod')]);;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Cari Ekstre')->view('emails.cari');
    }
}