@extends('layouts.app')

@section('title', $category->label)

@section('content')
<section class="clearfix">
  <a href="{{ route('admin.categories.index') }}" class="btn btn-primary float-end mx-1">Torna alla lista</a>
  <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary float-end mx-1">Modifica Categoria</a>

  <div class="card">
    <div class="card-body">
      <p>
        <strong>Categoria:</strong>
        <span class="badge rounded-pill" style="background-color: {{ $category->color }}">{{ $category->label }}</span>
      </p>
      {{-- <div>
        <strong>Testo:</strong>
        <p>{{ $card->text }}</p>
      </div>
      <div>
        <img src="{{ $card->getImageUri() }}" alt="" width="250" class="me-3 mb-1">
      </div> --}}
    </div>
  </div>
</section>
@endsection