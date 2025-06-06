@extends('layouts.main')

@section('title', 'Editando a tarefa: ' . $task->title)

@section('content')

<div class="col-md-10 offset-md-1">
  <div class="task-container-coment">
    <div class="row g-0">
      <div id="image-container" class="col-md-6">
        <img src="{{ $task->image ? '/img/tasks/' . $task->image : '/img/task_placeholder.jpg' }}" class="img-fluid task-image-styled" alt="{{ $task->title ?? 'Taks Image' }}">
      </div>
      <div id="info-container" class="col-md-6 task-info-styled">
        <h1>{{ $task->title }}</h1>
        <span><ion-icon name="calendar-outline"></ion-icon> {{ date('d/m/Y', strtotime($task->date)) }}</span>
        <p class="task-description">{{ $task->description }}</p>
      </div>
    </div>
  </div>
</div>

<div class="col-md-10 offset-md-1 mt-4" id="comments-section">

  @auth
  <div class="mt-4 pt-3 add-comment">
    <h3>Adicionar um novo comentário:</h3>
    <form action="{{ route('comments.store', ['taskId' => $task->id]) }}" method="POST">
      @csrf
      <div class="form-group mb-2">
        <textarea name="comentario" class="form-control @error('comentario') is-invalid @enderror" rows="3" placeholder="Escreva seu comentário...">{{ old('comentario') }}</textarea>
        {{-- Erro para o campo 'comentario' do formulário de adicionar novo comentário --}}
        @error('comentario')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <button type="submit" class="btn btn-save-comment">Adicionar Comentário</button>
    </form>
  </div>
  @else
  <p class="mt-4 pt-3 border-top"><a href="{{ route('login') }}">Faça login</a> ou <a href="{{ route('register') }}">registre-se</a> para deixar um comentário.</p>
  @endauth

  <h2>Comentários ({{ $task->comments->count() }})</h2>

  @if($task->comments->isEmpty())
  <p>Ainda não há comentários para esta tarefa.</p>
  @else

  <ul>
    @foreach ($task->comments as $comment)
    <li>
      @if (isset($editingComment) && $editingComment->id == $comment->id)
      <form action="{{ route('comments.update', ['taskId' => $task->id, 'commentId' => $comment->id]) }}" method="POST" class="comment-edit-form">
        @csrf
        @method('PUT')
        <div class="form-group mb-2">
          <textarea name="comentario" class="form-control @error('comentario') is-invalid @enderror" rows="3">{{ old('comentario', $comment->comentario) }}</textarea>
          @error('comentario')
          <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>
        <button type="submit" class="btn btn-sm btn-alter-comment">Salvar Alterações</button>
        <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-secondary btn-sm">Cancelar</a>
      </form>
      @else
      <div class="comment-container">
        <p class="mb-1">{{ $comment->comentario }}</p>
        <div class="comment-action">
          <small class="text-muted">
            Postado em: {{ $comment->created_at->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i') }}
            @if($comment->created_at->ne($comment->updated_at))
            (editado em: {{ $comment->updated_at->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i') }})
            @endif
          </small>

          @auth
          @if(Auth::id() == $comment->user_id /* || Auth::user()->isAdmin() */ )
          <div class="comment-btns">
            <a href="{{ route('comments.edit', ['taskId' => $task->id, 'commentId' => $comment->id]) }}" class="btn btn-info btn-sm">
              <ion-icon name="create-outline"></ion-icon> Editar
            </a>
            <form action="{{ route('comments.destroy', ['taskId' => $task->id, 'commentId' => $comment->id]) }}" method="POST" style="display: inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este comentário?')">
                <ion-icon name="trash-outline"></ion-icon> Deletar
              </button>
            </form>
          </div>
        </div>
      </div>
      @endif
      @endauth
      @endif
    </li>
    <div style="width: 100%; border: 1px solid rgb(228, 228, 228); margin-bottom: 15px;"></div>
    @endforeach
  </ul>
  @endif
</div>

@endsection