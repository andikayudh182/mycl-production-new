@extends('layouts.admin')

@section('content')
    <section class="list-group position-absolute top-50 start-50 translate-middle">
        <a href="{{url('/admin/mylea/post-treatment/monitoring')}}" class="list-group-item list-group-item-action">Monitoring</a><br>
        <a href="{{url('/admin/mylea/post-treatment/add-stock')}}" class="list-group-item list-group-item-action">Add Stock</a><br>
        <a href="{{url('/admin/mylea/post-treatment/stock-card')}}" class="list-group-item list-group-item-action">Tempe Stock Card</a><br>
    </section>
@endsection