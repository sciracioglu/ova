<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VwWebSatisPrimIade extends Model {

	protected $table        = 'VW_WEB_SATISPRIM_IADE';
	public    $incrementing = FALSE;
	public    $timestamps   = FALSE;
	protected $guarded      = array(
		'*'
	);
}
