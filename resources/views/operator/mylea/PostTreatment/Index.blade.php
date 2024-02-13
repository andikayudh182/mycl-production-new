@extends('layouts.operator')

@section('content')
<section class="list-group position-absolute top-50 start-50 translate-middle">
    <a href="{{ url('/operator/mylea/post-treatment/qc1') }}" class="list-group-item list-group-item-action">Quality Control 1</a><br>
    <a href="{{ url('/operator/mylea/post-treatment/monitoring') }}" class="list-group-item list-group-item-action">Proses Post Treatment</a><br>
    <a href="{{url('/operator/mylea/post-treatment/qc2')}}" class="list-group-item list-group-item-action">Quality Control 2</a><br>
</section>
@endsection