<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\baglog\Kartu_Kendali;
use App\Models\baglog\Kontaminasi;
use App\Models\Biobo\PT1;
use App\Models\baglog\Sterilisasi;
use App\Models\Mylea\MyleaBaglog;
use App\Models\Mylea\MyleaProduction;
use App\Models\Mylea\MyleaReminder;
use App\Models\Mylea\MyleaKonta;
use App\Models\Mylea\MyleaHarvest;
use App\Models\Mylea\MyleaBaglogPemakaian;
use App\Models\PostTreatment\QualityControl1;
use App\Models\PostTreatment\QualityDetails;
use App\Models\PostTreatment\QualityDetails2;
use KyslikColumnSortableSortable;
use Illuminate\Http\Request;

class MyleaController extends Controller
{
    public function orderproduksi()
    {
        $Data = Kartu_Kendali::orderBy('KodeProduksi', 'desc')->get();

        foreach($Data as $data){
            $SterilisasiID = explode(", " , $data['SterilisasiID']);
            $data['Sterilisasi'] = array();
            if($SterilisasiID != 0){
                for($i = 0; $i < count($SterilisasiID); $i++){
                    $data['Sterilisasi'] = Sterilisasi::where('baglog_sterilisasi.id', $SterilisasiID[$i])
                    ->leftJoin('baglog_mixing', 'baglog_sterilisasi.MixingID', '=', 'baglog_mixing.id')
                    ->leftJoin('baglog_details_recipes', 'baglog_details_recipes.NoRecipe', '=', 'baglog_mixing.NoRecipe')
                    ->where('baglog_details_recipes.JenisBibit', '=', 'TP')
                    ->select('baglog_details_recipes.JenisBibit')
                    ->get();
                 }
            }
        }

        foreach($Data as $data){
            $data['Kontaminasi'] = 0;
            $data['Terpakai'] = 0;
            $Kontaminasi = Kontaminasi::where('KodeProduksi', $data['KodeProduksi'])->get();
            foreach ($Kontaminasi as $Konta){
                $data['Kontaminasi'] = $data['Kontaminasi'] + $Konta['JumlahKontaminasi'];
            }
            $MyleaBaglog = MyleaBaglogPemakaian::where('KodeBaglog', $data['KodeProduksi'])->get();
            foreach($MyleaBaglog as $Baglog){
                $data['Terpakai'] = $data['Terpakai'] + $Baglog['Jumlah'];
            }

            $data['InStock'] = $data['JumlahBaglog'] - ($data['Kontaminasi'] + $data['Terpakai']);
        }
        return view('admin.mylea.OrderProduksi',[
            'Data'=>$Data,
        ]);
    }

    public function submitorderproduksi(Request $request)
    {
        $request->validate([
            'TanggalProduksi'=> 'Required',
            'JenisBaglog'=>'Required',
            'Lokasi' =>'Required',
        ]);
        $TanggalProduksi = $request['TanggalProduksi'];
        $JenisBaglog = $request['JenisBaglog'];
       
        $Lokasi = $request['Lokasi'];
        $Jumlah = '0';
        $TB = date("y-m-d", strtotime($TanggalProduksi));
        // if($JenisBaglog == "Tempe") {
        //     $KodeProduksi =  "MYTP".$TB;
        // } elseif ($JenisBaglog == "AsaAgro"){
        //     $KodeProduksi =  "MYAG".$TB;
        // } elseif ($JenisBaglog == "GN") {
        //     $KodeProduksi =  "MYGN";
        // }

        $KodeProduksi = 'MY'.$TB;

        $Elus1 = date('Y-m-d', strtotime($TanggalProduksi. ' + 6 days')); 
        $Elus2 = date('Y-m-d', strtotime($Elus1. ' + 6 days')); 
        $Elus3 = date('Y-m-d', strtotime($Elus2. ' + 7 days')); 
        $Panen = date('Y-m-d', strtotime($Elus3. ' + 7 days'));
        $PanenBiobo = date('Y-m-d', strtotime($Panen. ' + 7 days'));

        foreach($request->data as $key => $value){
            MyleaBaglog::create([
                'KodeMylea'=>$KodeProduksi,
                'KodeBaglog'=>$value['KodeBaglog'],
                'Jumlah'=>$value['Jumlah'],
            ]);
            $Jumlah = $Jumlah + $value['Jumlah'];
        }

        MyleaProduction::create([
            'KodeProduksi'=>$KodeProduksi,
            'TanggalProduksi'=>$TanggalProduksi,
            'JenisBaglog'=>$JenisBaglog,
            'JumlahBaglog'=>$Jumlah,
            'Lokasi'=>$Lokasi,
            'Status'=>0,
            'StatusHarvest'=>0,
        ]);

        MyleaReminder::create([
            'KodeProduksi'=>$KodeProduksi,
            'Elus1'=>$Elus1,
            'Elus2'=>$Elus2,
            'Elus3'=>$Elus3,
            'TanggalPanen'=>$Panen,
            'PanenBiobo'=>$PanenBiobo,
        ]);
        
        $Data = Kartu_Kendali::orderBy('KodeProduksi', 'desc')->get();
        return view('admin.mylea.OrderProduksi',[
            'Data'=>$Data,
        ]);
    }

