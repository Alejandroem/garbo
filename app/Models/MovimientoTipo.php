<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoTipo extends Model
{
    //
    /**
     * Primary key associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'Codigo';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [''];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'MOVIMIENTO TIPO';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
