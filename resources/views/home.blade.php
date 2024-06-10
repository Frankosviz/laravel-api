@extends('layouts.app')
@section('title')

@endsection
@section('content')
<section class="text-center">
</section>
<section>
    <div class="d-flex justify-content-between align-items-center">
        <div class="w-100">
            <div class="w-100 f-d-transparent-layer text-center mt-3">
                <h1 class="gradientColor text-uppercase">Top Frankosviz public Projects</h1>
            </div>
            <table class="f-d-table">
                <tr>
                    <th class="text-center fw-bold gradientColor fs-4">Title</th>
                    <th class="text-center fw-bold gradientColor fs-4">Repo-Url</th>

                </tr>
                @foreach ($projects as $project)
                    <tr>
                        <td class="green">{{ $project->title }}</td>
                        <td class="green">{{ $project->repository_url }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>


</section>
@endsection

@section('sidebarContent')
@include('partials.sidebar');
@endsection