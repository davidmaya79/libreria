@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
            @endif
            @if (session('danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('danger') }}
            </div>
            @endif
            <div class="col-md-12">
                <div class="pull-right">
                    <a class="btn btn-primary shadow-none" data-toggle="tooltip" data-placement="top" title="Agregar Categoria" href="{{  route('categorias.create') }}"> 
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-12"> 
            @if(sizeof($categorias)> 0)
                
             
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Acciones</th>
                        <th scope="col">#</th>
                        <th scope="col">titulo</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($categorias as $categoria)
                        <tr>
                            <td class="text-center" width="20%">
                                <a href="{{ route('categorias.show' , $categoria) }}" class="btn btn-primary btn-sm shadow-none" 
                                        data-toggle="tooltip" data-placement="top" title="Ver Categoria">
                                    <i class="fa fa-book fa-fw text-white"></i></a>
                                </a>
                                <a href="{{ route('categorias.edit' , $categoria) }}" class="btn btn-success btn-sm shadow-none" 
                                        data-toggle="tooltip" data-placement="top" title="Editar Categoria">
                                    <i class="fa fa-pencil fa-fw text-white"></i></a>
                                </a>
                                <form action="{{ route('categorias.destroy' , $categoria) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button id="delete" name="delete" type="submit" 
                                            class="btn btn-danger btn-sm shadow-none" 
                                            data-toggle="tooltip" data-placement="top" title="Eliminar Categoria"
                                            onclick="return confirm('¿Estás seguro de eliminar?')">
                                        <i class="fa fa-trash-o fa-fw"></i>
                                    </button>
                                </form>
                            </td>
                            <td scope="row">{{ $categoria->cod_categoria }}</td>
                            <td scope="row">{{ $categoria->titulo }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <div class="d-flex justify-content-center">
                    {!!  $categorias->links() !!}
                </div> --}}
            </div>
            @else
        <div class="alert alert-secondary">No se encontraron resultados.</div>
            @endif
            
            
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        </div>
    </div>
@endsection