@extends('layouts.guest')
@section('content')

<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">Card più recenti</div>

                <div class="card-body">
                    @dump($recent_cards)
                </div>
            </div>
        </div>
    </div>
</div>
@endsection