<li class="nav-item">
    <a class="nav-link" href="{{route('user.index')}}">
        @if (auth()->user()->role == 0)
                Usuarios
            @else
                Usuario
            @endif
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('expense_types.index')}}">
        Tipos de gasto
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('expense_controls.index')}}">
        Controles de gasto
    </a>
</li>


{{--
<h1 class="my-4 p-3">
    Menu
</h1>
--}}
{{--
<div class="list-group">
    --}}
    {{--
    <a class="list-group-item" href="{{route('user.index')}}">
        Usuarios
    </a>
    --}}
    {{--
    <a class="list-group-item" href="{{route('expense_types.index')}}">
        Tipos de gasto
    </a>
    --}}
    {{--
    <a class="list-group-item" href="{{route('expense_controls.index')}}">
        Controles de gasto
    </a>
    --}}
{{--
</div>
--}}
    {{--
<a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
    Menu
</a>
--}}
    {{--
<div class="dropdown-menu" style="">
    --}}
        {{--
    <a class="dropdown-item" href="{{route('user.index')}}">
        Usuarios
    </a>
    --}}
        {{--
    <a class="dropdown-item" href="{{route('expense_types.index')}}">
        Tipos de gasto
    </a>
    --}}
        {{--
    <a class="dropdown-item" href="{{route('expense_controls.index')}}">
        Controles de gasto
    </a>
    --}}
    {{--
</div>
--}}
