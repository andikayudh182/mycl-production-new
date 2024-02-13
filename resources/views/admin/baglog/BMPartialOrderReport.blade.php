<div class="container m-2">
    <div class="row">
        <div class="col-md-10" style="float: left; display:inline-block;">
            <h3> Order Baglog Making Report</h3>
        </div>
        <div class="col-md-2 " style="float: right;">
            <button class="btn btn-primary" onclick="ExportToExcelOrder('xlsx')">Export</button>
        </div>
    </div>
    <div class="row">
        <div class="table-responsive" id="order">
            <table class="table table-bordered" id="tbl_exporttable_to_xls_order">
                <tr>
                    <th colspan="14" style="text-align: center">Order</th>
                </tr>
                <tr>
                    <th>No</th>
                    <th>Weight per Bag</th>
                    <th>Total Bags</th>
                    <th>No Kontainer S. Kayu</th>
                    <th>MC</th>
                    <th>No Recipe</th>
                    <th>Tanggal Keluar Resep</th>
                    <th>CaCO3(kg)</th>
                    <th>Sawdust(kg)</th>
                    <th>Pollard(kg)</th>
                    <th>Tapioka(kg)</th>
                    <th>Water(kg)</th>
                    <th>Kali Resep Terpakai</th>
                    <th>Jumlah Produksi Baglog</th>
                </tr>
                @if(isset($data))
                <?php
                    $i = 0;
                ?>
                @foreach($data as $Data)
                <tr>
                    <td>{{$i = $i+1}}</td>
                    <td>{{$Data['WeightperBag']}}</td>
                    <td>{{$Data['TotalBags']}}</td>
                    <td>{{$Data['Bahan']['NoKontSKayu']}}</td>
                    <td>{{$Data['Bahan']['MCSKayu']}}</td>
                    <td>{{$Data['NoRecipe']}}</td>
                    <td>{{$Data['TanggalKeluar']}}</td>
                    <td>{{$Data['Bahan']['CaCO3']}}</td>
                    <td>{{$Data['Bahan']['SKayu']}}</td>
                    <td>{{$Data['Bahan']['Pollard']}}</td>
                    <td>{{$Data['Bahan']['Tapioka']}}</td>
                    <td>{{$Data['Bahan']['Air']}}</td>
                    <td>{{$Data['KaliTerpakai']}}</td>
                    <td>{{$Data['TotalBags']*$Data['KaliTerpakai']}}</td>
                </tr>
                @endforeach
                @endif
            </table>
        </div>
    </div>
</div>
