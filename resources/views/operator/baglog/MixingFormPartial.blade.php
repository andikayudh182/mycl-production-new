
  <!-- Modal -->
  <div class="modal fade" id="MixingModal{{$data['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Submit Mixing</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ url('operator/baglog/mixing', ["id"=>$data['id'],]) }}" method="POST">
            @csrf
            <input type="hidden" name="MixingID" value="{{$data['id']}}">
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
  