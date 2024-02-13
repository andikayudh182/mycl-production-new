<div class="modal fade" id="DataHarvest{{$data['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data {{$data['KodeProduksi']}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table class="table">
                <tr>
                    <th>Kode Produksi</th>
                    <th>Jenis Panen</th>
                    <th>Passed</th>
                    <th>Reject</th>
                </tr>
                @foreach ($data['Harvest'] as $data)
                <tr>
                    <td><?php echo $data['KodeProduksi']?></td>
                    <td><?php echo $data['JenisPanen']?></td>
                    <td><?php echo $data['Passed']?></td>
                    <td><?php echo $data['Reject']?></td>
                    <td><a href="{{url('/admin/composite/report/harvest-delete', ['id'=>$data['id'], 'KodeProduksi'=>$data['KodeProduksi'],])}}">Delete</a></td>
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