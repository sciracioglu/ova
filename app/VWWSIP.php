<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VWWSIP extends Model {

	protected $table        = 'VWWSIP';
	public    $incrementing = FALSE;
	public    $timestamps   = FALSE;
	protected $guarded      = array(
		'*'
	);

}