    public function report(Request $request){
        $MyleaProduction = MyleaProduction::sortable()->orderBy('TanggalProduksi', 'asc')->paginate(15);
        $MyleaProductionAll = MyleaProduction::orderBy('TanggalProduksi', 'asc')->get();
        $InStock = $MyleaProductionAll->sum('JumlahBaglog');;

        //filter and search
        if(isset($request->Submit)){
            $search = $request->SearchQuery;
            $MyleaProduction = MyleaProduction::sortable()
            ->where('KodeProduksi','like',"%".$search."%")
            ->paginate(150);
            $InStock = $MyleaProduction->sum('JumlahBaglog');
        }
        if(isset($request->Filter)){
            $Date1 = date('Y-m-d', strtotime($request['TanggalAwal']));
            $Date2 = date('Y-m-d', strtotime($request['TanggalAkhir']));
            $MyleaProduction = MyleaProduction::sortable()
            ->whereBetween('TanggalProduksi', [$Date1, $Date2])
            ->paginate(150);
            $InStock = $MyleaProduction->sum('JumlahBaglog');
            $resume['TanggalAwal'] = $Date1;
            $resume['TanggalAkhir'] = $Date2;
        }

        foreach($MyleaProduction as $data){
            $data['Reminder'] = MyleaReminder::where('KodeProduksi', $data['KodeProduksi'])->get();
            $data['Baglog'] = MyleaBaglog::where('KodeMylea', $data['KodeProduksi'])->get();
            $data['MyleaOperator'] = MyleaBaglogPemakaian::where('KodeMylea', $data['KodeProduksi'])->get();
            $data['Kontaminasi'] = MyleaKonta::where('KodeProduksi', $data['KodeProduksi'])->get();
            $data['JumlahKontaminasi'] = $data['Kontaminasi']->sum('Jumlah');

            $data['Harvest'] = MyleaHarvest::where('KodeProduksi', $data['KodeProduksi'])->get();
            $data['HarvestBiobo'];
            $data['Passed'] = $data['Harvest']->sum('Passed');
            $data['Reject'] = $data['Harvest']->sum('Reject');

            $data['PostTreatment'] = QualityControl1::where('KPMylea', $data['KodeProduksi'])->get();
            $i = 0;
            foreach($data['PostTreatment'] as $PT){
                $data['PostTreatment'][$i]['DataAwal'] = QualityDetails::where('KodeProduksi', $PT['KodeProduksi'])->get();
                $data['PostTreatment'][$i]['DataAkhir'] = QualityDetails2::where('KodeProduksi', $PT['KodeProduksi'])->get();
                $i++;
            }
            
        }


        
        if(isset($request->Submit) || isset($request->Filter)){
            $MyleaProductionAll = $MyleaProduction;
        }
        foreach($MyleaProductionAll as $item){
            $item['Kontaminasi'] = MyleaKonta::where('KodeProduksi', $item['KodeProduksi'])->get();
            $item['Harvest'] = MyleaHarvest::where('KodeProduksi', $item['KodeProduksi'])->get();
            $TotalKontaminasi = $item['Kontaminasi']->sum('Jumlah');
            $Reject = $item['Harvest']->sum('Reject');
            $Passed = $item['Harvest']->sum('Passed');
            $InStock -= ($TotalKontaminasi + $Reject + $Passed);
        }

        return view('admin.mylea.Report', [
            'MyleaProduction' => $MyleaProduction,
            'TotalInStock'=> $InStock,
        ]);
    }

