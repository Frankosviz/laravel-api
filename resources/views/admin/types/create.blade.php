@extends('layouts.admin')
@section('title')
<h1 class="green text-uppercase"><strong class="gradientColor">Create a new Type</strong></h1>
@endsection
@section('content')
<div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
<div>
    <!-- <p>
        {{$type->projects->count()}} projects
    </p> -->
</div>
<form class="h-100" action="{{ route('admin.types.store', $type->slug) }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="f-d-editform-container f-d-transparent-layer-edit">
        @error('title', 'description', 'image_path', 'repository_url', 'url', 'technologies_used', 'start_date', 'end_date', 'status')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="types" class="form-label lightbrown fw-bold">Types</label>
            <div class="input-group">
                <input type="text" class="form-control f-d-bg-form @error('types') types.required @enderror" name="types" aria-describedby="basic-addon3 basic-addon4">
                {{ old('types') }}
            </div>
        </div>
</form>


@endsection

@section('sidebarContent')
@include('partials.sidebar');
@endsection