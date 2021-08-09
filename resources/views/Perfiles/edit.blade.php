@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('botones')
    <a href="{{ route("recetas.index") }}" class="btn btn-primary mr-2 text-white">Volver</a>
@endsection

@section('content')
    {{-- {{$perfil}} --}}
    <h1 class="text-center" >Editar mi perfil</h1>
    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-white p-3">
            <form action="">
                <div class="form-group">
                    <label for="nombre">Nombre</label>

                    <input type="text" 
                    name="nombre" 
                    class="form-control @error("nombre") is-invalid @enderror" 
                    id="nombre" 
                    {{-- value="{{$perfil->nombre}}" --}}
                    placeholder="Tu nombre">

                    @error("nombre")
                        <span class="invalid-feedback d-block" role="alert"> 
                            <strong> {{$message}} </strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="url">Sitio Web</label>

                    <input type="text" 
                    name="url" 
                    class="form-control @error("url") is-invalid @enderror" 
                    id="url" 
                    {{-- value="{{$perfil->nombre}}" --}}
                    placeholder="Tu Sitio web">

                    @error("url")
                        <span class="invalid-feedback d-block" role="alert"> 
                            <strong> {{$message}} </strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="biografia">Preparación</label>
                    <input id="biografia" type="hidden" name="biografia" >
                    <trix-editor input="biografia" 
                    class="form-control @error("biografia") is-invalid @enderror"></trix-editor>
                    @error("biografia")
                        <span class="invalid-feedback d-block" role="alert"> 
                            <strong> {{$message}} </strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="imagen">Tu imagen</label>
                    <input  id="imagen" type="file" class="form-control @error("imagen") is-invalid @enderror" name="imagen">
                
                @if ( $perfil->imagen)   
                    <div class="mt-4">
                        <p>Imagen Actual</p>
                        {{-- <img src="/storage/{{$receta->imagen}}" style="width: 300px" alt=""> --}}
                    </div>
                    @error("imagen")
                        <span class="invalid-feedback d-block" role="alert"> 
                            <strong> {{$message}} </strong>
                        </span>
                    @enderror
                @endif
                </div>
            </form>
        </div>
    </div>
    
@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
@endsection