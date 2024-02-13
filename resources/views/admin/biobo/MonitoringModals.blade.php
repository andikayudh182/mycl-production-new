<!--Modal PT 1-->
<div class="modal fade" id="{{"PT1".$data['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{$data['NoBatch']}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table class="table">
                <tr>
                    <td>Proses</td>
                    <th>Tanggal</th>
                    <th>10x15</th>
                    <th>10x20</th>
                    <th>30x30</th>
                </tr>
                <tr>
                    <td>Drying</td>
                    <td><?php echo $data['TanggalDrying']?></td>
                    <td><?php echo $data['PDrying10x15']?></td>
                    <td><?php echo $data['PDrying10x20']?></td>
                    <td><?php echo $data['PDrying30x30']?></td>
                </tr>
                <tr>
                    <td>Pressing</td>
                    <td><?php echo $data['TanggalPressing']?></td>
                    <td><?php echo $data['PPressing10x15']?></td>
                    <td><?php echo $data['PPressing10x20']?></td>
                    <td><?php echo $data['PPressing30x30']?></td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
            <a class='btn btn-danger' href="{{url('/admin/biobo/pt1-delete', ['id' => $data['id'],])}}">Delete</a>
            <a class='btn btn-primary' href="{{url('/admin/biobo/pt1-form', ['id' => $data['id'],])}}">Edit</a>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
<!--Modal PT 2-->
<div class="modal fade" id="{{"PT2".$data['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{$data['NoBatch']}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table class="table">
                <tr>
                    <td>Proses</td>
                    <th>Tanggal</th>
                    <th>10x15</th>
                    <th>10x20</th>
                    <th>30x30</th>
                </tr>
                <tr>
                    <td>Sanding</td>
                    <td><?php echo $data['TanggalSanding']?></td>
                    <td><?php echo $data['PSanding10x15']?></td>
                    <td><?php echo $data['PSanding10x20']?></td>
                    <td><?php echo $data['PSanding30x30']?></td>
                </tr>
                <tr>
                    <td>Cutting</td>
                    <td><?php echo $data['TanggalCutting']?></td>
                    <td><?php echo $data['PCutting10x15']?></td>
                    <td><?php echo $data['PCutting10x20']?></td>
                    <td><?php echo $data['PCutting30x30']?></td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
            @if(isset($data['ID_PT2']))
            <a class='btn btn-danger' href="{{url('/admin/biobo/pt2-delete', ['id' => $data['id'],])}}">Delete</a>
            <a class='btn btn-primary' href="{{url('/admin/biobo/pt2-form', ['id' => $data['ID_PT2'],])}}">Edit</a>
            @endif
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>