<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VWSIP_STOKKART extends Model {

	protected $table        = 'VWSIP_STOKKART';
	public    $incrementing = FALSE;
	public    $timestamps   = FALSE;
	protected $guarded      = array(
		'*'
	);

}
