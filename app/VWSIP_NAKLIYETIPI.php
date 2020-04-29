<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VWSIP_NAKLIYETIPI extends Model {

	protected $table        = 'VWSIP_NAKLIYETIPI';
	public    $incrementing = FALSE;
	public    $timestamps   = FALSE;
	protected $guarded      = array(
		'*'
	);
}