    public function exportdata(Request $request){
        $Report = null;
        $Total['Produksi'] = 0;
        $Total['Kontaminasi'] = 0;
        $Total['SuccessRate'] = 0;

        if ($request['Submit'] == '1') {
            $Date1 = date('Y-m-d', strtotime($request['TanggalAwal']));
            $Date2 = date('Y-m-d', strtotime($request['TanggalAkhir']));

            $Report = MyleaProduction::whereBetween('TanggalProduksi', [$Date1, $Date2])
                ->orderBy('TanggalProduksi', 'asc')->get();

            foreach($Report as $data){
                $data['Baglog'] = MyleaBaglog::where('KodeMylea', $data['KodeProduksi'])->get();
                
                $data['BaglogDetails'] = '';
                foreach($data['Baglog'] as $Baglog){
                    $data['BaglogDetails'] = $data['BaglogDetail'].$Baglog['KodeBaglog'].",";
                }
                $data['Kontaminasi'] = MyleaKonta::where('KodeProduksi', $data['KodeProduksi'])->get();
                $data['JumlahKontaminasi'] = 0;
                foreach($data['Kontaminasi'] as $Konta){
                    $data['JumlahKontaminasi'] = $data['JumlahKontaminasi'] + $Konta['Jumlah'];
                }
                $data['Harvest'] = MyleaHarvest::where('KodeProduksi', $data['KodeProduksi'])->get();
                $data['Passed'] = 0;
                $data['Reject'] = 0;
                foreach($data['Harvest']as $Harvest){
                    $data['Passed'] += $Harvest['Passed'];
                    $data['Reject'] += $Harvest['Reject'];
                }   
                $data['InStock'] = $data['JumlahBaglog'] - $data['JumlahKontaminasi'];
                $data['ContaminationRate'] = $data['JumlahKontaminasi']/$data['JumlahBaglog']*100;
                $data['ContaminationRate'] = number_format($data['ContaminationRate'], 2);

                $Total['Produksi'] = $Total['Produksi'] + $data['JumlahBaglog'];
                $Total['Kontaminasi'] = $Total['Kontaminasi'] + $data['JumlahKontaminasi'];
                $Total['SuccessRate'] = number_format(($Total['Produksi']-$Total['Kontaminasi'])/$Total['Produksi']*100, 2);
            }

        }

        return view('admin.mylea.ExportData', [
            'data' => $Report,
            'Resume'=>$Total,
            compact('Report'),
            ]);
    }

    public function reportedit($KodeProduksi){
        $MyleaProduction = MyleaProduction::where('KodeProduksi', '=', $KodeProduksi)->get();
        return view('admin.mylea.ReportEdit', [
            'KodeProduksi' => $KodeProduksi,
            'MyleaProduction'=>$MyleaProduction,
        ]);
    }

    public function reportsubmit(Request $request){
        $OldProductionCode = $request['KodeProduksi'];
        $NewProductionCode = substr($OldProductionCode, 0, 4). substr($request['TanggalProduksi'], 2, 9);
        MyleaBaglog::where('KodeMylea', $OldProductionCode)->update([
            'KodeMylea'=>$NewProductionCode,
        ]);
        MyleaBaglogPemakaian::where('KodeMylea', $OldProductionCode)->update([
            'KodeMylea'=>$NewProductionCode,
        ]);
        MyleaKonta::where('KodeProduksi', $OldProductionCode)->update([
            'KodeProduksi'=>$NewProductionCode,
        ]);
        MyleaHarvest::where('KodeProduksi', $OldProductionCode)->update([
            'KodeProduksi'=>$NewProductionCode,
        ]);
        MyleaReminder::where('KodeProduksi', $OldProductionCode)->update([
            'KodeProduksi'=>$NewProductionCode,
        ]);
        QualityControl1::where('KPMylea', $OldProductionCode)->update([
            'KPMylea'=>$NewProductionCode,
        ]);
        MyleaProduction::where(['KodeProduksi'=>$request['KodeProduksi']])
        ->update([
            'KodeProduksi'=>$NewProductionCode,
            'TanggalProduksi'=>$request['TanggalProduksi'],
            'JenisBaglog'=>$request['JenisBaglog'],
            'JumlahBaglog'=>$request['JumlahBaglog'],
            'Lokasi'=>$request['Lokasi'],
        ]);
        return redirect(url('/admin/mylea/report'))->with('message', 'Data Mylea'.$NewProductionCode.' updated!');
    }

    public function kontaminasi($KodeProduksi){
        $MyleaKonta = MyleaKonta::where('KodeProduksi', '=', $KodeProduksi)->get();
        return view('admin.mylea.Kontaminasi', [
            'MyleaKonta'=>$MyleaKonta,
        ]);
    }

    public function formkontaminasi($KodeProduksi){
        return view('admin.mylea.FormKontaminasi', [
            'KodeProduksi'=>$KodeProduksi,
        ]);
    }

    public function formkontaminasisubmit(Request $request){
        MyleaKonta::create([
            'KodeProduksi'=>$request['KodeProduksi'],
            'TanggalKonta'=>$request['TanggalKonta'],
            'Jumlah'=>$request['Jumlah'],
            'Keterangan'=>$request['Keterangan'],
        ]);
        return redirect(url('/admin/mylea/report'));
    }

    public function kontaminasiedit($id){
        $MyleaKonta = MyleaKonta::where('id', '=', $id)->get();
        return view('admin.mylea.KontaminasiEdit', [
            'MyleaKonta'=>$MyleaKonta,
            'id'=>$id,
        ]);
    }

