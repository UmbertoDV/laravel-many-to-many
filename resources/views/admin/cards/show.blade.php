@extends('layouts.app')

@section('title', $card->title)

@section('content')
<section class="clearfix">
  <a href="{{ route('admin.cards.index') }}" class="btn btn-primary float-end mx-1">Torna alla lista</a>
  <a href="{{ route('admin.cards.edit', $card) }}" class="btn btn-primary float-end mx-1">Modifica</a>

  <div class="card">
    <div class="card-body">
      <p>
        <strong>Categoria:</strong>
        <span class="badge rounded-pill" style="background-color: {{ $card->category?->color }}">{{ $card->category?->label }}</span>
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