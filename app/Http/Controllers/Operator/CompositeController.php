<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Composite\CompositeProduction;
use App\Models\Composite\CompositeBaglog;
use App\Models\baglog\Kartu_Kendali;
use App\Models\baglog\UjiCoba;
use App\Models\baglog\Kontaminasi;
use App\Models\baglog\Sterilisasi;
use App\Models\Composite\CompositeBaglogPemakaian;
use App\Models\Composite\CompositeHarvest;
use App\Models\Composite\CompositeKontaminasi;
use App\Models\Composite\CompositeReminder;
use Illuminate\Http\Request;




use Carbon\Carbon;

class CompositeController extends Controller

{
    public function index(){    

        
        $CompositeProductionAll = CompositeProduction::leftJoin('composite_variant', 'composite_production.JenisComposite', '=', 'composite_variant.id')
        ->orderBy('composite_production.TanggalProduksi', 'asc')
        ->get();

        foreach($CompositeProductionAll as $data) {
            $data['Reminder'] = CompositeReminder::where('KodeProduksi', $data['KodeProduksi'])->get();
            $data['Kontaminasi'] = CompositeKontaminasi::where('KodeProduksi', $data['KodeProduksi'])->get();
            $data['JumlahKontaminasi'] = $data['Kontaminasi']->sum('Jumlah');
        }

        // order produksi composite
        $OrderComposite = CompositeProduction::where('Status', '=', '0')
        ->leftJoin('composite_variant', 'composite_production.JenisComposite', '=', 'composite_variant.id')
        ->get();
        $BaglogComposite = CompositeBaglog::all()->groupBy('KodeComposite');
      
        return view('operator.composite.Index', [
            'Composite' => $CompositeProductionAll,
            'OrderComposite'=>$OrderComposite,
            'BaglogComposite'=>$BaglogComposite,
        ]);
    }

    public function orderproduksi(){
        $CompositeProduction = CompositeProduction::where('Status', '=', '0')
            ->leftJoin('composite_variant', 'composite_production.JenisComposite', '=', 'composite_variant.id')
            ->get();
        $BaglogComposite = CompositeBaglog::all()->groupBy('KodeComposite');
        return view('operator.composite.OrderProduksi', [
            'CompositeProduction' => $CompositeProduction,
            'Baglog' => $BaglogComposite,
        ]);
    }

    public function orderproduksiform($KodeProduksi){

        $JumlahComposite = CompositeProduction::where('KodeProduksi', $KodeProduksi)->value('JumlahComposite');
        $Data = Kartu_Kendali::orderBy('TanggalPembibitan', 'desc')
        ->select('KodeProduksi', 'SterilisasiID', 'JumlahBaglog')
        ->get();

        foreach($Data as $data){
            $SterilisasiID = explode(", " , $data['SterilisasiID']);
            $data['Sterilisasi'] = array();
            if($SterilisasiID != 0){
                for($i = 0; $i < count($SterilisasiID); $i++){
                    $data['Sterilisasi'] = Sterilisasi::where('baglog_sterilisasi.id', $SterilisasiID[$i])
                    ->leftJoin('baglog_mixing', 'baglog_sterilisasi.MixingID', '=', 'baglog_mixing.id')
                    ->leftJoin('baglog_details_recipes', 'baglog_details_recipes.NoRecipe', '=', 'baglog_mixing.NoRecipe')
                    ->select('baglog_details_recipes.JenisBibit')
                    ->get();
                 }
            }
        }
        foreach($Data as $data){
            $data['Kontaminasi'] = 0;
            $data['Terpakai'] = 0;
            $Kontaminasi = Kontaminasi::where('KodeProduksi', $data['KodeProduksi'])->get();
            $data['Kontaminasi'] = $Kontaminasi->sum('JumlahKontaminasi');
            $CompositeBaglog = CompositeBaglogPemakaian::where('KodeBaglog', $data['KodeProduksi'])->get();
            $data['Terpakai'] = $CompositeBaglog->sum('Jumlah');
            $data['UjiCoba'] = UjiCoba::where('BaglogID', $data['id'])->get();
            $data['UjiCoba'] = $data['UjiCoba']->sum('Jumlah');
    
            $data['InStock'] = $data['JumlahBaglog'] - ($data['Kontaminasi'] + $data['Terpakai'] + $data['UjiCoba']);
        }
        return view('operator.composite.FormProduksi', [
            'JumlahComposite' => $JumlahComposite,
            'Data' => $Data,
            'KodeProduksi' => $KodeProduksi,
        ]);
    }

