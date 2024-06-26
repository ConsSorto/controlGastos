@extends('layouts.app')
@section('content')
    <table class="table table-hover table-responsive-sm">
        <thead>
        <tr>
            <th>Usuario</th>
            <th>Email</th>
            <th>Creado</th>
            <th>Actualizado</th>
            <th>Accion</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$User->name}}</td>
                <td>{{$User->email}}</td>
                <td>{{$User->created_at}}</td>
                <td>{{$User->updated_at}}</td>
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
        </tbody>
    </table>
@endsection