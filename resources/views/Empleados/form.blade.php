

<div class="form-group">
<label for="Nombre" class="control-label">{{'Nombre'}}</label>
    <input type="text" class="form-control {{$errors->has('Nombre')? 'is-invalid' :'' }}" id="Nombre" name="Nombre" 
    value="{{ isset($empleado->Nombre) ? $empleado->Nombre : old('Nombre')}}">
</div>

<div class="form-group">
    <label for="ApellidoPaterno" class="control-label ">{{'Apellido Paterno'}}</label>
    <input type="text" id="ApellidoPaterno" name="ApellidoPaterno" class="form-control {{$errors->has('ApellidoPaterno')? 'is-invalid' :'' }}" 
    value="{{ isset($empleado->ApellidoPaterno) ? $empleado->ApellidoPaterno : old('ApellidoPaterno') }}">
</div>

<div class="form-group">   
    <label for="ApellidoMaterno" class="control-label">{{'Apellido Materno'}}</label>
    <input type="text" class="form-control {{$errors->has('ApellidoMaterno')? 'is-invalid' :'' }}" id="ApellidoMaterno" name="ApellidoMaterno" 
    value="{{ isset($empleado->ApellidoMaterno) ? $empleado->ApellidoMaterno : old('ApellidoMaterno') }}">
</div>   

<div class="form-group"> 
    <label class="control-label" for="Correo">{{'Correo'}}</label>
    <input type="email" id="Correo" name="Correo" class="form-control {{$errors->has('Correo')? 'is-invalid' :'' }}" 
    value="{{ isset($empleado->Correo) ? $empleado->Correo : old('Correo') }}">
</div>    
    
 
<div class="form-group">
    <label class="control-label" for="Foto">{{'Foto'}}</label>
    <br>   
    @if (isset($empleado->Foto))
    <img src="{{asset('storage').'/'.$empleado->Foto}}" alt="" width="300"class=" img-thumbnail img-fluid">   
    @endif
    
    <input type="file" id="Foto" name="Foto" class="form-control {{$errors->has('Correo')? 'is-invalid' :'' }}" value="">
</div>    

    <input type="submit" class="btn btn-success" value="{{$Modo== 'crear' ? 'Agregar' : 'Modificar'}}">
    <a class="btn btn-primary"href="{{url('empleados')}}">Regresar</a>

