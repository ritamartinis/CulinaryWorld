@extends('components.layout')

@section('content')
    <div class="container mt-5">
        <h2 class="text-light mb-4">Users</h2>
            @livewire('user-management')
        </div>
    </div>
@endsection
