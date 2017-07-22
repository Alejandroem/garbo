<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MovimientoTipo;
class MovimientoMaestro extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'MOVIMIENTO MAESTRO';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'Numero' => 'integer',
    ];


    public function movimientoTipo(){
        return $this->belongsTo(MovimientoTipo::class,'Tipo');
    }
}
