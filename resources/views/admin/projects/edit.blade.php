@extends('layouts.admin')
@section('title')
<h1 class="green text-uppercase"><strong class="gradientColor">{{ $project->title }}</strong></h1>
@endsection
@section('content')
<form action="{{ route('admin.projects.update', $project->slug) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="f-d-editform-container f-d-transparent-layer-edit">
    @error('title', 'description', 'image_path', 'repository_url', 'url', 'technologies_used', 'start_date', 'end_date', 'status')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
<div class="mb-3">
        <label for="title" class="form-label lightbrown fw-bold">Title</label>
        <div class="input-group">
            <input type="text" class="form-control f-d-bg-form @error('title') title.required @enderror" name="title" value="{{ $project->title }}" aria-describedby="basic-addon3 basic-addon4">
        </div>
    </div>

    <div class="mb-3">
        <div class="media">
            @if ($project->image_path)
            <img class="shadow" width="150" src="{{ asset('storage/' . $project->image_path)}}" id="uploadPreview" alt="{{ $project->title}}">
            @else 
            <img class="shadow" width="150" src="{{"images/placeholder.webp"}}" id="uploadPreview" alt="{{ $project->title}}">
            @endif
        </div>
        <label for="image_path" class="form-label lightbrown fw-bold">Image</label>
        <div class="input-group">
            <input type="file" accept="image/*" id="upload_image" class="form-control f-d-bg-form @error('image_path') is-invalid @enderror" name="image_path" value="{{old('image_path', $project->image_path)}}" aria-describedby="basic-addon3 basic-addon4">
        </div>
    </div>

    <div class="mb-3">
        <label for="repository_url" class="form-label lightbrown fw-bold">Repo URL</label>
        <div class="input-group">
            <input type="text" class="form-control f-d-bg-form @error('repository_url') is-invalid @enderror" name="repository_url" value="{{old('repository_url', $project->repository_url)}}" aria-describedby="basic-addon3 basic-addon4">
        </div>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label lightbrown fw-bold">Description</label>
        <textarea name="description" id="" cols="30" rows="10" class="form-control f-d-bg-form @error('description') description.min|max @enderror">{{ old('description', $project->description)}}</textarea>
    </div>
    <div class="mb-3">
            <label for="technologies_used" class="form-label lightbrown fw-bold">Types</label>
            <div class="input-group">
                <select name="type_id" id="type_id"
                    class="form-select f-d-bg-form @error('type_id') type_id.required @enderror">
                    @foreach ($types as $type)
                        <option class="f-d-bg-form" value="{{ $type->id }}">
                            {{ $type->id == $project->type_id ? 'selected' : '' }} {{ $type->name }} </option>
                    @endforeach
                </select>
            </div>
        </div>
    <div class="mb-3">
        <label for="start_date" class="form-label lightbrown fw-bold">Start Date</label>
        <div class="input-group">
            <input type="date" class="form-control f-d-bg-form @error('start_date') is-invalid @enderror" name="start_date" value="{{old('start_date', $project->start_date)}}" aria-describedby="basic-addon3 basic-addon4">
        </div>
    </div>

    <div class="mb-3">
        <label for="end_date" class="form-label lightbrown fw-bold">End Date</label>
        <div class="input-group">
            <input type="date" class="form-control f-d-bg-form @error('end_date') end_date.after @enderror" name="end_date" value="{{old('end_date', $project->end_date)}}" aria-describedby="basic-addon3 basic-addon4">
        </div>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label lightbrown fw-bold">Status</label>
        <select name="status" id="status" class="form-select f-d-bg-form @error('status') status.required @enderror" value="{{ $project->status }}" required>
            <option value="not started" {{old('status', $project->status == 'Not Started' ? 'selected' : '')}} >Not Started</option>
            <option value="started" {{old('status', $project->status == 'Started' ? 'selected' : '')}}>Started</option>
            <option value="finished" {{old('status', $project->status == 'Finished' ? 'selected' : '')}}>Finished</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="url" class="form-label lightbrown fw-bold">Url</label>
        <div class="input-group">
            <input type="text" class="form-control f-d-bg-form @error('url') url.required @enderror" name="url" value="{{old('url', $project->url)}}" aria-describedby="basic-addon3 basic-addon4">
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-center">
     <button type="submit" class="f-d-button-form">Update</button>
     <button type="reset" class="f-d-button-form-cancel">Cancel</button>
    </div>
</div>
</form>


@endsection

@section('sidebarContent')
@include('partials.sidebar');
@endsection