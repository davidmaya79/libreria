@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <a class="btn btn-primary shadow-none" data-toggle="tooltip" data-placement="top" title="Inicio" href="{{ route('sexos.index') }}"> 
                    <i class="fa fa-home fa-fw"></i> 
                </a>
            </div>
        </div>
        <div class="col-md-12">
            <form  action="" method="" class="row g-3">
              <div class="col-md-6">
                <label for="descripcion" class="form-label">Descripción de Sexo</label>
                <input type="text" class="form-control shadow-none" id="descripcion" name="descripcion" value="{{ $sexo->descripcion }}">
                @error('descripcion')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
              </div>
              <div class="col-md-12">
                <button type="submit" class="btn btn-success">Actualizar</button>
              </div>
            </form>

        </div>
    </div>
</div>
@endsection