<div class="modal fade" id="DataBaglog{{$data['production_id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data {{$data['KodeProduksi']}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h3>Input Admin</h3>
          <table class="table">
            <tr>
              <th>Kode Baglog</th>
              <th>Jumlah</th>
            </tr>
            @foreach($data['Baglog'] as $Baglog)
            <tr>
              <td>{{$Baglog['KodeBaglog']}}</td>
              <td>{{$Baglog['Jumlah']}}</td>
            </tr>
          @endforeach
          </table>
          <h3>Input Operator</h3>
          <table class="table">
            <tr>
              <th>Kode Baglog</th>
              <th>Jumlah</th>
            </tr>
            @foreach($data['CompositeOperator'] as $Baglog)
            <tr>
              <td>{{$Baglog['KodeBaglog']}}</td>
              <td>{{$Baglog['Jumlah']}}</td>
            </tr>
          @endforeach
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> 
      </div>
    </div>
  </div>