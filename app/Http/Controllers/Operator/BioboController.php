<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biobo\Harvest;
use App\Models\Biobo\PT1;
use App\Models\Biobo\PT2;
use App\Models\Biobo\PemakaianPT;
use Carbon\Carbon;

class BioboController extends Controller
{
    public function index(){
        $date = Carbon::now();
        $date->toDateString();
        $BioboProduction = Harvest::orderBy('TanggalProduksi', 'asc')->whereMonth('TanggalProduksi', $date)->get();
        $PT1 = PT1::all()->where('TanggalPressing', '=', null);
        $PT2 = PT2::all()->where('TanggalCutting', '=', null);
        return view('operator.biobo.Index', [
            'BioboProduction'=>$BioboProduction,
            'BioboPT1'=>$PT1,
            'BioboPT2'=>$PT2,
        ]);
    }

    public function harvest(){
        return view('operator.biobo.HarvestForm');
    }

    public function harvestsubmit(Request $request){
        $TanggalPanen = $request['TanggalPanen'];
        foreach($request->data as $key => $value){
            Harvest::create([
                'TanggalPanen'=>$TanggalPanen,
                'Quality'=>$value['Quality'],
                'Ukuran'=>$value['Ukuran'],
                'TanggalProduksi'=>$value['TanggalProduksi'],
                'Jumlah'=>$value['Jumlah'],          
            ]);
        }

        return redirect(url('/operator/biobo'));
    }

    public function indexpt1(){
        return view('operator.biobo.PostTreatment1');
    }

    public function inputpt1(){
        $Harvest = Harvest::all();
        foreach($Harvest as $item){
            $Pemakaian = PemakaianPT::where('Harvest_ID', '=', $item['id'])->get();
            $item['InStock'] = $item['Jumlah'];
            foreach($Pemakaian as $item2){
                $item['InStock'] = $item['InStock'] - $item2['Jumlah'];
            }
        }
        
        return view('operator.biobo.PT1Form', [
            'DataHarvest' => $Harvest,
        ]);
    }

    public function pt1submit(Request $request){
        $U10x15 = 0;
        $U10x20 = 0;
        $U30x30 = 0;
        $PT_ID = PT1::create([
            'NoBatch'=>$request['NoBatch'],
            'Tanggal'=>$request['Tanggal'],
            'U10x15'=>$U10x15,
            'U10x20'=>$U10x20,
            'U30x30'=>$U30x30,          
        ])->id;
        
        foreach($request->data as $key => $value){
            PemakaianPT::create([
                'Harvest_ID'=>$value['HarvestedBiobo'],
                'PT1_ID'=>$PT_ID,
                'Jumlah'=>$value['Jumlah'],
            ]);
            $Harvest = Harvest::where('id', '=', $value['HarvestedBiobo'])->first();
            if($Harvest['Ukuran'] == '10x15'){
                $U10x15 = $U10x15 + $value['Jumlah'];
            }
            else if ($Harvest['Ukuran'] == '10x20'){
                $U10x20 = $U10x20 + $value['Jumlah'];
            }
            else if ($Harvest['Ukuran'] == '30x30'){
                $U30x30 = $U30x30 + $value['Jumlah'];
            }
        }
        PT1::where('id', '=', $PT_ID)->update([
            'U10x15'=>$U10x15,
            'U10x20'=>$U10x20,
            'U30x30'=>$U30x30,   
        ]);

        return redirect(url('/operator/biobo/monitoring-post-treatment-1'));
    }

    public function pt1monitoring(){
        $PT1 = PT1::all()->where('TanggalPressing', '=', null);
        foreach($PT1 as $item){
            $item['Mylea'] = PemakaianPT::select(
                'biobo_pemakaian_pt.jumlah',
                'biobo_harvest.TanggalProduksi',
                'biobo_harvest.TanggalPanen',
            )->join('biobo_harvest','biobo_harvest.id','=','biobo_pemakaian_pt.Harvest_ID')
            ->where('PT1_ID', '=', $item['id'])->get();
        }
        return view('operator.biobo.MonitoringPT1', [
            'PT1'=>$PT1,
        ]);
    }

