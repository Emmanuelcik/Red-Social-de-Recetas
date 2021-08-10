@extends("layouts.app")
@section('botones')
    <a href="{{ route("recetas.index") }}" class="btn btn-primary mr-2 text-white">Volver</a>
@endsection
@section('content')
<div class="container ">
    <div class="row">
        <div class="col-md-5">

        </div>
        <div class="col-md-7">
            <h2 class="text-center mb-2 text-primary"> {{$perfil->usuario->name}} </h2>
            <a href="{{$perfil->usuario->url}}">Visitar Sitio Web</a>
            <div class="biografia">
                {!! $perfil->biografia !!}
            </div>
        </div>
    </div>
</div>
    
@endsection