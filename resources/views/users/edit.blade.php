@extends('layout.layout')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-side-bar')
        </div>
        <div class="col-6">
            @include('shared.success-message')
            <div class="mt-3">
                @include('users.shared.user-edit-card')
            </div>
            <hr>
            @forelse ($ideas as $idea)
                <div class="mt-3">
                    @include('ideas.shared.idea-card')
                </div>
            @empty
                <p class="text-center my-3">No ideas found.</p>
            @endforelse
            <div class="mt-4">
                {{ $ideas->withQueryString()->links() }}
            </div>

        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-box')
        </div>
    </div>
@endsection
