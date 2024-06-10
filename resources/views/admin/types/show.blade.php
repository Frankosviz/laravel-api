@extends('layouts.admin')
@section('title')
<h1 class="green text-uppercase"><strong class="gradientColor">{{ $types->name }}</strong></h1>
@endsection
@section('content')

<div class="d-flex justify-content-between">
    <div class="f-d-main-first-container f-d-transparent-layer">
        <p class="lightbrown fs-4 fw-bold text-center">
            {{ $types->name }} projects
        </p>
        <p id="clickTypesProject" class="green fw-bold d-flex flex-column flex-wrap gap-2 justify-content-between text-center gradientColor">
            @foreach ($types->projects as $project)
                <a class="gradientColor fs-4" href="{{ route('admin.projects.show', $project) }}">|
                    {{ $project->title }} |</a>
            @endforeach
        </p>
    </div>
</div>

@endsection
@section('sidebarContent')
@include('partials.sidebar');
@endsection