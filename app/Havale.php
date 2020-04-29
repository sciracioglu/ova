<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Havale extends Model {

	protected $table        = 'VW_ARG_GELENHAVALEKREDIKART  ';
	public    $incrementing = FALSE;
	public    $timestamps   = FALSE;
	protected $guarded      = array(
		'*'
	);

}
