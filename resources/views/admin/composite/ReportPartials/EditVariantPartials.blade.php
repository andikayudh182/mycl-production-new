<div class="modal fade" id="modalExample" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" id="FormInputData" action="{{url('/admin/composite/composite-variant-submit')}}">
            @csrf
            <input name="id" id="idEdit" type="hidden" value="0">
            <div class="row mb-3 ">
                <label for="Nama" class="col-sm-2 col-form-label col-form-label-sm">Nama :</label>
                <div class="col-sm-5">
                    <input type="text" id="NamaEdit" name="Nama" id="Nama" class="form-control form-control-sm">
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="Keterangan" class="col-sm-2 col-form-label col-form-label-sm">Keterangan :</label>
                <div class="col-sm-5">
                    <input type="text" id="KeteranganEdit" name="Keterangan" id="Keterangan" class="form-control form-control-sm">
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="InkubasiSatu" class="col-sm-2 col-form-label col-form-label-sm">Lama Inkubasi 1 :</label>
                <div class="col-sm-5">
                    <input type="number" id="InkubasiSatuEdit" name="InkubasiSatu" id="InkubasiSatu" class="form-control form-control-sm">
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="InkubasiDua" class="col-sm-2 col-form-label col-form-label-sm">Lama Inkubasi 2  :</label>
                <div class="col-sm-5">
                    <input type="number" id="InkubasiDuaEdit" name="InkubasiDua" id="InkubasiDua" class="form-control form-control-sm">
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="InkubasiTiga" class="col-sm-2 col-form-label col-form-label-sm">Lama Inkubasi 3  :</label>
                <div class="col-sm-5">
                    <input type="number" id="InkubasiTigaEdit" name="InkubasiTiga" id="InkubasiTiga" class="form-control form-control-sm">
                </div>
            </div>
            <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
            <a href="#" class="btn btn-danger" onclick="ResetEdit()">Reset</a> 
        

        </div>
      </form>
      </div>
    </div>
  </div>