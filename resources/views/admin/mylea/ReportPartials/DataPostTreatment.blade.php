<div class="modal fade" id="DataPT{{$data['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data {{$data['KodeProduksi']}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table">
            <tr>
              <th>Kode Post Treatment</th>
              <th>Jenis Panen</th>
              <th>Grade A</th>
              <th>Grade E</th>
            </tr>
            @foreach($data['PostTreatment'] as $PT)
            <tr>
              <td>{{$PT['KodeProduksi']}}</td>
              <td>{{$PT['JenisMylea']}}</td>
              <td>{{$PT['GradeA']}}</td>
              <td>{{$PT['GradeE']}}</td>
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