    public function orderproduksiformsubmit(Request $Request, $KodeProduksi){
        $Jumlah = 0;
        foreach($Request->data as $key => $value){
  
            $Jumlah = $Jumlah + $value['Jumlah'];
        }
        
        CompositeProduction::where(['KodeProduksi'=>$KodeProduksi])
        ->update([
            'Status'=>'1',
            'Keterangan'=>$Request['Keterangan'],
            'JumlahComposite'=>$Request['JumlahComposite'],
            'JumlahBaglog'=>$Jumlah,
        ]);

        foreach($Request->data as $key => $value){
            CompositeBaglogPemakaian::create([
                'KodeComposite'=>$KodeProduksi,
                'KodeBaglog'=>$value['KodeBaglog'],
                'Jumlah'=>$value['Jumlah'],
            ]);
        }

        return redirect(url('operator/composite'));
    }

    public function productionreport(){
        $CompositeProduction = CompositeProduction::where('Status', '=', '1')->where('StatusHarvest', '=', '0')
        ->leftJoin('composite_variant', 'composite_production.JenisComposite', '=', 'composite_variant.id')
        ->get();
        $CompositeReminder = CompositeReminder::all()->groupBy('KodeProduksi');
        $CompositeKonta = CompositeKontaminasi::all()->groupBy('KodeProduksi');
        return view('operator.composite.ProductionReport', [
            'CompositeProduction' => $CompositeProduction,
            'CompositeReminder' => $CompositeReminder,
            'CompositeKonta' => $CompositeKonta,
        ]);
    }

    public function kontaminasi($KodeProduksi){
        return view('operator.composite.Kontaminasi', [
            'KodeProduksi' => $KodeProduksi,
        ]);
    }

    public function datakontaminasi($KodeProduksi){
        $CompositeKonta = CompositeKontaminasi::where('KodeProduksi', '=', $KodeProduksi)->get();
        return view('operator.composite.DataKonta', [
            'CompositeKonta' => $CompositeKonta,
        ]);
    }

    public function deletekontaminasi($id){
        CompositeKontaminasi::where(['id'=>$id])
        ->delete();
        return redirect(url('/operator/composite/production-report'));
    }


    public function submitkontaminasi(Request $request){
        CompositeKontaminasi::create([
            'KodeProduksi'=>$request['KodeProduksi'],
            'TanggalKonta'=>$request['TanggalKonta'],
            'Jumlah'=>$request['Jumlah'],
            'Keterangan'=>$request['Keterangan'],
        ]);

        $CompositeProduction = CompositeProduction::all()->where('Status', '=', '1', 'StatusHarvest', '=', '0');
        $CompositeReminder = CompositeReminder::all()->groupBy('KodeProduksi');
        $CompositeKonta = CompositeKontaminasi::all()->groupBy('KodeProduksi');
        return view('operator.composite.ProductionReport', [
            'CompositeProduction' => $CompositeProduction,
            'CompositeReminder' => $CompositeReminder,
            'CompositeKonta' => $CompositeKonta,
        ]);
    }

    public function harvest($KodeProduksi){
        return view('operator.composite.Harvest', [
            'KodeProduksi' => $KodeProduksi,
        ]);
    }

    public function submitharvest(Request $request){
        CompositeHarvest::create([
            'KodeProduksi'=>$request['KodeProduksi'],
            'JenisPanen'=>$request['JenisPanen'],
            'Passed'=>$request['Passed'],
            'Reject'=>$request['Reject'],
            'Keterangan'=>$request['Keterangan'],
        ]);

        CompositeProduction::where(['KodeProduksi'=>$request['KodeProduksi']])
        ->update(['StatusHarvest'=>'1',]);

        return redirect(url('operator/composite/production-report'));
    }

    
    
}
