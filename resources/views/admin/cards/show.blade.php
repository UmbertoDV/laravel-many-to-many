@extends('layouts.app')

@section('title', $card->title)

@section('actions')
    <div>
      <a href="{{ route('admin.cards.index') }}" class="btn btn-primary float-end mx-1">Torna alla lista</a>
      <a href="{{ route('admin.cards.edit', $card) }}" class="btn btn-primary float-end mx-1">Modifica</a>
    </div>
@endsection

@section('content')
<section class="clearfix">

  <div class="card">
    <div class="card-body">
      <p>
        <strong>Categoria:</strong>
        @if($card->category) 
          {!! $card->category?->getBadgeHTML() !!}
        @else 
        Nessuna categoria
        @endif
      </p>
      <p>
        <strong>Tags:</strong>
        @forelse($card->tags as $tag) 
          {!! $tag->getBadgeHTML() !!}
        @empty 
          Nessun tag
        @endforelse
      </p>
      <p>
        <strong>Ultima modifica: </strong> {{ $card->updated_at }}
      </p>
      <p>
        <strong>Creato il: </strong> {{ $card->created_at }}
      </p>
      <div>
        <strong>Testo:</strong>
        <p>{{ $card->text }}</p>
      </div>
      <div>
        <img src="{{ $card->getImageUri() }}" alt="" width="250" class="me-3 mb-1">
      </div>
    </div>
  </div>
</section>
@endsection