<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tahsilat extends Model
{
    protected $table = 'VW_ARG_WEB_TAHSILAT_RAPOR';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];
}
