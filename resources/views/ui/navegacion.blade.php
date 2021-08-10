<a href="{{ route("recetas.create") }}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
        <svg class="w-6 h-6 icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>
        Crear Receta
</a>
{{-- <a href="{{ route("perfiles.edit", ["perfil" => $usuario->id]) }}" class="btn btn-success mr-2 text-white">Editar perfil</a> --}}
<a href="{{ route("perfiles.edit", ["perfil" => Auth::user()->id]) }}" class="btn btn-outline-success mr-2 text-uppercase font-weight-bold">
    <svg class="w-6 h-6 icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
    Editar perfil
</a>

<a  href="{{ route("perfiles.show", ["perfil" => Auth::user()->id]) }}" class="btn btn-outline-info mr-2 text-uppercase font-weight-bold">
    <img class="icono" src="https://img.icons8.com/wired/64/000000/circled-user.png"/>
    Ver perfil
</a>