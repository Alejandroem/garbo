<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ŢipoPeticiones;
class Peticiones extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'PETICIONES';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [''];


    public function tipo(){
        return $this->belongsTo(TipoPeticiones::class,'idTipoPeticion');

    }

    public function strEstado(){
        switch ($this->estado)
        {
            case 0:
                return "Pendiente";
                break;
            case 1:
                return "Aprobado";
                break;
            case 2:
                return "Denegado";
                break;
            default:
                return "Error revisar estado en db";
                break;
        }


    }
}
