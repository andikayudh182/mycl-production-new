@extends('layouts.operator')

@section('content')
<div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/biobo') }}">Biobo</a></li>
            <li class="breadcrumb-item active" aria-current="page">Post Treatment 1</li>
        </ol>
    </nav>
</div>

<section class="list-group position-absolute top-50 start-50 translate-middle">
    <a href="{{url('/operator/biobo/input-pt-1')}}" class="list-group-item list-group-item-action">Input</a><br>
    <a href="{{url('/operator/biobo/monitoring-post-treatment-1')}}" class="list-group-item list-group-item-action">Monitoring Post Treatment 1</a><br>
</section>
@endsection