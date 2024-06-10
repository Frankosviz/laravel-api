@extends('layouts.admin')

@section('title')
<h1 class="green text-uppercase">Good Morning, <strong class="gradientColor">{{ Auth::user()->name }}</strong></h1>
@endsection

@section('content')
<section class="text-center">
</section>
<section>
    <div class="d-flex justify-content-between align-items-center">
        <div class="w-100">
            <table class="f-d-table">
                <tr>
                    <th class="text-center fw-bold gradientColor fs-4">Type of Project</th>
                    <th class="text-center fw-bold gradientColor fs-4">Details</th>
                    <th class="text-center fw-bold gradientColor fs-4"><a class="f-d-button"
                            href="{{ route('admin.types.create') }}"><i class="fa-solid fa-plus"></i></th></a>

                </tr>
                @foreach ($types as $type)
                    <tr>
                        <td class="green text">{{ $type->name }}</td>
                        <td class="d-flex align-items-center justify-content-center">
                            <a href="{{ route('admin.types.show', $type) }}" class="f-d-button">
                                <i class="fa-solid fa-eye">
                                </i>
                            </a>
                        </td>
                        <td>

                        </td>
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