<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class EVRBAS extends Model {

	protected $table        = 'EVRBAS';
	public    $incrementing = FALSE;
	public    $timestamps   = FALSE;
	protected $guarded      = array(
		'*'
	);

}
