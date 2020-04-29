<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VWSIP_EVRAKKALEM extends Model {

	protected $table        = 'VWSIP_EVRAKKALEM';
	public    $incrementing = FALSE;
	public    $timestamps   = FALSE;
	protected $guarded      = array(
		'*'
	);

}
