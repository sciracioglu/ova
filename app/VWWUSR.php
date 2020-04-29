<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VWWUSR extends Model {
    
	protected $table        = 'VWWUSR';
	public    $incrementing = FALSE;
	public    $timestamps   = FALSE;
	protected $guarded      = array(
		'*'
	);

	
}