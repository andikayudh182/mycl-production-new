<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\baglog\Bahan_Recipe;
use App\Models\baglog\Details_Recipe;
use App\Models\baglog\Kontaminasi;
use App\Models\baglog\Mixing;
use App\Models\baglog\Sterilisasi;
use App\Models\baglog\Kartu_Kendali;
use App\Models\baglog\UjiCoba;
use App\Models\Composite\CompositeBaglog;
use App\Models\Composite\CompositeProduction;
use App\Models\Composite\CompositeReminder;
use App\Models\Composite\CompositeBaglogPemakaian;
use App\Models\Composite\CompositeKontaminasi;
use App\Models\Composite\CompositeHarvest;
use App\Models\Composite\CompositeVariant;
use Illuminate\Http\Request;

class CompositeController extends Controller
{
    // public function index() {
    //     return view('admin.composite.Index',[
    //         // 
    //     ]);
    // }

    public function CompositeVariant(){
        $Data = CompositeVariant::all();
        return view('admin.composite.CompositeVariant', [
            'Data' => $Data,
        ]);
    }

    public function CompositeVariantSubmit(Request $request){
        if($request['id'] == '0'){
            CompositeVariant::create([
                'Nama' => $request['Nama'],
                'Keterangan' => $request['Keterangan'],
                'InkubasiSatu' => $request['InkubasiSatu'],
                'InkubasiDua' => $request['InkubasiDua'],
                'InkubasiTiga' => $request['InkubasiDua'],
            ]);
            return redirect(url('/admin/composite/composite-variant'))->with('message', 'Data Variant Composite Created!');
        } else {
            CompositeVariant::where('id', $request['id'])->update([
                'Nama' => $request['Nama'],
                'Keterangan' => $request['Keterangan'],
                'InkubasiSatu' => $request['InkubasiSatu'],
                'InkubasiDua' => $request['InkubasiDua'],
                'InkubasiTiga' => $request['InkubasiTiga'],
            ]);
            return redirect(url('/admin/composite/composite-variant'))->with('message', 'Data Variant Composite Updated!');
        }
        return redirect(url('/admin/composite/composite-variant'));
    }

    public function CompositeVariantDelete($id){
        CompositeVariant::where('id', $id)->delete();

        return redirect(url('/admin/composite/composite-variant'))->with('message', 'Data Variant Composite Deleted!');
    }

