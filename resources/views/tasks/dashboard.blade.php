@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Minhas Tarefas</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($tasks ?? []) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Comentários</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks ?? [] as $task)
            <tr>
                <td scropt="row">{{ $loop->index + 1 }}</td>
                <td><a href="/tasks/{{ $task->id }}">{{ $task->title }}</a></td>
                <td>
                    @if($task->comments->count() > 0)
                    {{ $task->comments->count() }}
                    @else
                    0
                    @endif
                </td>
                <td>
                    <div style="display: flex; gap: 10px;">
                        <a href="/tasks/edit/{{$task->id}}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon> Editar</a>
                        <form action="/tasks/{{ $task->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon> Deletar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Você ainda não tem tarefas, <a href="/tasks/create">Criar uma tarefa</a></p>
    @endif
</div>

<div class="col-md-10 offset-md-1 visualizar-taks">
    <h1>Visualizar Tarefa</h1>
    <div class="card-container">
        @foreach($tasks ?? [] as $task)
        <div class="card">
            <img src="/img/tasks/{{$task->image}}" alt="{{ $task->title }}">
            <div class="card-body-content">
                <h2>{{ $task->title }}</h2>
                <p>{{ $task->description}}</p>
            </div>
            <hr>
            <div class="card-meta">
                <span class="card-creation-date">Criado em: {{date('d/m/Y', strtotime($task->date))}}</span>
                {{-- <span class="card-comments">Comentários: {{count($task->users)}}</span> --}}
            </div>
            <a href="/tasks/{{$task->id}}" class="btn card-view-button">Ver Tarefa</a>
        </div>
        @endforeach
    </div>
    @endsection