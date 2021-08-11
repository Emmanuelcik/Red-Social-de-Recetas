@extends("layouts.app")
@section('botones')
    <<a href="{{ route("recetas.index") }}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
        <svg class="w-6 h-6 icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path></svg>
        Volver
    </a>
@endsection
@section('content')
<div class="container ">
    <div class="row">
        <div class="col-md-5">
            @if ($perfil->imagen)
                <img src="/storage/{{$perfil->imagen}}" class="w-100 rounded-circle" alt="Imagen de perfil">
            @endif
        </div>
        <div class="col-md-7 mt-5 mt-md-0">
            <h2 class="text-center mb-2 text-primary"> {{$perfil->usuario->name}} </h2>
            <a href="{{$perfil->usuario->url}}">Visitar Sitio Web</a>
            <div class="biografia">
                {!! $perfil->biografia !!} 
            </div>
        </div>
    </div>
</div>
    <h2 class="text-center my-5">Recetas Creadas por {{$perfil->usuario->name}}</h2>
    <div class="container">
        <div class="row mx-auto bg-white p-4">
      
            @if ( count( $recetas) > 0 )
                @foreach ($recetas as $receta)
                    <div class="col-md-4 mb-4" >
                        <div class="card">
                            <img src="/storage/{{$receta->imagen}}" class="card-img-top" alt="Imagen de la receta">
                            
                            <div class="card-body">
                                <h3>{{$receta->titulo}}</h3>
                                <a class="btn btn-primary d-block mt-4 text-uppercase font-weight-bold"
                                href="{{ route( "recetas.show", ["receta" => $receta->id] ) }}">Ver Receta</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center w-100 ">No hay ninguna receta aún.</p>
            @endif
        </div>
        <div class="d-flex justify-content-center">
            {{$recetas->links()}}
        </div>
    </div>
@endsection