    public function pt1drying($id, $NoBatch){
        return view('operator.biobo.PT1Drying', [
            'id'=>$id,
            'NoBatch'=>$NoBatch,
        ]);
    }

    public function pt1pressing($id, $NoBatch){
        return view('operator.biobo.PT1Pressing', [
            'id'=>$id,
            'NoBatch'=>$NoBatch,
        ]);
    }

    public function pt1dryingsubmit($id, Request $request){
        PT1::where('id', '=', $id)
        ->update([
            'TanggalDrying'=>$request['TanggalDrying'],
            'PDrying10x15'=>$request['U10x15'],
            'PDrying10x20'=>$request['U10x20'],
            'PDrying30x30'=>$request['U30x30'],
        ]);

        return redirect(url('/operator/biobo/monitoring-post-treatment-1'));
    }

    public function pt1pressingsubmit($id, Request $request){
        PT1::where('id', $id)
        ->update([
            'TanggalPressing'=>$request['TanggalPressing'],
            'PPressing10x15'=>$request['U10x15'],
            'PPressing10x20'=>$request['U10x20'],
            'PPressing30x30'=>$request['U30x30'],
        ]);
        PT2::create([
            'PT1_ID'=>$id,
            'NoBatch'=>$request['NoBatch'],
            'U10x15'=>$request['U10x15'],
            'U10x20'=>$request['U10x20'],
            'U30x30'=>$request['U30x30'],
        ]);

        
        return redirect(url('/operator/biobo/monitoring-post-treatment-1'));
    }

    public function pt2monitoring(){
        $PT2 = PT2::all()->where('TanggalCutting', '=', null);
        foreach($PT2 as $item){
            $item['Mylea'] = PemakaianPT::select(
                'biobo_pemakaian_pt.jumlah',
                'biobo_harvest.TanggalProduksi',
                'biobo_harvest.TanggalPanen',
            )->join('biobo_harvest','biobo_harvest.id','=','biobo_pemakaian_pt.Harvest_ID')
            ->where('PT1_ID', '=', $item['PT1_ID'])->get();
        }
        return view('operator.biobo.MonitoringPT2', [
            'PT2'=>$PT2,
        ]);
    }

    public function pt2terima($id, Request $request){
        $date = Carbon::now();
        PT2::where('id', '=', $id)
        ->update([
            'Tanggal'=> $request['Tanggal'],
        ]);

        return redirect(url('/operator/biobo/post-treatment-2'));
    }

    public function pt2sanding($id, $NoBatch){
        return view('operator.biobo.PT2Sanding', [
            'id'=>$id,
            'NoBatch'=>$NoBatch,
        ]);
    }

    public function pt2sandingsubmit($id, Request $request){
        PT2::where('id', '=', $id)
        ->update([
            'TanggalSanding'=>$request['TanggalSanding'],
            'PSanding10x15'=>$request['U10x15'],
            'PSanding10x20'=>$request['U10x20'],
            'PSanding30x30'=>$request['U30x30'],
        ]);

        return redirect(url('/operator/biobo/post-treatment-2'));
    }

    public function pt2cutting($id, $NoBatch){
        return view('operator.biobo.PT2Cutting', [
            'id'=>$id,
            'NoBatch'=>$NoBatch,
        ]);
    }

    public function pt2cuttingsubmit($id, Request $request){
        PT2::where('id', '=', $id)
        ->update([
            'TanggalCutting'=>$request['TanggalCutting'],
            'PCutting10x15'=>$request['U10x15'],
            'PCutting10x20'=>$request['U10x20'],
            'PCutting30x30'=>$request['U30x30'],
        ]);

        return redirect(url('/operator/biobo/post-treatment-2'));
    }
}
