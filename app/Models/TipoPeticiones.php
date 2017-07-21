<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPeticiones extends Model
{
    //
    
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
    protected $table = 'TIPOS_PETICION';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
