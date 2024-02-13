@extends('layouts.admin')
@section('content')
    <div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/baglog')}}">Baglog</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Recipes</li>
        </ol> 
    </nav>
    </div>

    <div class="m-5">
        <h3>Data Recipes</h3>
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        @if(session()->has('messageDeleted'))
        <div class="alert alert-danger">
            {{ session()->get('messageDeleted') }}
        </div>
        @endif
        <table class = "table">
            <tr>
                <th>No Recipe</th>
                <th>Tanggal Keluar Recipe</th>
                <th>Total Bags</th>
                <th>Jenis Autoclave</th>
                <th>Weight per Bag</th>
            </tr>
            @foreach ( $recipes as $data)
                <tr>
                    <td><?php echo $data['NoRecipe'];?></td>
                    <td><?php echo $data['TanggalKeluar'];?></td>
                    <td><?php echo $data['TotalBags'];?></td>
                    <td><?php echo $data['JenisAutoclave'];?></td>
                    <td><?php echo $data['WeightperBag'];?></td>
                    <td><a class="btn btn-warning" href="{{route('UpdateRecipe', ['NoRecipe'=>$data->NoRecipe])}}">Update</a></td> 
                    <td>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Delete{{$data['id']}}">
                            Delete
                        </button>
                        <div class="modal fade" id="Delete{{$data['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">{{$data['NoRecipe']}}</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  Are you sure to delete data?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <a href="{{route('DeleteRecipe', ['NoRecipe'=>$data->id])}}" class="btn btn-danger">Delete</a>
                                </div>
                              </div>
                            </div>
                          </div>
                    </td> 
                    <td><a class="btn btn-primary" href="{{route('Assign', ['NoRecipe'=>$data->NoRecipe])}}">Assign</a></td> 
                </tr>
            @endforeach
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {!! $recipes->links() !!}
    </div>
@endsection