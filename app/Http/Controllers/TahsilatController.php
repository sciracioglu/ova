<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class TahsilatController extends Controller
{
    public function index()
    {
        $tahsilatlar = DB::select('EXEC [dbo].[spArgWebTahsilatRapor] ?', [session('musteri.hesapkod')]);
        dd($tahsilatlar);
    }
}
