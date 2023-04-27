@extends('layouts.app')

@section('title', ($category->id) ? 'Modifica Categoria ' . $category->label : 'Crea Categoria')

@section('actions')
    <div>
      <a class="btn btn-primary" href="{{ route('admin.categories.index') }}">Torna alla lista</a>
      {{-- @if ($card->id)
        <a href="{{ route('admin.cards.show', $card) }}" class="btn btn-primary mx-1">Mostra Categoria</a>
      @endif --}}
    </div>
@endsection

@section('content')

    @include('layouts.partials.errors')

<section class="card">
    <div class="card-body">

      @if ($category->id)
        <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data">
          @method('PUT')
      @else
      <form method="POST" action="{{ route('admin.categories.store') }}" class="row" enctype="multipart/form-data">
      @endif

      @csrf

      <div class="col-4 mb-3">
        <label for="label" class="form-label">Label</label>
        <input type="text" name="label" id="label" class="form-control @error('label') is-invalid @enderror" value="{{ old('label', $category->label)  }}" >
        @error('label')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="col-4 mb-3">
        <label for="color" class="form-label">Colore</label>
        <input type="color" name="color" id="color" class="form-control @error('color') is-invalid @enderror" value="{{ old('color', $category->color)  }}" >
        @error('color')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div>
        <input type="submit" class="btn btn-primary" value="Salva">
      </div>
      
      </form>
    </div>
</section>

@endsection