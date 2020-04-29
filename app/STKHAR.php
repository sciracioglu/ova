<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class STKHAR extends Model {

	protected $table        = 'STKHAR';
	public    $incrementing = FALSE;
	public    $timestamps   = FALSE;
	protected $guarded      = array(
		'*'
	);

}
