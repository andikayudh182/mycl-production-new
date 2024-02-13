@extends('layouts.admin')

@section('content')
<section class="body m-5 align-middle" style="display: d-block;">
    @include('admin.mylea.MyleaChart')
</section>
<section class="body m-5 align-middle">
    <h3>Kontaminasi</h3>
    <table class="table md-5">
        <tr>
            <th>Jan</th>
            <th>Feb</th>
            <th>Mar</th>
            <th>Apr</th>
            <th>May</th>
            <th>Jun</th>
            <th>Jul</th>
            <th>Aug</th>
            <th>Sep</th>
            <th>Oct</th>
            <th>Nov</th>
            <th>Dec</th>
        </tr>
        <tr>
            <td>
                @if($Data['DataPoint'][1] != 0)
                {{number_format($Data['DataPoint3'][1],2)}} %
                @else
                    0%
                @endif
            </td>
            <td>
                @if($Data['DataPoint'][2] != 0)
                {{number_format($Data['DataPoint3'][2],2)}} %
                @else
                    0%
                @endif
            </td>
            <td>
                @if($Data['DataPoint'][3] != 0)
                {{number_format($Data['DataPoint3'][3],2)}} %
                @else
                    0%
                @endif
            </td>
            <td>
                @if($Data['DataPoint'][4] != 0)
                {{number_format($Data['DataPoint2'][4],2)}} %
                @else
                    0%
                @endif
            </td>
            <td>
                @if($Data['DataPoint'][5] != 0)
                {{number_format($Data['DataPoint3'][5],2)}} %
                @else
                    0%
                @endif
            </td>
            <td>
                @if($Data['DataPoint'][6] != 0)
                {{number_format($Data['DataPoint3'][6],2)}} %
                @else
                    0%
                @endif
            </td>
            <td>
                @if($Data['DataPoint'][7] != 0)
                {{number_format($Data['DataPoint3'][7],2)}} %
                @else
                    0%
                @endif
            </td>
            <td>
                @if($Data['DataPoint'][8] != 0)
                {{number_format($Data['DataPoint3'][8],2)}} %
                @else
                    0%
                @endif
            </td>
            <td>
                @if($Data['DataPoint'][9] != 0)
                {{number_format($Data['DataPoint3'][9],2)}} %
                @else
                    0%
                @endif
            </td>
            <td>
                @if($Data['DataPoint'][10] != 0)
                {{number_format($Data['DataPoint3'][10], 2)}} %
                @else
                    0%
                @endif
            </td>
            <td>
                @if($Data['DataPoint'][11] != 0)
                {{number_format($Data['DataPoint3'][11], 2)}} %
                @else
                    0%
                @endif
            </td>
            <td>
                @if($Data['DataPoint'][12] != 0)
                {{number_format($Data['DataPoint3'][12], 2)}} %
                @else
                    0%
                @endif
            </td>
        </tr>
    </table>
</section>

<section class="mx-auto col-md-3 align-middle" style="height: 80vh;">
    <a href="{{url('/admin/mylea/order-produksi')}}" class="list-group-item list-group-item-action">Order Produksi</a><br>
    <a href="{{url('/admin/mylea/report')}}" class="list-group-item list-group-item-action">Report</a><br>
    <a href="{{url('/admin/mylea/post-treatment')}}" class="list-group-item list-group-item-action">Post Treatment Mylea</a><br>
</section>
@endsection