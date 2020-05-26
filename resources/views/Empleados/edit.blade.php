@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ url('/empleados/'.$empleado->Id) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}}

    @include('Empleados.form',['Modo'=>'editar'])

</form>
</div>
@endsection