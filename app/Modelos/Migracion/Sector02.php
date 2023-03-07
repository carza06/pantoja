<?php

namespace App\Modelos\Migracion;

use Illuminate\Database\Eloquent\Model;

class Sector02 extends Model
{
    protected $table = '02';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'contribuyente',
		'sector',
		'tarifa',
		'numero',
		'saldo',
		'periodo',
    ];
}
