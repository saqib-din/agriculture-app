@extends('layouts.landing')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">{{ $page->name }}</h2>

        <div class="page-content">
            {!! $page->content !!}
        </div>
    </div>
@endsection
