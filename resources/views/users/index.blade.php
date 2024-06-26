@extends('layouts.app')
@section('content')
    <table class="table table-hover table-responsive-sm">
        <thead>
        <tr>
            <th>Det.</th>
            <th>Usuario</th>
            <th>Email</th>
            <th>Accion</th>
        </tr>
        </thead>
        <tbody>
        @foreach($Users as $User)
            <tr>
                <td>
                    <a href="{{route('user.show', ['user' => $User])}}" title="Detalle">
                        <span class="oi oi-eye"></span>
                    </a>
                </td>
                <td>{{$User->name}}</td>
                <td>{{$User->email}}</td>
                <td>
                    <form action="{{route('user.destroy', $User)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <a href="{{route('user.edit', ['user' => $User])}}" title="Editar">
                            <span class="oi oi-pencil"></span>
                        </a>

                        <button type="submit" class="btn btn-link" title="Eliminar">
                            <span class="oi oi-circle-x"></span>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection