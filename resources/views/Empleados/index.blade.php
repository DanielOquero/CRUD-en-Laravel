@extends('layouts.app')

@section('content')
<div class="container">
@if (Session::has('mensaje')){{
     Session::get('mensaje')
}}    
@endif
<br>
<a href="{{url('empleados/create')}}" class="btn btn-success">Crear Usuario</a>
<br>
<br>

<table class="table table-light table-hover">
    <thead class="thead-inverse">
        <tr>
            <th>Id</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Acciones</th>
            
        </tr>
        </thead>

        <tbody>
        @foreach ($empleados as $empleado)

            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    <img src="{{asset('storage').'/'.$empleado->Foto}}" alt="" width="150" class=" img-thumbnail img-fluid">                   
                </td>
                <td>{{$empleado->Nombre}} {{$empleado->ApellidoPaterno}} {{$empleado->ApellidoMaterno}}</td>
                <td>{{$empleado->Correo}}</td>
                <td>
                    <a  class="btn btn-warning" href="{{url('empleados/'.$empleado->Id.'/edit')}}">Modificar</a>  

                    <form method="POST" action="{{ url('/empleados/'.$empleado->Id)}}" style="display: inline">
                    {{ csrf_field() }}
                    {{method_field('DELETE')}}
                    <button class="btn btn-danger" type="submit" onclick="return confirm('¿Desea Borrar el Empleado?');">Borrar</button>

                </form>

                </td>
            </tr>
            
        @endforeach
        </tbody>
</table>

</div>
@endsection
