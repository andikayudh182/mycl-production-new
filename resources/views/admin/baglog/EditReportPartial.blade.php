<div class="modal fade" id="EditModal{{$data1['idBaglog']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data {{$data1['KodeProduksi']}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{url('/admin/baglog/report-edit')}}" class="m-5">
              @csrf
              <input type="hidden"  name="id" value="{{$data1['idBaglog']}}">
              <input type="hidden"  name="KodeProduksi" value="{{$data1['KodeProduksi']}}">
              <input type="hidden"  name="NoRecipe" value="{{$data1['NoRecipe']}}">
              <div class="row mb-3 ">
                <label for="NoBatch" class="col-sm-2 col-form-label col-form-label-sm">No Batch :</label>
                <div class="col-sm-5">
                    {{-- <input type="text" name="NoBatch" class="form-control form-control-sm" id="colFormLabelSm" value="{{ $data1['Sterilisasi'][0]['NoBatch'] }}">       --}}
                @if(isset($data1['Sterilisasi'][0]['NoBatch']))
                    <input type="text" name="NoBatch" class="form-control form-control-sm" id="colFormLabelSm" value="{{ $data1['Sterilisasi'][0]['NoBatch'] }}">      
                @else
                    <input type="text" name="NoBatch" class="form-control form-control-sm" id="colFormLabelSm" value="{{ $data1['KodeProduksi'][2] }}">
                @endif
                </div>
            </div>
              <div class="row mb-3 ">
                  <label for="TanggalPembibitan" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Pembibitan :</label>
                  <div class="col-sm-5">
                      <input type="date"  name="TanggalPembibitan" value="{{$data1['TanggalPembibitan']}}" class="form-control form-control-sm  @error('TanggalPembibitan') is-invalid @enderror" id="colFormLabelSm">
                      @error('TanggalPembibitan')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
              </div>
              <div class="row mb-3 ">
                  <label for="JumlahBaglog" class="col-sm-2 col-form-label col-form-label-sm">Jumlah Baglog  :</label>
                  <div class="col-sm-5">
                      <input type="number"  name="JumlahBaglog" value="{{$data1['JumlahBaglog']}}" class="form-control form-control-sm  @error('JumlahBaglog') is-invalid @enderror" id="colFormLabelSm">
                      @error('JumlahBaglog')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
              </div>
              <div class="row mb-3 ">
                <label for="Lokasi" class="col-sm-2 col-form-label col-form-label-sm">Lokasi  :</label>
                <div class="col-sm-5">
                    <input type="text"  name="Lokasi" value="{{$data1['Lokasi']}}" class="form-control form-control-sm  @error('Lokasi') is-invalid @enderror" id="colFormLabelSm">
                    @error('Lokasi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
              </div>
              <div class="row mb-3 ">
                <label for="Keterangan" class="col-sm-2 col-form-label col-form-label-sm">Keterangan  :</label>
                <div class="col-sm-5">
                    <input type="text"  name="Keterangan" value="{{$data1['Keterangan']}}" class="form-control form-control-sm  @error('Keterangan') is-invalid @enderror" id="colFormLabelSm">
                    @error('Keterangan')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
              </div>
              <div class="row mb-3 ">
                <label for="Status" class="col-sm-2 col-form-label col-form-label-sm">Status  :</label>
                <div class="col-sm-5">
                  <select name="Status" class="form-control form-control-sm" id="colFormLabelSm">
                    @if($data1['Status']==1)
                      <option value="1">Sudah Selesai Inkubasi</option>
                    @else
                      <option value="0">Dalam Proses Inkubasi</option>
                    @endif
                    <option value="1">Sudah Selesai Inkubasi</option>
                    <option value="0">Dalam Proses Inkubasi</option>
                  </select>
                </div>
              </div>

              <div class="row mb-3 ">
                <label for="JenisBibit" class="col-sm-2 col-form-label col-form-label-sm">Jenis Bibit :</label>
                <div class="col-sm-5">
                  <select name="JenisBibit" class="form-control form-control-sm @error('JenisBibit') is-invalid @enderror" id="colFormLabelSmJenisBaglog">
                    @if($data1['JenisBibit'] == 'GN' )
                      <option value="GN">GN</option>
                    @elseif($data1['JenisBibit'] == 'TP')
                      <option value="TP">Tempe</option>
                    @else
                      <option value="">Pilih Jenis Bibit</option>
                    @endif
                    <option value="GN">GN</option>
                    <option value="TP">Tempe</option>
                  </select>
                    @error('JenisBibit')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

              <div class="row mb-3 ">
                <label for="TanggalBibit" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Bibit :</label>
                <div class="col-sm-5">
                    <input type="date"  name="TanggalBibit" value="{{$data1['TanggalBibit']}}" class="form-control form-control-sm  @error('TanggalBibit') is-invalid @enderror" id="colFormLabelSm">
                    @error('TanggalBibit')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="JumlahBibit" class="col-sm-2 col-form-label col-form-label-sm">Jumlah Bibit  :</label>
                <div class="col-sm-5">
                    <input type="number"  name="JumlahBibit" value="{{$data1['JumlahBibit']}}" class="form-control form-control-sm  @error('JumlahBibit') is-invalid @enderror" id="colFormLabelSm">
                    @error('JumlahBibit')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3 ">
              <label for="KeteranganBibit" class="col-sm-2 col-form-label col-form-label-sm">Keterangan Bibit  :</label>
              <div class="col-sm-5">
                  <input type="text"  name="KeteranganBibit" value="{{$data1['KeteranganBibit']}}" class="form-control form-control-sm  @error('KeteranganBibit') is-invalid @enderror" id="colFormLabelSm">
                  @error('KeteranganBibit')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
            </div>
              <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> 
      </div>
    </div>
  </div>