    public function orderproduksi()
    {
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
                    // ->where('baglog_details_recipes.JenisBibit', '=', 'GN')
                    ->select('baglog_details_recipes.JenisBibit')
                    ->get();
                 }
            }
        }

        $Test = Kartu_Kendali::where('KodeProduksi', 'BL223-07-21')->get();

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

        //Data variant composite
        $VariantComposite = CompositeVariant::all();

        return view('admin.composite.OrderProduksi',[
            'Data'=>$Data,
            'VariantComposite'=>$VariantComposite,
            'Test' => $Test
        ]);
    }

    public function submitorderproduksi(Request $request) {
        $request->validate([
            'TanggalProduksi'=> 'Required',
            'JenisBaglog'=>'Required',
            'Lokasi' =>'Required',
            'JenisComposite'=>'Required',
            'JumlahComposite'=>'Required'
        ]);
        $TanggalProduksi = $request['TanggalProduksi'];
        $JenisBaglog = $request['JenisBaglog'];
        $JenisComposite = $request['JenisComposite'];
        $JumlahComposite = $request['JumlahComposite'];
        
        $CompositeVariantDetails = CompositeVariant::where('id', $JenisComposite)->first();
     
        $Lokasi = $request['Lokasi'];
        $Jumlah = '0';
        $TB = date("y-m-d", strtotime($TanggalProduksi));

        $KodeProduksi = 'CO'.$TB;
        $BukaCetakan = date('Y-m-d', strtotime($TanggalProduksi. ' + ' . $CompositeVariantDetails['InkubasiSatu'] . ' days')); 
        
        if ($CompositeVariantDetails['InkubasiDua'] == 0) {
            $Inkubasi = $BukaCetakan; 
        }

        else {
            $Inkubasi = date('Y-m-d', strtotime($BukaCetakan. ' + ' . $CompositeVariantDetails['InkubasiDua'] . ' days')); 
        }
        

        $Panen = date('Y-m-d', strtotime($Inkubasi. ' + ' . $CompositeVariantDetails['InkubasiTiga'] . ' days'));


        $compositeProduction = CompositeProduction::create([
            'KodeProduksi'=>$KodeProduksi,
            'TanggalProduksi'=>$TanggalProduksi,
            'JenisBaglog'=>$JenisBaglog,
            'JenisComposite'=>$JenisComposite,
            'JumlahComposite'=>$JumlahComposite,
            'JumlahBaglog'=>$Jumlah,
            'Lokasi'=>$Lokasi,
            'Status'=>0,
            'StatusHarvest'=>0,
        ]);

        $compositeID = $compositeProduction->id;

        foreach($request->data as $key => $value){
            CompositeBaglog::create([
                'CompositeID'=>$compositeID,
                'KodeComposite'=>$KodeProduksi,
                'KodeBaglog'=>$value['KodeBaglog'],
                'Jumlah'=>$value['Jumlah'],
            ]);
            $Jumlah = $Jumlah + $value['Jumlah'];
        }

        CompositeProduction::where('id',$compositeID)->update([
            'JumlahBaglog' => $Jumlah
        ]);


        CompositeReminder::create([
            'CompositeID'=>$compositeID,
            'KodeProduksi'=>$KodeProduksi,
            'TanggalBukaCetakan'=>$BukaCetakan,
            'TanggalInkubasi'=>$Inkubasi,
            'TanggalPanen'=>$Panen,
        ]);

        $Data = Kartu_Kendali::orderBy('TanggalPembibitan', 'desc')
        ->select('KodeProduksi', 'SterilisasiID')
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

        //Data variant composite
        $VariantComposite = CompositeVariant::all();

        return view('admin.composite.OrderProduksi',[
            'Data'=>$Data,
            'VariantComposite'=>$VariantComposite,
        ]);
    }

    public function report(Request $request){
        $CompositeProduction = CompositeProduction::join('composite_variant', 'composite_production.JenisComposite', '=', 'composite_variant.id')
            ->select('composite_production.*', 'composite_variant.Nama')
            ->sortable()
            ->orderBy('composite_production.TanggalProduksi', 'asc')
            ->paginate(15);
        $CompositeProductionAll = CompositeProduction::join('composite_variant', 'composite_production.JenisComposite', '=', 'composite_variant.id')
            ->select('composite_production.*', 'composite_variant.Nama')
            ->orderBy('composite_production.TanggalProduksi', 'asc')
            ->get();
        $InStock = $CompositeProductionAll->sum('JumlahBaglog');;

        //filter and search
        if(isset($request->Submit)){
            $search = $request->SearchQuery;
            $CompositeProduction = CompositeProduction::join('composite_variant', 'composite_production.JenisComposite', '=', 'composite_variant.id')
            ->select('composite_production.*', 'composite_variant.Nama')
            ->where('KodeProduksi', 'like', "%" . $search . "%")
            ->orderBy('composite_production.TanggalProduksi', 'asc')
            ->paginate(150);
            $InStock = $CompositeProduction->sum('JumlahBaglog');
        }
        if(isset($request->Filter)){
            $Date1 = date('Y-m-d', strtotime($request['TanggalAwal']));
            $Date2 = date('Y-m-d', strtotime($request['TanggalAkhir']));
            $CompositeProduction = CompositeProduction::join('composite_variant', 'composite_production.JenisComposite', '=', 'composite_variant.id')
            ->select('composite_production.*', 'composite_variant.Nama')
            ->whereBetween('composite_production.TanggalProduksi', [$Date1, $Date2])
            ->orderBy('composite_production.TanggalProduksi', 'asc')
            ->paginate(150);
            $InStock = $CompositeProduction->sum('JumlahBaglog');
            $resume['TanggalAwal'] = $Date1;
            $resume['TanggalAkhir'] = $Date2;
        }

        foreach($CompositeProduction as $data){
            $data['Reminder'] = CompositeReminder::where('KodeProduksi', $data['KodeProduksi'])->get();
            $data['Baglog'] = CompositeBaglog::where('KodeComposite', $data['KodeProduksi'])->get();
            $data['CompositeOperator'] = CompositeBaglogPemakaian::where('KodeComposite', $data['KodeProduksi'])->get();
            $data['Kontaminasi'] = CompositeKontaminasi::where('KodeProduksi', $data['KodeProduksi'])->get();
            $data['JumlahKontaminasi'] = $data['Kontaminasi']->sum('Jumlah');

            $data['Harvest'] = CompositeHarvest::where('KodeProduksi', $data['KodeProduksi'])->get();
            // $data['HarvestBiobo'];
            $data['Passed'] = $data['Harvest']->sum('Passed');
            $data['Reject'] = $data['Harvest']->sum('Reject');

            // $data['PostTreatment'] = QualityControl1::where('KPMylea', $data['KodeProduksi'])->get();
            // $i = 0;
            // foreach($data['PostTreatment'] as $PT){
            //     $data['PostTreatment'][$i]['DataAwal'] = QualityDetails::where('KodeProduksi', $PT['KodeProduksi'])->get();
            //     $data['PostTreatment'][$i]['DataAkhir'] = QualityDetails2::where('KodeProduksi', $PT['KodeProduksi'])->get();
            //     $i++;
            // }
            
        }

        if(isset($request->Submit) || isset($request->Filter)){
            $CompositeProductionAll = $CompositeProduction;
        }
        foreach($CompositeProductionAll as $item){
            $item['Kontaminasi'] = CompositeKontaminasi::where('KodeProduksi', $item['KodeProduksi'])->get();
            $item['Harvest'] = CompositeHarvest::where('KodeProduksi', $item['KodeProduksi'])->get();
            $TotalKontaminasi = $item['Kontaminasi']->sum('Jumlah');
            $Reject = $item['Harvest']->sum('Reject');
            $Passed = $item['Harvest']->sum('Passed');
            $InStock -= ($TotalKontaminasi + $Reject + $Passed);
        }

        return view('admin.composite.Report', [
            'CompositeProduction' => $CompositeProduction,
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

            $Report = CompositeProduction::leftJoin('composite_variant', 'composite_production.JenisComposite', '=', 'composite_variant.id')
                    ->whereBetween('composite_production.TanggalProduksi', [$Date1, $Date2])
                    ->orderBy('composite_production.TanggalProduksi', 'asc')
                    ->get();

            foreach($Report as $data){
                $data['Baglog'] = CompositeBaglog::where('KodeComposite', $data['KodeProduksi'])->get();
                
                $data['BaglogDetails'] = '';
                foreach($data['Baglog'] as $Baglog){
                    $data['BaglogDetails'] = $data['BaglogDetail'].$Baglog['KodeBaglog'].",";
                }
                $data['Kontaminasi'] = CompositeKontaminasi::where('KodeProduksi', $data['KodeProduksi'])->get();
                $data['JumlahKontaminasi'] = 0;
                foreach($data['Kontaminasi'] as $Konta){
                    $data['JumlahKontaminasi'] = $data['JumlahKontaminasi'] + $Konta['Jumlah'];
                }
                $data['Harvest'] = CompositeHarvest::where('KodeProduksi', $data['KodeProduksi'])->get();
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

        return view('admin.composite.ExportData', [
            'data' => $Report,
            'Resume'=>$Total,
            compact('Report'),
            ]);
    }

    public function databaglogdelete($id){
        CompositeBaglog::where('id', $id)->delete();

        return redirect(url('/admin/composite/report'))->with('message', 'Data Baglog Deleted!');
    }

    public function DataBaglogDeleteOperator($id){
        CompositeBaglogPemakaian::where('id', $id)->delete();

        return redirect(url('/admin/composite/report'))->with('message', 'Data Baglog Deleted!');
    }

    public function databaglogadd($KodeProduksi){
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
            $CompositeBaglog = CompositeBaglog::where('KodeBaglog', $data['KodeProduksi'])->get();
            $data['Terpakai'] = $CompositeBaglog->sum('Jumlah');
            $data['UjiCoba'] = UjiCoba::where('BaglogID', $data['id'])->get();
            $data['UjiCoba'] = $data['UjiCoba']->sum('Jumlah');
    
            $data['InStock'] = $data['JumlahBaglog'] - ($data['Kontaminasi'] + $data['Terpakai'] + $data['UjiCoba']);
        }

        return view('admin.composite.FormAddBaglogComposite', [
            'Data' => $Data,
            'KodeProduksi' => $KodeProduksi,
        ]);
    }

    public function databaglogaddsubmit(Request $Request, $KodeProduksi){
        if($Request['JenisInput'] == 'Admin'){
            foreach($Request->data as $key => $value){
                CompositeBaglog::create([
                    'KodeComposite'=>$KodeProduksi,
                    'KodeBaglog'=>$value['KodeBaglog'],
                    'Jumlah'=>$value['Jumlah'],
                ]);
            }
        } else {
            foreach($Request->data as $key => $value){
                CompositeBaglogPemakaian::create([
                    'KodeComposite'=>$KodeProduksi,
                    'KodeBaglog'=>$value['KodeBaglog'],
                    'Jumlah'=>$value['Jumlah'],
                ]);
            }
        }


        return redirect(url('/admin/composite/report'))->with('message', 'Data Baglog Added');
    }
    public function deleteharvest($id, $KodeProduksi){
        CompositeHarvest::where('id', $id)->delete();

        CompositeProduction::where(['KodeProduksi'=>$KodeProduksi])
        ->update(['StatusHarvest'=>'0',]);

        // $MyleaHarvest = MyleaHarvest::where('KodeProduksi', '=', $KodeProduksi)->get();
        return redirect(url('/admin/composite/report'))->with('message', 'Data Harvest'.$KodeProduksi.' Deleted!');
    }

    public function reportedit($KodeProduksi){
        $CompositeProduction = CompositeProduction::where('KodeProduksi', '=', $KodeProduksi)
        ->leftJoin('composite_variant', 'composite_production.JenisComposite', '=', 'composite_variant.id')
        ->get();

        $CompositeBaglogAdmin = CompositeBaglog::where('KodeComposite', '=', $KodeProduksi)->get();
        $CompositeBaglogOperator = CompositeBaglogPemakaian::where('KodeComposite', '=', $KodeProduksi)->get();


        //Data variant composite
        $VariantComposite = CompositeVariant::all();

        // Data kartu kendali buat pilihan baglog
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
                    // ->where('baglog_details_recipes.JenisBibit', '=', 'GN')
                    ->select('baglog_details_recipes.JenisBibit')
                    ->get();
                 }
            }
        }

        // $Test = Kartu_Kendali::where('KodeProduksi', 'BL223-07-21')->get();

        foreach($Data as $data){
            $data['Kontaminasi'] = 0;
            $data['Terpakai'] = 0;
            $Kontaminasi = Kontaminasi::where('KodeProduksi', $data['KodeProduksi'])->get();
            $data['Kontaminasi'] = $Kontaminasi->sum('JumlahKontaminasi');
            $CompositeBaglog = CompositeBaglogPemakaian::where('KodeBaglog', $data['KodeProduksi'])->get();
            $data['Terpakai'] = $CompositeBaglog->sum('Jumlah');
            $data['UjiCoba'] = UjiCoba::where('BaglogID', $data['id'])->get();
            $data['UjiCoba'] = $data['UjiCoba']->sum('Jumlah');
    
            $data['InStock'] = $data['JumlahBaglog'] - ($data['Kontaminasi'] + $data['UjiCoba']);
        }

        return view('admin.composite.ReportEdit', [
            'KodeProduksi' => $KodeProduksi,
            'CompositeProduction'=>$CompositeProduction,
            'VariantComposite'=>$VariantComposite,

            'BaglogAdmin' => $CompositeBaglogAdmin,
            'BaglogOperator' => $CompositeBaglogOperator,

            'Data' => $Data
        ]);
    }

    public function reportsubmit(Request $request){

        try {
            $OldProductionCode = $request['KodeProduksi'];
            $NewProductionCode = substr($OldProductionCode, 0, 4). substr($request['TanggalProduksi'], 4, 9);
            CompositeBaglog::where('KodeComposite', $OldProductionCode)->update([
                'KodeComposite'=>$NewProductionCode,
            ]);
            CompositeBaglogPemakaian::where('KodeComposite', $OldProductionCode)->update([
                'KodeComposite'=>$NewProductionCode,
            ]);
            CompositeKontaminasi::where('KodeProduksi', $OldProductionCode)->update([
                'KodeProduksi'=>$NewProductionCode,
            ]);
            CompositeHarvest::where('KodeProduksi', $OldProductionCode)->update([
                'KodeProduksi'=>$NewProductionCode,
            ]);
            CompositeReminder::where('KodeProduksi', $OldProductionCode)->update([
                'KodeProduksi'=>$NewProductionCode,
            ]);
            CompositeProduction::where(['KodeProduksi'=>$request['KodeProduksi']])
            ->update([
                'KodeProduksi'=>$NewProductionCode,
                'TanggalProduksi'=>$request['TanggalProduksi'],
                'JenisBaglog'=>$request['JenisBaglog'],
                'JumlahBaglog'=>$request['JumlahBaglog'],
                'JenisComposite'=>$request['JenisComposite'],
                'JumlahComposite'=>$request['JumlahComposite'],
                'Lokasi'=>$request['Lokasi'],
            ]);

            CompositeBaglog::where(['KodeComposite'=>$NewProductionCode])
            ->delete();

            CompositeBaglogPemakaian::where(['KodeComposite'=>$NewProductionCode])
            ->delete();

            foreach($request['data1'] as $value){
                CompositeBaglog::create([
                    'KodeComposite'=>$NewProductionCode,
                    'KodeBaglog'=>$value['KodeBaglog'],
                    'Jumlah'=>$value['Jumlah'],
                ]);
            }

            $JumlahBaglogTerpakai = 0;

            foreach($request['data2'] as $value){
                CompositeBaglogPemakaian::create([
                    'KodeComposite'=>$NewProductionCode,
                    'KodeBaglog'=>$value['KodeBaglog'],
                    'Jumlah'=>$value['Jumlah'],
                ]);
                $JumlahBaglogTerpakai = $JumlahBaglogTerpakai + $value['Jumlah'];
            }

            CompositeProduction::where(['KodeProduksi'=>$NewProductionCode])
            ->update([
               
                'JumlahBaglog'=>$JumlahBaglogTerpakai,
            ]);
    
    
            
            return redirect(url('/admin/composite/report'))->with('success', 'Data Composite '.$NewProductionCode.' updated!');
        } catch (\Exception $e) {
            return redirect(url('/admin/composite/report'))->with('error', 'message :  ' . $e->getMessage());
        }
    
    }

    public function kontaminasi($KodeProduksi){
        $CompositeKonta = CompositeKontaminasi::where('KodeProduksi', '=', $KodeProduksi)->get();
        return view('admin.composite.Kontaminasi', [
            'CompositeKonta'=>$CompositeKonta,
        ]);
    }

    public function kontaminasisubmit(Request $request, $id){
        CompositeKontaminasi::where(['id'=>$id])
        ->update([
            'Jumlah'=>$request['Jumlah'],
            'TanggalKonta'=>$request['TanggalKonta'],
            'Keterangan'=>$request['Keterangan'],
        ]);

        $CompositeProduction = CompositeProduction::orderBy('TanggalProduksi', 'asc')->get();
        $CompositeReminder = CompositeReminder::all()->groupBy('KodeProduksi');
        $CompositeKonta = CompositeKontaminasi::all()->groupBy('KodeProduksi');
        $CompositeHarvest = CompositeHarvest::all()->groupBy('KodeProduksi');
        return view('admin.composite.Report', [
            'CompositeProduction' => $CompositeProduction,
            'CompositeReminder' => $CompositeReminder,
            'CompositeKonta' => $CompositeKonta,
            'CompositeHarvest' => $CompositeHarvest,
        ]);
    }

    public function kontaminasiedit($id){
        $CompositeKonta = CompositeKontaminasi::where('id', '=', $id)->get();
        return view('admin.composite.KontaminasiEdit', [
            'CompositeKonta'=>$CompositeKonta,
            'id'=>$id,
        ]);
    }

    public function deletekontaminasi($id){
        CompositeKontaminasi::where(['id'=>$id])
        ->delete();

        $CompositeProduction = CompositeProduction::orderBy('TanggalProduksi', 'asc')->paginate(15);
        $CompositeReminder = CompositeReminder::all()->groupBy('KodeProduksi');
        $CompositeKonta = CompositeKontaminasi::all()->groupBy('KodeProduksi');
        $CompositeHarvest = CompositeHarvest::all()->groupBy('KodeProduksi');
        return view('admin.composite.Report', [
            'CompositeProduction' => $CompositeProduction,
            'CompositeReminder' => $CompositeReminder,
            'CompositeKonta' => $CompositeKonta,
            'CompositeHarvest' => $CompositeHarvest,
        ]);
    }

    public function formkontaminasi($KodeProduksi){
        return view('admin.composite.FormKontaminasi', [
            'KodeProduksi'=>$KodeProduksi,
        ]);
    }

    public function formkontaminasisubmit(Request $request){
        CompositeKontaminasi::create([
            'KodeProduksi'=>$request['KodeProduksi'],
            'TanggalKonta'=>$request['TanggalKonta'],
            'Jumlah'=>$request['Jumlah'],
            'Keterangan'=>$request['Keterangan'],
        ]);
        return redirect(url('/admin/composite/report'));
    }
}
