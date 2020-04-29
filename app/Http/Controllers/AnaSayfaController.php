<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AnaSayfaController extends Controller {

	public function index(){

		$musteri = DB::select("exec spArgWebGetCari ?", [
			session('kullanici.username')
		]);


		$liste   = [];
		foreach($musteri as $m){
			$liste[$m->HESAPKOD] = $m->HESAPKOD.' - '.$m->UNVAN . ' ' . $m->UNVAN2;
		}

		return view('anasayfa', compact('liste'));
	}

	public function musteriSec(Request $request){
		if($request->has('musteri')){

			$musteri = DB::select('SELECT * FROM dbo.CARKRT WHERE HESAPKOD = ?',[
				$request->get('musteri')
			]);
			if(count($musteri) > 0){

				session()->put('musteri.unvan',$musteri[0]->UNVAN.' '.$musteri[0]->UNVAN2);
				session()->put('musteri.hesapkod',$musteri[0]->HESAPKOD);

				 DB::insert("EXEC [dbo].[spArgGetCariBakiye] ?", [$musteri[0]->HESAPKOD]);

				

				return view('musteri');
			}
		}

		return Redirect::to('/');
	}

}
