@extends('layouts.admin')
@section('title')
<h1 class="green text-uppercase"><strong class="gradientColor">{{ $project->title }}</strong></h1>
@endsection
@section('content')

<div class="d-flex justify-content-between">
    <div class="f-d-main-first-container f-d-transparent-layer">
        <p class="lightbrown fs-4 fw-bold">
            Description of the project
        </p>
        <p class="green fw-bold">
            {{ $project->description }}
        </p>
        <p class="lightbrown fs-4 fw-bold">
            Type of the project
        </p>
        @if ($project->type)
        <p class="green fw-bold">
            {{ $project->type->name }}
        </p>
        @endif
        <p class="lightbrown fs-4 fw-bold">
            Used Technologies
        </p>
        <p class="green fw-bold">
            {{ $project->technologies->pluck('name')->implode(', ') }}
        </p>
        <p class="lightbrown fs-4 fw-bold">
            Url of the project
        </p>
        <div class="d-flex bd-highlight mb-3">
            <p class="green fw-bold me-auto p-2 bd-highlight">
                {{ $project->url }}
            </p>
            <div class="p-2 bd-highlight">
                <a href="{{ route('admin.projects.edit', $project) }}" class="">
                    <button type="submit" class="f-d-button">
                        <i class="fa-solid fa-pen">
                        </i>
                    </button>
                </a>
            </div>
            <div class="p-2 bd-highlight">
                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="f-d-button" id="delete-button">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="f-d-main-second-container f-d-transparent-layer">
        <p class="lightbrown fs-4 fw-bold">
            Image of the project
        </p>
        <div class="w-100">
            <img class="f-d-img" src="{{ asset('storage/' . $project->image_path)}}" alt="Project Image">
        </div>
        <p class="text-center">
            <em class="green">Designed by <strong class="gradientColor fs-4">{{ Auth::user()->name }}</strong></em>
        </p>
    </div>
</div>
@endsection
@include('partials.deleteModal')

@section('sidebarContent')
@include('partials.sidebar');
@endsection