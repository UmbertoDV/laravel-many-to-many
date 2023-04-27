@extends('layouts.app')

@section('title', 'Categorie')

@section('actions')
    <div>
      <a class="btn btn-primary" href="{{ route('admin.categories.create') }}">Crea nuova categoria</a>
    </div>
    {{-- <div>
      <a class="btn btn-primary" href="{{ route('admin.categories.trash') }}">Cestino</a>
    </div> --}}
@endsection

@section('content')
<section>
  <div class="container p-0">
    <div class="card px-4">

      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col"><a href="{{ route('admin.categories.index') }}?sort=id&order={{ $sort == 'id' && $order != 'DESC' ? 'DESC' : 'ASC' }}">ID
            @if ($sort == "id")
              <i class="bi bi-arrow-down d-inline-block @if($order == 'DESC') rotate-180-my @endif"></i>
            @endif
            </a></th>
            <th scope="col"><a href="{{ route('admin.categories.index') }}?sort=label&order={{ $sort == 'label' && $order != 'DESC' ? 'DESC' : 'ASC' }}">Label
              @if ($sort == "label")
              <i class="bi bi-arrow-down d-inline-block  @if($order == 'DESC') rotate-180-my @endif"></i>
              @endif
            </a></th>
            <th scope="col"><a href="{{ route('admin.categories.index') }}?sort=color&order={{ $sort == 'color' && $order != 'DESC' ? 'DESC' : 'ASC' }}">Colore
              @if ($sort == "color")
              <i class="bi bi-arrow-down d-inline-block  @if($order == 'DESC') rotate-180-my @endif"></i>
              @endif
            </a></th>
            <th scope="col">Pill</th>
            <th scope="col"><a href="{{ route('admin.categories.index') }}?sort=updated_at&order={{ $sort == 'updated_at' && $order != 'DESC' ? 'DESC' : 'ASC' }}">Ultima Modifica
              @if ($sort == "updated_at")
                <i class="bi bi-arrow-down d-inline-block  @if($order == 'DESC') rotate-180-my @endif"></i>
              @endif
              </a></th>
              <th scope="col"><a href="{{ route('admin.categories.index') }}?sort=created_at&order={{ $sort == 'created_at' && $order != 'DESC' ? 'DESC' : 'ASC' }}">Creazione
                @if ($sort == "created_at")
                  <i class="bi bi-arrow-down d-inline-block  @if($order == 'DESC') rotate-180-my @endif"></i>
                @endif
                </a></th>
            <th scope="col">Azioni</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($categories as $category)
            <tr>
              <th scope="row">{{ $category->id }}</th>
              <td>{{ $category->label }}</td>
              <td>{{ $category->color }}</td>
              <td><span class="badge rounded-pill" style="background-color: {{ $category->color }}">{{ $category->label }}</span></td>
              <td>{{ $category->updated_at }}</td>
              <td>{{ $category->created_at }}</td>
              <td>
                {{-- <a href="{{ route('admin.categories.show', $category) }}"><i class="bi bi-eye mx-2"></i></a> --}}
                <a href="{{ route('admin.categories.edit', $category) }}"><i class="bi bi-pencil mx-2"></i></i></a>
                <a href="{{ route('admin.categories.edit', $category) }}" class="text-danger" data-bs-toggle="modal" data-bs-target="#delete-modal-category-{{ $category->id }}"><i class="bi bi-trash mx-2"></i></i></a>
              </td>
            </tr>
            @empty
          @endforelse
        </tbody>
      </table>
  
      {{ $categories->links() }}
    </div>

  </div>
</section>
@endsection

@section('modals')
    @foreach ($categories as $category)
      

      <div class="modal modal-lg fade" id="delete-modal-category-{{ $category->id }}" tabindex="-1" aria-labelledby="delete-modal-category-{{ $category->id }}-label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="delete-modal-post-{{ $category->id }}-label">Rimuovi categoria</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Sei sicuro di voler eliminare la categoria "{{ $category->title }}"? <br>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
              <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Elimina</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endforeach
@endsection