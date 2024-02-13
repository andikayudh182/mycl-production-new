<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\baglog\Sterilisasi;
use App\Models\baglog\Kartu_Kendali;
use App\Models\baglog\Kontaminasi;
use App\Models\Mylea\MyleaBaglog;
use App\Models\Mylea\MyleaBaglogPemakaian;
use App\Models\Mylea\MyleaProduction;
use App\Models\Mylea\MyleaReminder;
use App\Models\Mylea\MyleaKonta;
use App\Models\Mylea\MyleaHarvest;
use App\Models\Biobo\PT1;
use App\Models\Biobo\PT2;
use App\Models\Biobo\Harvest;
use App\Models\PostTreatment\QualityControl1;
use Carbon\Carbon;

class MyleaController extends Controller
{
    public function mylea(){
        $date = Carbon::now();
        $date->toDateString();
        $MyleaProduction = MyleaProduction::orderBy('TanggalProduksi', 'asc')->whereMonth('TanggalProduksi', $date)->get();
        $MyleaKonta = MyleaKonta::orderBy('TanggalKonta', 'desc')->get();
        $MyleaReminder = MyleaReminder::all();
        $QualityControl1 = QualityControl1::where('Status', '=' , Null)->get();

        foreach($MyleaProduction as $datamylea){
            $datamylea['Kontaminasi'] = 0;
            $datamylea['TanggalQC'] = date('Y-m-d', strtotime($datamylea['TanggalProduksi']. ' + 7 days'));
            $datamylea['TanggalQC2'] = date('Y-m-d', strtotime($datamylea['TanggalProduksi']. ' + 14 days'));
            $kontaminasiMylea = MyleaKonta::where('KodeProduksi', $datamylea['KodeProduksi'])->get();
            if(isset($kontaminasiMylea)){
                foreach($kontaminasiMylea as $KontaMylea){
                    $datamylea['Kontaminasi'] = $datamylea['Kontaminasi'] + $KontaMylea['Jumlah'];
                }
            }

            $datamylea['InStock'] = $datamylea['JumlahBaglog'] - $datamylea['Kontaminasi'];
        }

        foreach($MyleaReminder as $datareminder){
            $datareminder['TanggalQC'] = date('Y-m-d', strtotime($datareminder['Elus1']. ' + 1 day'));
            $datareminder['TanggalQC2'] = date('Y-m-d', strtotime($datareminder['Elus2']. ' + 1 day'));
        }
        return view('operator.mylea.Index', [
            'MyleaProduction'=>$MyleaProduction,
            'MyleaKonta'=>$MyleaKonta,
            'MyleaReminder'=>$MyleaReminder,
            'QualityControl1'=>$QualityControl1,
        ]);
    }

    public function orderproduksi(){
        $MyleaProduction = MyleaProduction::all()->where('Status', '=', '0');
        $BaglogMylea = MyleaBaglog::all()->groupBy('KodeMylea');
        return view('operator.mylea.OrderProduksi', [
            'MyleaProduction' => $MyleaProduction,
            'Baglog' => $BaglogMylea,
        ]);
    }

    public function orderproduksiform($KodeProduksi){
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
        return view('operator.mylea.FormProduksi', [
            'Data' => $Data,
            'KodeProduksi' => $KodeProduksi,
        ]);
    }

    public function orderproduksiformsubmit(Request $Request, $KodeProduksi){
        MyleaProduction::where(['KodeProduksi'=>$KodeProduksi])
        ->update([
            'Status'=>'1',
            'Keterangan'=>$Request['Keterangan'],
        ]);

        foreach($Request->data as $key => $value){
            MyleaBaglogPemakaian::create([
                'KodeMylea'=>$KodeProduksi,
                'KodeBaglog'=>$value['KodeBaglog'],
                'Jumlah'=>$value['Jumlah'],
            ]);
        }

        return redirect(url('operator/mylea/production-report'));
    }

    public function productionreport(){
        $MyleaProduction = MyleaProduction::all()->where('StatusBiobo', '=', '0')->where('Status', '=', '1');
        $MyleaReminder = MyleaReminder::all()->groupBy('KodeProduksi');
        $MyleaKonta = MyleaKonta::all()->groupBy('KodeProduksi');
        return view('operator.mylea.ProductionReport', [
            'MyleaProduction' => $MyleaProduction,
            'MyleaReminder' => $MyleaReminder,
            'MyleaKonta' => $MyleaKonta,
        ]);
    }

    public function kontaminasi($KodeProduksi){
        return view('operator.mylea.Kontaminasi', [
            'KodeProduksi' => $KodeProduksi,
        ]);
    }

    public function datakontaminasi($KodeProduksi){
        $MyleaKonta = MyleaKonta::where('KodeProduksi', '=', $KodeProduksi)->get();
        return view('operator.mylea.DataKonta', [
            'MyleaKonta' => $MyleaKonta,
        ]);
    }

    public function deletekontaminasi($id){
        MyleaKonta::where(['id'=>$id])
        ->delete();
        return redirect(url('/operator/mylea/production-report'));
    }

    public function submitkontaminasi(Request $request){
        MyleaKonta::create([
            'KodeProduksi'=>$request['KodeProduksi'],
            'TanggalKonta'=>$request['TanggalKonta'],
            'Jumlah'=>$request['Jumlah'],
            'Keterangan'=>$request['Keterangan'],
        ]);

        $MyleaProduction = MyleaProduction::all()->where('Status', '=', '1', 'StatusHarvest', '=', '0');
        $MyleaReminder = MyleaReminder::all()->groupBy('KodeProduksi');
        $MyleaKonta = MyleaKonta::all()->groupBy('KodeProduksi');
        return view('operator.mylea.ProductionReport', [
            'MyleaProduction' => $MyleaProduction,
            'MyleaReminder' => $MyleaReminder,
            'MyleaKonta' => $MyleaKonta,
        ]);
    }

    public function harvest($KodeProduksi){
        return view('operator.mylea.Harvest', [
            'KodeProduksi' => $KodeProduksi,
        ]);
    }

    public function submitharvest(Request $request){
        MyleaHarvest::create([
            'KodeProduksi'=>$request['KodeProduksi'],
            'JenisPanen'=>$request['JenisPanen'],
            'Passed'=>$request['Passed'],
            'Reject'=>$request['Reject'],
            'Keterangan'=>$request['Keterangan'],
        ]);

        MyleaProduction::where(['KodeProduksi'=>$request['KodeProduksi']])
        ->update(['StatusHarvest'=>'1',]);

        return redirect(url('operator/mylea/production-report'));
    }

    public function formharvestbiobo($KodeProduksi){
        $Produksi = MyleaProduction::where('id',$KodeProduksi)->get();
        return view('operator.mylea.FormHarvestBiobo', [
            'Data'=>$Produksi,
        ]);
    }

    public function submitharvestbiobo(Request $request){
        $TanggalPanen = $request['TanggalPanen'];
        foreach($request->data as $key => $value){
            Harvest::create([
                'TanggalPanen'=>$TanggalPanen,
                'Quality'=>$value['Quality'],
                'Ukuran'=>$value['Ukuran'],
                'TanggalProduksi'=>$request['KodeProduksi'],
                'Jumlah'=>$value['Jumlah'],          
            ]);
        }
        MyleaProduction::where(['KodeProduksi'=>$request['KodeProduksi']])
        ->update(['StatusBiobo'=>'1',]);
        return redirect(url('operator/mylea/production-report'))->with('message', 'Data panen biobo mylea '.$request['KodeProduksi'].' berhasil ditambahkan!');
    }
    
}
