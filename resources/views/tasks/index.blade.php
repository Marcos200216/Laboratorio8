@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="mt-3">Sistema de gestión de tareas</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success mt-3" href="{{ route('tasks.create') }}"> Crear nueva tarea</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success mt-3">
        <p>{{ $message }}</p>
    </div>
    @endif

    @if ($message = Session::get('error'))
    <div class="alert alert-danger mt-3">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="d-flex justify-content-between mt-3">
        <h4>Usuario: {{ Auth::user() ? Auth::user()->name : 'Ninguno' }}</h4>
        <h4>Último usuario logueado: {{ $lastUser ? $lastUser->name : 'Ninguno' }}</h4>
    </div>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Prioridad</th>
                <th>Completada</th>
                <th>Etiquetas</th>
                <th>Acciones</th>
                <th>Configuraciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->title }}</td>
                <td>
                    @if ($task->priority == 'baja')
                        <span class="text-success">{{ $task->priority }}</span>
                    @elseif ($task->priority == 'media')
                        <span class="text-warning">{{ $task->priority }}</span>
                    @elseif ($task->priority == 'alta')
                        <span class="text-danger">{{ $task->priority }}</span>
                    @endif
                </td>
                <td>
                    @if ($task->completed)
                        <span class="badge bg-success">Completada</span>
                    @else
                        <span class="badge bg-danger">Pendiente</span>
                    @endif
                </td>
                <td>
                    @foreach ($task->tags as $tag)
                        <span class="badge bg-primary">{{ $tag->name }}</span>
                    @endforeach
                </td>
                <td>
                    <form action="{{ route('tasks.complete', $task->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-primary">Completar</button>
                    </form>
                </td>
                <td>
                    @if ($task->user_id == Auth::id())
                        <a class="btn btn-primary" href="{{ route('tasks.edit', $task->id) }}">Editar</a>
                    @else
                        <span class="badge bg-warning text-dark">No autorizado</span>
                    @endif
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $tasks->links() }}
    </div>
</div>
@endsection
