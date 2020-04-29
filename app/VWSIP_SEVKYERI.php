<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VWSIP_SEVKYERI extends Model {

	protected $table        = 'VWSIP_SEVKYERI';
	public    $incrementing = FALSE;
	public    $timestamps   = FALSE;
	protected $guarded      = array(
		'*'
	);
}
