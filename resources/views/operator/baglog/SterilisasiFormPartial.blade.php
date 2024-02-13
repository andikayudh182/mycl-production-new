<div class="modal fade" id="SterilisasiModal{{$data['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Submit Sterilisasi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ url('operator/baglog/submit-sterilisasi') }}" method="POST">
                @csrf
                <input type="hidden" name="MixingID" value="{{$data['id']}}">
                <div class="row mb-3 ">
                    <label for="NoRecipe" class="col-sm-4 col-form-label col-form-label-sm">No Recipe :</label>
                    <div class="col-sm-5">
                        <input type="text" name="NoRecipe" class="form-control form-control-sm" id="colFormLabelSm"  value="{{$data['Details']['NoRecipe']}}" readonly>
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="NoBatch" class="col-sm-4 col-form-label col-form-label-sm">No Batch :</label>
                    <div class="col-sm-5">
                        <input type="text" name="NoBatch" class="form-control form-control-sm" id="colFormLabelSm" value="{{$data['BatchSterilisasi']}}" readonly>  
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="JenisAutoclave" class="col-sm-4 col-form-label col-form-label-sm">Jenis Autoclave :</label>
                    <div class="col-sm-5">
                        <input type="text" name="JenisAutoclave" class="form-control form-control-sm" id="colFormLabelSm" value="{{$data['Details']['JenisAutoclave']}}" readonly>
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="Jumlah" class="col-sm-4 col-form-label col-form-label-sm">Jumlah :</label>
                    <div class="col-sm-5">
                        <input type="number" name="Jumlah" class="form-control form-control-sm" id="colFormLabelSm"  value="{{$data['Details']['TotalBags']}}" readonly>
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="Tanggal" class="col-sm-4 col-form-label col-form-label-sm">Tanggal :</label>
                    <div class="col-sm-5">
                        <input type="date" name="Tanggal" class="form-control form-control-sm" id="colFormLabelSm" value="{{$data['TanggalSterilisasi']}}">
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="Keterangan" class="col-sm-4 col-form-label col-form-label-sm">Keterangan :</label>
                    <div class="col-sm-5">
                        <input type="text" name="Keterangan" class="form-control form-control-sm" id="colFormLabelSm">
                    </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <input type="submit" value="Submit" name="submit" class="btn btn-success float-auto">
        </form>
        </div>
      </div>
    </div>
  </div>