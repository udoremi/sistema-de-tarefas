@extends('layouts.main')

@section('title', 'Criar Tarefa')

@section('content')

<div id="task-create-container" class="col-md-6 offset-md-3">
  <h1>Crie a sua tarefa</h1>
  <form action="/tasks" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="title">Titulo:</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Titulo da Tarefa">
    </div>
    <div class="form-group">
      <label for="title">Descrição:</label>
      <textarea name="description" id="description" class="form-control" placeholder="O que você precisa fazer?"></textarea>
    </div>
    <div class="form-group">
      <div class="drag-area">
        <div class="icon"><ion-icon name="cloud-upload-outline"></ion-icon></div>
        <header>Arrastar e soltar a imagem</header>
        <span>OU</span>
        {{-- Adicionado type="button" aqui --}}
        <button type="button" class="drag-area-browse-button">Procurar a imagem</button>
        <input type="file" id="image" name="image" hidden>
      </div>
    </div>
    <div class="form-group">
      <input type="submit" class="btn btn-create" value="Criar Tarefa">
    </div>
  </form>
</div>


<!-- <button class="nextBtn">
        <span class="btnText">Next</span>
        <i class="uil uil-navigator"></i>
      </button> -->

@endsection