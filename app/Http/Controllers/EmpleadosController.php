<?php

namespace App\Http\Controllers;

use App\Empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;


class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['empleados']=Empleados::paginate(5);
        return view('empleados.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empleados.create');
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

        //$datosEmpleado=Request()->all();
        
        $campos=[
            'Nombre' => 'required|string|max:100',
            'ApellidoPaterno' => 'required|string|max:100',
            'ApellidoMaterno' => 'required|string|max:100',
            'Correo' => 'required|email',
            'Foto' => 'required|max:10000|mimes:jpg,png,jpeg'
        ];

        $mensaje=['required'=>'El campo :attribute es requerido.'];
        $this-> validate($request,$campos,$mensaje); 

        $datosEmpleado=Request()->except('_token');

        if($request->hasfile('Foto')){
        $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        }
        Empleados::insert($datosEmpleado);
        
        //return response()->json($datosEmpleado);
        return redirect('empleados')->with('mensaje','Empleado agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function show(Empleados $empleados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function edit($Id)
    {
        //

        $empleado= Empleados::findOrFail($Id);

        return view('empleados.edit',compact('empleado'));
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Id)
    {
        //
        $datosEmpleado=request()->except(['_token','_method']);

        if($request->hasfile('Foto')){

            $empleado= Empleados::findOrFail($Id);
            Storage::delete('public/'.$empleado->Foto);
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        }

        Empleados::where('Id','=',$Id)->update($datosEmpleado);

        $empleado= Empleados::findOrFail($Id);

        //return view('empleados.edit',compact('empleado'));
        return redirect('empleados')->with('mensaje','Empleado Modificado');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function destroy($Id)
    {
        //

        $empleado= Empleados::findOrFail($Id);

            if(Storage::delete('public/'.$empleado->Foto)){;
            Empleados::destroy($Id);
            }
        //return redirect('empleados');
        return redirect('empleados')->with('mensaje','Empleado Eliminado');


    }
}
