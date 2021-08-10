@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('botones')
    <a href="{{ route("recetas.index") }}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
        <svg class="w-6 h-6 icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path></svg>
        Volver
    </a>
@endsection

@section('content')
    {{-- {{$perfil}} --}}
    <h1 class="text-center" >Editar mi perfil</h1>
    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-white p-3">
            <form action=" {{ route("perfiles.update", ["perfil" => $perfil->id]) }}" method="POST" 
                enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label for="nombre">Nombre</label>

                    <input type="text" 
                    name="nombre" 
                    class="form-control @error("nombre") is-invalid @enderror" 
                    id="nombre" 
                    value="{{$perfil->usuario->name}}"
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
                    value="{{$perfil->usuario->url}}"
                    placeholder="Tu Sitio web">

                    @error("url")
                        <span class="invalid-feedback d-block" role="alert"> 
                            <strong> {{$message}} </strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="biografia">biografia</label>
                    <input id="biografia" type="hidden" name="biografia" value="{{$perfil->biografia}}">
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
                        <img src="/storage/{{$perfil->imagen}}" style="width: 300px" alt="">
                    </div>
                    @error("imagen")
                        <span class="invalid-feedback d-block" role="alert"> 
                            <strong> {{$message}} </strong>
                        </span>
                    @enderror
                @endif
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Guardar Cambios">
                </div>
            </form>
        </div>
    </div>
    
@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
@endsection