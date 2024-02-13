<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biobo\Harvest;
use App\Models\Biobo\PemakaianPT;
use App\Models\Biobo\PT1;
use App\Models\Biobo\PT2;

class BioboController extends Controller
{
    public function harvest(){
        $data = Harvest::orderBy('TanggalPanen', 'desc')
        ->paginate(15);
        return view('admin.biobo.Harvest', [
            'Data'=> $data,
        ]);
    }

    public function harvestdelete($id){
        Harvest::where('id', '=', $id)->delete();
        return redirect(url('/admin/biobo/harvest'));
    }

    public function harvestform($id){
        $data = Harvest::all()->where('id', '=', $id);
        return view('admin.biobo.HarvestForm', [
            'Data'=> $data,
        ]);
    }

    public function harvestupdate($id, request $request){
        Harvest::where('id', '=', $id)->update([
            'TanggalPanen'=>$request['TanggalPanen'],
            'Quality'=>$request['Quality'],
            'Ukuran'=>$request['Ukuran'],
            'TanggalProduksi'=>$request['TanggalProduksi'],
            'Jumlah'=>$request['Jumlah'],   
        ]);
        return redirect(url('/admin/biobo/harvest'));
    }

    public function pt1(){
        $data = PT1::select(
            'biobo_pt1.*',
            'biobo_pt2.id as ID_PT2',
            'biobo_pt2.Tanggal as TanggalTerima2',
            'TanggalSanding',
            'PSanding10x15',
            'PSanding10x20',
            'PSanding30x30',
            'TanggalCutting',
            'PCutting10x15',
            'PCutting10x20',
            'PCutting30x30',
        )
        ->orderBy('biobo_PT1.Tanggal', 'desc')->leftJoin('biobo_pt2', 'biobo_pt2.PT1_ID', '=', 'biobo_pt1.ID')
        ->paginate(15);
        foreach($data as $item){
            $item['Mylea'] = PemakaianPT::select(
                'biobo_pemakaian_pt.jumlah',
                'biobo_harvest.TanggalProduksi',
                'biobo_harvest.TanggalPanen',
            )->join('biobo_harvest','biobo_harvest.id','=','biobo_pemakaian_pt.Harvest_ID')
            ->where('PT1_ID', '=', $item['id'])->get();
        }
        return view('admin.biobo.PT1', [
            'Data'=> $data,
        ]);
    }

    public function pt1delete($id){
        PT1::where('id', '=', $id)->delete();
        return redirect(url('/admin/biobo/pt1'));
    }

    public function pt1form($id){
        $data = PT1::all()->where('id', '=', $id);
        return view('admin.biobo.PT1Form', [
            'Data'=> $data,
        ]);
    }

    public function pt1update($id, request $request){
        PT1::where('id', '=', $id)->update([
            'NoBatch'=>$request['NoBatch'],
            'Tanggal'=>$request['Tanggal'],
            'U10x15'=>$request['U10x15'],
            'U10x20'=>$request['U10x20'],
            'U30x30'=>$request['U30x30'],
            'TanggalDrying'=>$request['TanggalDrying'],
            'PDrying10x15'=>$request['PDrying10x15'],
            'PDrying10x20'=>$request['PDrying10x20'],
            'PDrying30x30'=>$request['PDrying30x30'],
            'TanggalPressing'=>$request['TanggalPressing'],
            'PPressing10x15'=>$request['PPressing10x15'],
            'PPressing10x20'=>$request['PPressing10x20'],
            'PPressing30x30'=>$request['PPressing30x30'],
        ]);
        return redirect(url('/admin/biobo/pt1'));
    }

    public function pt2(){
        $data = PT2::orderBy('Tanggal', 'desc')
        ->paginate(15);
        return view('admin.biobo.PT2', [
            'Data'=> $data,
        ]);
    }

    public function pt2delete($id){
        PT2::where('id', '=', $id)->delete();
        return redirect(url('/admin/biobo/pt1'));
    }

    public function pt2form($id){
        $data = PT2::all()->where('id', '=', $id);
        return view('admin.biobo.PT2Form', [
            'Data'=> $data,
        ]);
    }

    public function pt2update($id, request $request){
        PT2::where('id', '=', $id)->update([
            'NoBatch'=>$request['NoBatch'],
            'Tanggal'=>$request['Tanggal'],
            'U10x15'=>$request['U10x15'],
            'U10x20'=>$request['U10x20'],
            'U30x30'=>$request['U30x30'],
            'TanggalSanding'=>$request['TanggalSanding'],
            'PSanding10x15'=>$request['PSanding10x15'],
            'PSanding10x20'=>$request['PSanding10x20'],
            'PSanding30x30'=>$request['PSanding30x30'],
            'TanggalCutting'=>$request['TanggalCutting'],
            'PCutting10x15'=>$request['PCutting10x15'],
            'PCutting10x20'=>$request['PCutting10x20'],
            'PCutting30x30'=>$request['PCutting30x30'],
        ]);
        return redirect(url('/admin/biobo/pt1'));
    }
}
