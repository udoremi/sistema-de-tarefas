@extends('layouts.main')

@section('title', 'Editando: ' . $task->title)

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Editando: {{$task->title}}</h1>
  <form action="/tasks/update/{{$task->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="title">Titulo:</label>
      <input type="text" class="form-control" id="title" name="title" value="{{$task->title}}">
    </div>

    <div class="form-group">
      <label for="title">Descrição:</label>
      <textarea name="description" id="description" class="form-control">{{$task->description}}</textarea>
    </div>

    <div class="form-group">
      <label for="title">A tarefa está finalizada?</label>
      <select name="private" id="private" class="form-control">
        @if($task->status == 0)
        <option value="0">Não</option>
        <option value="1">Sim</option>
        @else
        <option value="1">Sim</option>
        <option value="0">Não</option>
        @endif
      </select>
    </div>

    <div class="form-group" style="display: flex; align-items: center; justify-content: center; gap: 40px;">
      <div class="drag-area">
        <div class="icon"><ion-icon name="cloud-upload-outline"></ion-icon></div>
        <header>Arrastar e soltar a imagem</header>
        <span>OU</span>
        <button type="button" class="drag-area-browse-button">Procurar a imagem</button>
        <input type="file" id="image" name="image" hidden>
      </div>
      <img src="/img/tasks/{{$task->image}}" alt="{{$task->title}}" class="img-preview">
    </div>

    <div class="form-group">
      <input type="submit" class="btn btn-edit" value="Editar Tarefa">
    </div>

  </form>
</div>

@endsection