<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CARKRT extends Model {

	protected $table        = 'CARKRT';
	public    $incrementing = FALSE;
	public    $timestamps   = FALSE;
	protected $guarded      = array(
		'*'
	);

}
