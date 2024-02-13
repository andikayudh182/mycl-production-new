<?php
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\baglog\baglogrecipe;
use App\Models\baglog\Bahan_Recipe;
use App\Models\baglog\Details_Recipe;
use App\Models\baglog\Kartu_Kendali;
use App\Models\baglog\Kontaminasi;
use App\Models\baglog\Mixing;
use App\Models\baglog\Sterilisasi;
use App\Models\Mylea\MyleaBaglogPemakaian;
use App\Models\Mylea\MyleaBaglog;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
?>
<div class="modal fade" id="DetailProduksi{{$data1['idBaglog']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data {{$data1['KodeProduksi']}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @if($data1['Sterilisasi'] != null)
                <table class="table">
                    <tr>
                        <th>No Recipe</th>
                        <th>Tanggal Mixing</th>
                        <th>Keterangan Mixing</th>
                        <th>Tanggal Sterilisasi</th>
                        <th>No Batch</th>
                        <th>Jenis Autoclave</th>
                        <th>No Recipe</th>
                        <th>Jumlah</th>
                        <th>Keterangan Sterilisasi</th>
                    </tr>
                    @php
                        $SterilisasiID = explode(", " , $data1['SterilisasiID']);
                        $i = 0;
                    @endphp
                    @foreach($SterilisasiID as $item)
                        @php
                            $DataSteril = Sterilisasi::where('baglog_sterilisasi.id', $SterilisasiID[$i])
                            ->leftJoin('baglog_mixing', 'baglog_sterilisasi.MixingID', '=', 'baglog_mixing.id')
                            ->select('baglog_mixing.NoRecipe','baglog_mixing.TanggalMixing', 'baglog_mixing.Keterangan AS KeteranganMixing', 'baglog_sterilisasi.*')
                            ->first();
                            $i++;
                        @endphp
                        @if(isset($DataSteril))
                        <tr>
                            <td>{{$DataSteril['NoRecipe']}}</td>
                            <td>{{$DataSteril['TanggalMixing']}}</td>
                            <td>{{$DataSteril['KeteranganMixing']}}</td>
                            <td>{{$DataSteril['TanggalSterilisasi']}}</td>
                            <td>{{$DataSteril['NoBatch']}}</td>
                            <td>{{$DataSteril['JenisAutoclave']}}</td>
                            <td>{{$DataSteril['NoRecipe']}}</td>
                            <td>{{$DataSteril['Jumlah']}}</td>
                            <td>{{$DataSteril['Keterangan']}}</td>
                        </tr>
                        @endif
                    @endforeach
                </table>
            @endif
            @if($data1['UjiCoba'])
            <h4>Uji Coba</h4>
            <table class="table">
                <tr>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
                @foreach($data1['UjiCoba'] as $DataUjiCoba)
                    <tr>
                        <td>{{$DataUjiCoba['Tanggal']}}</td>
                        <td>{{$DataUjiCoba['Jumlah']}}</td>
                        <td>{{$DataUjiCoba['Keterangan']}}</td>
                        <td>
                            <a href="{{url('admin/baglog/uji-coba-delete', ['id'=>$DataUjiCoba['id'],])}}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{-- {{ $data1['MyleaAdmin'] }} --}}

            @endif
            @if($data1['JenisBibit'] !=='GN')
                @if($data1['MyleaAdmin'] != null)
                    <h4>Input Admin</h4>
                    <table class="table">
                        <tr>
                            <th>Kode Produksi Mylea</th>
                            <th>Jumlah</th>
                        </tr>
                        @foreach($data1['MyleaAdmin'] as $DataMylea)
                            <tr>
                                <td>{{$DataMylea['KodeMylea']}}</td>
                                <td>{{$DataMylea['Jumlah']}}</td>
                            </tr>
                        @endforeach
                    </table>
                @endif
                @if($data1['MyleaOperator'] != null)
                <h4>Input Operator</h4>
                <table class="table">
                    <tr>
                        <th>Kode Produksi Mylea</th>
                        <th>Jumlah</th>

                    </tr>
                    @foreach($data1['MyleaOperator'] as $DataMylea)
                        <tr>
                            <td>{{$DataMylea['KodeMylea']}}</td>
                            <td>{{$DataMylea['Jumlah']}}</td>
                        </tr>
                    @endforeach
                </table>
                @endif
            @else
                @if($data1['CompositeAdmin'] != null)
                    <h4>Input Admin</h4>
                    <table class="table">
                        <tr>
                            <th>Kode Produksi Composite</th>
                            <th>Jumlah</th>
                        </tr>
                        @foreach($data1['CompositeAdmin'] as $DataComposite)
                            <tr>
                                <td>{{$DataComposite['KodeComposite']}}</td>
                                <td>{{$DataComposite['Jumlah']}}</td>
                            </tr>
                        @endforeach
                    </table>
                @endif
                @if($data1['CompositeOperator'] != null)
                <h4>Input Operator</h4>
                <table class="table">
                    <tr>
                        <th>Kode Produksi Composite</th>
                        <th>Jumlah</th>

                    </tr>
                    @foreach($data1['CompositeOperator'] as $DataComposite)
                        <tr>
                            <td>{{$DataComposite['KodeComposite']}}</td>
                            <td>{{$DataComposite['Jumlah']}}</td>
                        </tr>
                    @endforeach
                </table>
                @endif

            @endif


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> 
      </div>
    </div>
  </div>