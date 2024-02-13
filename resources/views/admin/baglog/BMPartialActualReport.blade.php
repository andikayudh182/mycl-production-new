<div class="container m-2">
    <div class="row">
        <div class="col-md-10" style="float: left; display:inline-block;">
            <h3>Actual Baglog Making Report</h3>
        </div>
        <div class="col-md-4" style="float: right;">
            <button class="btn btn-primary" onclick="ExportToExcelActual('xlsx')">Export</button>
        </div>
    </div>
    <div class="row">
        <div class="table-responsive" id="Export">
            <div id="actual">
                <div class="WordSection1">
                <table class="table table-bordered" id="tbl_exporttable_to_xls_actual">
                    <tr>
                        <th colspan="15" style="text-align: center">Actual</th>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Weight per Bag</th>
                        <th>Total Bags</th>
                        <th>No Kontainer S. Kayu</th>
                        <th>MC</th>
                        <th>No Recipe</th>
                        <th>Tanggal Keluar Resep</th>
                        <th>Kali Resep Terpakai</th>
                        <th>Jumlah Produksi Baglog</th>
                        <th>Tanggal Mixing</th>
                        <th>CaCO3(kg)</th>
                        <th>Sawdust(kg)</th>
                        <th>Pollard(kg)</th>
                        <th>Tapioka(kg)</th>
                        <th>Water(kg)</th>
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
                        <td>{{$Data['KaliTerpakai']}}</td>
                        <td>{{$Data['TotalBags']*$Data['KaliTerpakai']}}</td>
                        <td>{{$Data['TanggalMixing']}}</td>
                        <td>{{$Data['Bahan']['CaCO3']*$Data['KaliTerpakai']}}</td>
                        <td>{{$Data['Bahan']['SKayu']*$Data['KaliTerpakai']}}</td>
                        <td>{{$Data['Bahan']['Pollard']*$Data['KaliTerpakai']}}</td>
                        <td>{{$Data['Bahan']['Tapioka']*$Data['KaliTerpakai']}}</td>
                        <td>{{$Data['Bahan']['Air']*$Data['KaliTerpakai']}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="7"><b>Total Pemakaian</b></td>
                        <td>{{$Resume['KaliTerpakai']}}</td>
                        <td>{{$Resume['TotalBaglog']}}</td>
                        <td></td>
                        <td>{{$Resume['CaCO3']}}</td>
                        <td>{{$Resume['SKayu']}}</td>
                        <td>{{$Resume['Pollard']}}</td>
                        <td>{{$Resume['Tapioka']}}</td>
                        <td>{{$Resume['Air']}}</td>
                    </tr>
                    @endif
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
