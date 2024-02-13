<div class="modal fade" id="UjiCobaModal{{$data1['idBaglog']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data {{$data1['KodeProduksi']}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $data1['idBaglog'] }}
                {{ $data1['id'] }}
                <form method="POST" action="{{ url('admin/baglog/uji-coba')}}">
                    @csrf
                        <div class="row mb-3 ">
                            <div class="col-sm-5">
                                <input type="hidden" name="BaglogID" value="{{$data1['idBaglog']}}" class="Disabled input example form-control-sm">
                            </div>
                        </div>
                        <div class="row mb-3 ">
                            <label for="Jumlah" class="col-sm-2 col-form-label col-form-label-sm">Jumlah :</label>
                            <div class="col-sm-5">
                                <input type="number" name="Jumlah" value="" class="form-control form-control-sm" id="colFormLabelSm">
                            </div>
                        </div>
                        <div class="row mb-3 ">
                            <label for="Tanggal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal :</label>
                            <div class="col-sm-5">
                                <input type="date" name="Tanggal" value="" class="form-control form-control-sm" id="colFormLabelSm">
                            </div>
                        </div>
                        <div class="row mb-3 ">
                            <label for="Keterangan" class="col-sm-2 col-form-label col-form-label-sm">Keterangan :</label>
                            <div class="col-sm-5">
                                <input type="text" name="Keterangan" value="" class="form-control form-control-sm" id="colFormLabelSm">
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