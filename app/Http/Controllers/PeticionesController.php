<?php

namespace App\Http\Controllers;

use App\Models\Peticiones;
use App\Models\TipoPeticiones;
use App\Models\CamposPeticion;
use App\Models\Seguridad;
use App\Models\MovimientoMaestro;
use App\Models\MovimientoTipo;
use App\Models\Bodega;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mail\NotificacionPeticion;
use Alert, Mail;


class PeticionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->has('autorizar'))
        {
            if($request->autorizar=true){
                $usuario = $request->usuario;
                $empresa = $request->empresa;
                $peticiones = Peticiones::all();
                $tiposPeticiones = TipoPeticiones::whereIn('id',$peticiones->pluck('idTipoPeticion'))->get();
                return view('autorizar.index')->with(compact('peticiones','tiposPeticiones','usuario','empresa'));
            }
        }

        if($request->has('usuario')&&$request->has('empresa')){
            $usuario = $request->usuario;
            $empresa = $request->empresa;
            return view('welcome')->with(compact('usuario','empresa'));
        }

    }

    /**
     * Return the autocomplete bodegas values
     *
     * @return array
     */
    public function numeroAutoComplete (Request $request)
    {
        $term = $request->term;

        $numeros = MovimientoMaestro::where('Empresa',$request->empresa)//$request->empresa
            ->where('Tipo',15)
            ->where('Numero','Like','%'.$term.'%')
            ->pluck('Numero');
        for ($i = 0; $i < count($numeros); $i++)
        {
            $numeros[$i]="".$numeros[$i];
        }
        return response()->json($numeros)->withCallback($request->input('callback'));
    }

    /**
     * Return the autocomplete bodegas values
     *
     * @return array
     */
    public function searchMovimiento (Request $request)
    {
        $this->validate($request,[
            'numero' => 'required',
            'bodega' => 'required',
            'empresa'=>'required'
        ]);

        $movimiento = MovimientoMaestro::where('Empresa',$request->empresa)
            ->where('Bodega',$request->bodega)
            ->where('Numero',$request->numero)
            ->where('Tipo',15)
            ->get()
            ->toArray()[0];
        $movimiento["Fecha"] = Carbon::parse($movimiento["Fecha"])->format('d/m/Y');
        $movimiento["Tipo"] = MovimientoTipo::find(15)->Descripcion;
        return response()->json($movimiento)
            ->withCallback($request->input('callback'));
    }


    public function dataTable (Request $request)
    {

        $peticiones = Peticiones::all();


        if($request->has('usuario')){
            $peticiones = Peticiones::where('idUsuario',$request->usuario)->get();
        }

        return response()->json($peticiones)
            ->withCallback($request->input('callback'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $empresa = $request->empresa;
        $usuario = $request->usuario;
        $bodegas_disp = Seguridad::where('Usuario',$request->usuario)
            ->where('Empresa',$empresa)
            ->where('Tipo',3)
            ->pluck('Llave');
        for ($i = 0; $i < count($bodegas_disp); $i++)
        {
            $bodegas_disp[$i] = substr($bodegas_disp[$i],1);
        }

        $bodegas = Bodega::where('Empresa',$empresa)->whereIn('Codigo',$bodegas_disp)->pluck('Descripcion','Codigo');


        $peticiones = Peticiones::where('idUsuario',$usuario)->get();

        $tiposPeticiones = TipoPeticiones::whereIn('id',$peticiones->pluck('idTipoPeticion'))->get();

        session()->flash('create','active');
        return view('peticiones.index')->with(compact('bodegas','empresa','usuario','peticiones','tiposPeticiones'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request,[
            'nuevafecha'=>'required',
            'codigo'=>'required',
            'idUsuario'=>'required',
            'empresa'=>'required'
        ]);

        $movimiento = MovimientoMaestro::where('Empresa',$request->empresa)
            ->where('Numero',$request->codigo)
            ->where('Tipo',15)
            ->first();
        $tipoPeticion = TipoPeticiones::firstOrCreate([
            'nombre'=> 'Cambio de fecha entrada de inventario' 
        ]);

        $peticion = Peticiones::create([
            'idTipoPeticion'=>$tipoPeticion->id,
            'idUsuario'=>$request->idUsuario,
            'Codigo'=>$request->codigo,
            'Empresa'=>$request->empresa,
            'fechaCreacion'=>Carbon::now(),
            'estado'=>0,
        ]);
        CamposPeticion::create([
            'idPeticion'=>$peticion->id,
            'tabla'=>'MOVIMIENTO MAESTRO',
            'campo'=>'Fecha',
            'tipo'=>'datetime',
            'valorAnterior'=>$movimiento->Fecha,
            'valorNuevo'=>str_replace('/','-',$request->nuevafecha)
        ]);

        Mail::to("admin@admin.com")->send(new NotificacionPeticion($peticion,"Nueva peticion: ","Se ha creado una nueva petición"));

        alert()->success('Peticion creada con exito','Exito');
        session()->flash('creat','active');
        return redirect()->route('peticion.create',
                                 ['usuario'=>$request->idUsuario,
                                  'empresa'=>$request->empresa
                                 ]);

        /*$bodegas = Seguridad::where('Usuario',$request->usuario)
            ->where('Empresa',$request->empresa)
            ->where('Tipo',3)
            ->pluck('Llave');

        for ($i = 0; $i < count($bodegas); $i++)
        {
            $bodegas[$i] = substr($bodegas[$i],1);
        }


        return view('peticiones.index',
                    ['usuario'=>$request->usuario,
                     'empresa'=>$request->empresa])
            ->with([
                'bodegas'=>$bodegas,
                'flash'=>'Peticion creada con exito'
            ]);*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Peticiones  $peticiones
     * @return \Illuminate\Http\Response
     */
    public function show(Peticiones $peticiones)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Peticiones  $peticiones
     * @return \Illuminate\Http\Response
     */
    public function edit(Peticiones $peticiones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Peticiones  $peticiones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peticiones $peticion)
    {
        //

        $peticion->campos->first()->valornuevo = $request->nuevafecha;
        $peticion->campos->first()->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Peticiones  $peticiones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peticiones $peticion)
    {
        //
        //dd($peticion);
        $peticion->campos()->delete();
        $peticion->delete();
        return back();

    }

    public function aprobar(Request $request, Peticiones $peticion){

        switch ($peticion->campos->first()->tabla)
        {
            case 'MOVIMIENTO MAESTRO':

                MovimientoMaestro::where('Numero',floatval($peticion->Codigo))
                    ->where('Empresa',$peticion->Empresa)
                    ->where('Tipo',15)
                    ->update(['Fecha' => Carbon::parse($peticion->campos->first()->valorNuevo)->format('Y/m/d')]);
                $peticion->estado = 1;
                $peticion->idUsuarioAutorizador = $request->usuario;
                $peticion->fechaAtencion = Carbon::now();
                $peticion->save();
                alert()->success('La petición ha sido aprobada','Exito' );
                Mail::to("usuario@usuario.com")
                    ->send(new NotificacionPeticion($peticion,"Peticion aprobada: ","Se ha aprobado la petición"));
                return back();
                break;
            default:
                dd("error");
                break;
        }

    }

    public function denegar(Request $request,Peticiones $peticion){
        $peticion->estado = 2;
        $peticion->idUsuarioAutorizador = $request->usuario;
        $peticion->fechaAtencion = Carbon::now();
        $peticion->save();
        alert()->error('La petición ha sido denegada', 'Exito');
        Mail::to("usuario@usuario.com")
            ->send(new NotificacionPeticion($peticion,"Peticion denegada: ","Se ha denegado la petición"));
        return back();
    }
}