    public function kontaminasisubmit(Request $request, $id){
        MyleaKonta::where(['id'=>$id])
        ->update([
            'Jumlah'=>$request['Jumlah'],
            'TanggalKonta'=>$request['TanggalKonta'],
            'Keterangan'=>$request['Keterangan'],
        ]);

        $MyleaProduction = MyleaProduction::orderBy('TanggalProduksi', 'asc')->get();
        $MyleaReminder = MyleaReminder::all()->groupBy('KodeProduksi');
        $MyleaKonta = MyleaKonta::all()->groupBy('KodeProduksi');
        $MyleaHarvest = MyleaHarvest::all()->groupBy('KodeProduksi');
        return view('admin.mylea.Report', [
            'MyleaProduction' => $MyleaProduction,
            'MyleaReminder' => $MyleaReminder,
            'MyleaKonta' => $MyleaKonta,
            'MyleaHarvest' => $MyleaHarvest,
        ]);
    }

    public function deletekontaminasi($id){
        MyleaKonta::where(['id'=>$id])
        ->delete();

        $MyleaProduction = MyleaProduction::orderBy('TanggalProduksi', 'asc')->paginate(15);
        $MyleaReminder = MyleaReminder::all()->groupBy('KodeProduksi');
        $MyleaKonta = MyleaKonta::all()->groupBy('KodeProduksi');
        $MyleaHarvest = MyleaHarvest::all()->groupBy('KodeProduksi');
        return view('admin.mylea.Report', [
            'MyleaProduction' => $MyleaProduction,
            'MyleaReminder' => $MyleaReminder,
            'MyleaKonta' => $MyleaKonta,
            'MyleaHarvest' => $MyleaHarvest,
        ]);
    }

    public function harvest($KodeProduksi){
        $MyleaHarvest = MyleaHarvest::where('KodeProduksi', '=', $KodeProduksi)->get();
        return view('admin.mylea.Harvest', [
            'MyleaHarvest'=>$MyleaHarvest,
        ]);
    }

    public function deleteharvest($id, $KodeProduksi){
        MyleaHarvest::where('id', $id)->delete();

        MyleaProduction::where(['KodeProduksi'=>$KodeProduksi])
        ->update(['StatusHarvest'=>'0',]);

        $MyleaHarvest = MyleaHarvest::where('KodeProduksi', '=', $KodeProduksi)->get();
        return redirect(url('/admin/mylea/report'))->with('message', 'Data Harvest'.$KodeProduksi.' Deleted!');
    }

    public function databaglogdelete($id){
        MyleaBaglog::where('id', $id)->delete();

        return redirect(url('/admin/mylea/report'))->with('message', 'Data Baglog Deleted!');
    }

    public function DataBaglogDeleteOperator($id){
        MyleaBaglogPemakaian::where('id', $id)->delete();

        return redirect(url('/admin/mylea/report'))->with('message', 'Data Baglog Deleted!');
    }

    public function databaglogadd($KodeProduksi){
        $Data = Kartu_Kendali::orderBy('KodeProduksi', 'desc')->get();
        foreach($Data as $data){
            $data['Kontaminasi'] = 0;
            $data['Terpakai'] = 0;
            $Kontaminasi = Kontaminasi::where('KodeProduksi', $data['KodeProduksi'])->get();
            foreach ($Kontaminasi as $Konta){
                $data['Kontaminasi'] = $data['Kontaminasi'] + $Konta['JumlahKontaminasi'];
            }
            $MyleaBaglog = MyleaBaglog::where('KodeBaglog', $data['KodeProduksi'])->get();
            foreach($MyleaBaglog as $Baglog){
                $data['Terpakai'] = $data['Terpakai'] + $Baglog['Jumlah'];
            }

            $data['InStock'] = $data['JumlahBaglog'] - ($data['Kontaminasi'] + $data['Terpakai']);
        }

        return view('admin.mylea.FormAddBaglogMylea', [
            'Data' => $Data,
            'KodeProduksi' => $KodeProduksi,
        ]);
    }
    public function databaglogaddsubmit(Request $Request, $KodeProduksi){
        if($Request['JenisInput'] == 'Admin'){
            foreach($Request->data as $key => $value){
                MyleaBaglog::create([
                    'KodeMylea'=>$KodeProduksi,
                    'KodeBaglog'=>$value['KodeBaglog'],
                    'Jumlah'=>$value['Jumlah'],
                ]);
            }
        } else {
            foreach($Request->data as $key => $value){
                MyleaBaglogPemakaian::create([
                    'KodeMylea'=>$KodeProduksi,
                    'KodeBaglog'=>$value['KodeBaglog'],
                    'Jumlah'=>$value['Jumlah'],
                ]);
            }
        }


        return redirect(url('/admin/mylea/report'))->with('message', 'Data Baglog Added');
    }
}
