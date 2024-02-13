<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\baglog\baglogrecipe;
use App\Models\baglog\Bahan_Recipe;
use App\Models\baglog\Details_Recipe;
use App\Models\baglog\Kartu_Kendali;
use App\Models\baglog\Kontaminasi;
use App\Models\baglog\Mixing;
use App\Models\baglog\Sterilisasi;
use App\Models\baglog\UjiCoba;
use App\Models\Composite\CompositeBaglog;
use App\Models\Composite\CompositeBaglogPemakaian;
use App\Models\Mylea\MyleaBaglogPemakaian;
use App\Models\Mylea\MyleaBaglog;
use Carbon\CarbonPeriod;
use KyslikColumnSortableSortable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BaglogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function CalcRecipe()
    {
        return view('admin.baglog.CalcRecipe');
    }


    public function BaglogRecipe(Request $request){
        $details = $request->validate([
            'NoRecipe' => 'Required',
            'TanggalKeluar' => 'Required',
            'TotalBags' => 'Required',
            'WeightperBag' => 'Required',
            'JenisAutoclave' => 'nullable',
            'JenisBibit'=>'Required'
        ]);

        $NoRecipe = $request->input('NoRecipe');
        $W = $request->input('WeightperBag');
        $T = $request->input('TotalBags');
        $x = 0.40 * $W;
        $MCSKayu = $request->input('MCSKayu');
        $MCCaCO3 = $request->input('MCCaCO3');
        $MCPollard = $request->input('MCPollard');
        $MCTapioka = $request->input('MCTapioka');
        $NoKontSKayu = $request->input('NoKontSKayu');
        $SKayu = $x * 0.67 * 0.1 / (100 - $MCSKayu);
        $CaCO3 = $x * 0.03 * 0.1 / (100 - $MCCaCO3);
        $Pollard = $x * 0.20 * 0.1 / (100 - $MCPollard);
        $Tapioka = $x * 0.10 * 0.1 / (100 - $MCTapioka);
        $TotalW = $CaCO3 + $SKayu + $Pollard + $Tapioka;
        $Air = ((0.60 * $W/1000) - ($TotalW - $x/1000)) * $T ;
        Details_Recipe::create($details);
        Bahan_Recipe::create([
            'SKayu'=>round($SKayu*$T/0.005)*0.005,
            'CaCO3'=>round($CaCO3*$T/0.005)*0.005,
            'Pollard'=>round($Pollard*$T/0.005)*0.005,
            'Tapioka'=>round($Tapioka*$T/0.005)*0.005,
            'Air'=>round($Air/0.005)*0.005,
            'NoKontSKayu'=>$NoKontSKayu,
            'MCSKayu'=>$MCSKayu,
            'NoRecipe'=>$NoRecipe,
            'NoKontCaCO3'=>$request['NoKontCaCO3'],
            'NoKontPollard'=>$request['NoKontPollard'],
            'NoKontTapioka'=>$request['NoKontTapioka'],
        ]);

        return redirect (url('admin/baglog/CalcRecipe'))->with('message', 'Data has been saved!');
    }

    public function show(){
        $recipes = Details_Recipe::orderBy('TanggalKeluar', 'desc')->paginate(10);

        return view('admin.baglog.datarecipe',[
            'recipes'=>$recipes,
        ]);
    }

    public function UpdateRecipe($NoRecipe){
        $Details = Details_Recipe::all()->where('NoRecipe', '=', $NoRecipe);
        $Bahan = Bahan_Recipe::all()->where('NoRecipe', '=', $NoRecipe);
        return view('admin.baglog.UpdateRecipe',[
            'Details'=>$Details,
            'Bahan'=>$Bahan,
        ]);
    }

    public function DeleteRecipe($NoRecipe){
        Details_Recipe::where('id', $NoRecipe)->delete();
        Bahan_Recipe::where('id', $NoRecipe)->delete();
        return redirect(url('/admin/baglog/datarecipe'))->with('messageDeleted', 'Data Deleted');
    }

    public function SubmitUpdateRecipe(Request $request, $NoRecipe){
        $updatedetails = [
            'NoRecipe'=>$request['NoRecipe'],
            'TanggalKeluar'=>$request['TanggalKeluar'],
            'TotalBags'=>$request['TotalBags'],
            'WeightperBag'=>$request['WeightperBag'],
            'JenisAutoclave'=>$request['JenisAutoclave'],
            'JenisBibit'=>$request['JenisBibit'],
        ];

        $updatebahan = [
            'NoRecipe'=>$request['NoRecipe'],
            'MCSKayu'=>$request['MCSKayu'],
            'NoKontSKayu'=>$request['NoKontSKayu'],
            'SKayu'=>$request['SKayu'],
            'MCHickory'=>$request['MCHickory'],
            'NoKontHickory'=>$request['NoKontHickory'],
            'Hickory'=>$request['Hickory'],
            'CaCO3'=>$request['CaCO3'],
            'NoKontCaCO3'=>$request['NoKontCaCO3'],
            'Air'=>$request['Air'],
            'Pollard'=>$request['Pollard'],
            'NoKontPollard'=>$request['NoKontPollard'],
            'Tapioka'=>$request['Tapioka'],
            'NoKontTapioka'=>$request['NoKontTapioka'],
        ];
        $Details = Details_Recipe::where('id', '=', $request['idDetails'])->update($updatedetails);
        $Bahan = Bahan_Recipe::where('id', '=', $request['idBahan'])->update($updatebahan);
        $recipes = Details_Recipe::orderBy('TanggalKeluar', 'desc')->paginate(10);

        return redirect(url('/admin/baglog/datarecipe'))->with('message', 'Data Updated');
    }

    public function assignform($NoRecipe){
        return view('admin.baglog.AssignForm', [
            'NoRecipe'=>$NoRecipe,
        ]);
    }

    public function submitmixing(Request $request){
        $mixing = $request->validate([
            'NoRecipe'=>'Required',
            'TanggalMixing'=>'Required',
            'BatchSterilisasi'=>'Required',
            'Status',
        ]);

        $user_id = Auth::user()->id;
        Mixing::create([
            'UserID'=>$user_id,
            'NoRecipe'=>$mixing['NoRecipe'],
            'TanggalMixing'=>$mixing['TanggalMixing'],
            'Status'=>$request['Status'],
            'BatchSterilisasi'=>$request['BatchSterilisasi'],
            'TanggalSterilisasi'=>$request['TanggalSterilisasi'],
        ]);
        return redirect('/admin/baglog/datarecipe');
    }

    public function report(Request $request){
        // $Data = Kartu_Kendali::sortable()->orderBy('TanggalPembibitan', 'desc')->paginate(15);
        $Data = Kartu_Kendali::leftJoin('baglog_sterilisasi', 'baglog_kartu_kendali.SterilisasiID', '=', 'baglog_sterilisasi.id')
            ->leftJoin('baglog_mixing', 'baglog_mixing.id', '=', 'baglog_sterilisasi.MixingID')
            ->leftJoin('baglog_details_recipes', 'baglog_mixing.NoRecipe', '=', 'baglog_details_recipes.NoRecipe')
            ->select(
                'baglog_kartu_kendali.*', // Kolom-kolom dari tabel baglog_kartu_kendali
                'baglog_kartu_kendali.id as idBaglog', // Kolom-kolom dari tabel baglog_kartu_kendali
                'baglog_sterilisasi.*',    // Kolom-kolom dari tabel baglog_sterilisasi
                'baglog_mixing.*',         // Kolom-kolom dari tabel baglog_mixing
                'baglog_details_recipes.*' // Kolom-kolom dari tabel baglog_details_recipes
            )
            ->orderBy('baglog_kartu_kendali.TanggalPembibitan', 'desc')
            ->paginate(15);
        $Konta = Kontaminasi::all()->groupBy('KodeProduksi');
        $InStock = 0;
        $ProduksiBaglog = Kartu_Kendali::selectRaw("sum(JumlahBaglog) as y")->get();
        $KontaminasiBaglog = Kontaminasi::selectRaw("sum(JumlahKontaminasi) as y")->get();
        $PemakaianBaglogMylea = MyleaBaglog::selectRaw("sum(Jumlah) as y")->get();
        $PemakaianBaglogComposite = CompositeBaglog::selectRaw("sum(Jumlah) as y")->get();
        $UjiCobaBaglog = UjiCoba::selectRaw("sum(Jumlah) as y")->get();

        $InStock2 = $ProduksiBaglog[0]['y'] - ($KontaminasiBaglog[0]['y'] + $PemakaianBaglogMylea[0]['y'] + $PemakaianBaglogComposite[0]['y'] + $UjiCobaBaglog[0]['y']);


        //filter and search
        if(isset($request->Submit)){
            $search = $request->SearchQuery;
            // $Data = Kartu_Kendali::sortable()
            // ->where('KodeProduksi','like',"%".$search."%")
            // ->paginate(80);

            $Data = Kartu_Kendali::leftJoin('baglog_sterilisasi', 'baglog_kartu_kendali.SterilisasiID', '=', 'baglog_sterilisasi.id')
            ->leftJoin('baglog_mixing', 'baglog_mixing.id', '=', 'baglog_sterilisasi.MixingID')
            ->select(
                'baglog_kartu_kendali.*', // Kolom-kolom dari tabel baglog_kartu_kendali
                'baglog_kartu_kendali.id as idBaglog', // Kolom-kolom dari tabel baglog_kartu_kendali
                'baglog_sterilisasi.*',    // Kolom-kolom dari tabel baglog_sterilisasi
                'baglog_mixing.*',         // Kolom-kolom dari tabel baglog_mixing
                'baglog_details_recipes.*' // Kolom-kolom dari tabel baglog_details_recipes
            )
            ->leftJoin('baglog_details_recipes', 'baglog_mixing.NoRecipe', '=', 'baglog_details_recipes.NoRecipe')
            ->where(function($query) use ($search) {
                $query->where('baglog_kartu_kendali.KodeProduksi', 'like', '%' . $search . '%')
                    ->orWhere('baglog_details_recipes.JenisBibit', 'like', '%' . $search . '%');
            })
            ->orderBy('baglog_kartu_kendali.TanggalPembibitan', 'asc')
            ->paginate(80);
            
        }
        if (isset($request->Filter)) {
            $Date1 = date('Y-m-d', strtotime($request['TanggalAwal']));
            $Date2 = date('Y-m-d', strtotime($request['TanggalAkhir']));
        
            $Data = Kartu_Kendali::leftJoin('baglog_sterilisasi', 'baglog_kartu_kendali.SterilisasiID', '=', 'baglog_sterilisasi.id')
                ->leftJoin('baglog_mixing', 'baglog_mixing.id', '=', 'baglog_sterilisasi.MixingID')
                ->leftJoin('baglog_details_recipes', 'baglog_mixing.NoRecipe', '=', 'baglog_details_recipes.NoRecipe')
                ->select(
                    'baglog_kartu_kendali.*', // Kolom-kolom dari tabel baglog_kartu_kendali
                    'baglog_kartu_kendali.id as idBaglog', // Kolom-kolom dari tabel baglog_kartu_kendali
                    'baglog_sterilisasi.*',    // Kolom-kolom dari tabel baglog_sterilisasi
                    'baglog_mixing.*',         // Kolom-kolom dari tabel baglog_mixing
                    'baglog_details_recipes.*' // Kolom-kolom dari tabel baglog_details_recipes
                )
                ->whereBetween('baglog_kartu_kendali.TanggalPembibitan', [$Date1, $Date2])
                ->orderBy('baglog_kartu_kendali.TanggalPembibitan', 'desc')
                ->paginate(80);
        
            $resume['TanggalAwal'] = $Date1;
            $resume['TanggalAkhir'] = $Date2;
        }
        

        //data details
        foreach($Data as $data){
            $data['Kontaminasi'] = '0';
            $data['TanggalKontaminasi'] = '';
            $Kontaminasi = Kontaminasi::where('KodeProduksi', $data['KodeProduksi'])->get();
            if(isset($Kontaminasi)){
                foreach($Kontaminasi as $Konta){
                    $data['Kontaminasi'] = $data['Kontaminasi'] + $Konta['JumlahKontaminasi'];
                    $data['TanggalKontaminasi'] = $data['TanggalKontaminasi'].$Konta['Tanggal'].', ';
                }
            }

            $data['UjiCoba'] = UjiCoba::where('BaglogID', $data['idBaglog'])->get();
            $UjiCoba = $data['UjiCoba']->sum('Jumlah');

            if($data['JumlahBaglog'] != 0){
                $data['ContaminationRate'] = $data['Kontaminasi']/$data['JumlahBaglog']*100;
            }
            else {
                $data['ContaminationRate'] = 0;
            }

            $data['ContaminationRate'] = number_format($data['ContaminationRate'], 2);

            $data['MyleaOperator'] = MyleaBaglogPemakaian::where('KodeBaglog', $data['KodeProduksi'])->get();
            $data['MyleaAdmin'] = MyleaBaglog::where('KodeBaglog', $data['KodeProduksi'])->get();

            $data['CompositeOperator'] = CompositeBaglogPemakaian::where('KodeBaglog', $data['KodeProduksi'])->get();
            $data['CompositeAdmin'] = CompositeBaglog::where('KodeBaglog', $data['KodeProduksi'])->get();

            $data['PemakaianMylea'] = 0;
            $data['PemakaianComposite'] = 0;
            foreach($data['MyleaOperator'] as $DataMylea){
               $data['PemakaianMylea'] =$data['PemakaianMylea'] + $DataMylea['Jumlah'];
            }

            foreach($data['CompositeOperator'] as $DataComposite){
               $data['PemakaianComposite'] = $data['PemakaianComposite'] + $DataComposite['Jumlah'];
            }
            $SterilisasiID = explode(", " , $data['SterilisasiID']);
            $data['Sterilisasi'] = array();
            if($SterilisasiID != 0){
                for($i = 0; $i < count($SterilisasiID); $i++){
                    $data['Sterilisasi'] = Sterilisasi::where('baglog_sterilisasi.id', $SterilisasiID[$i])
                    ->leftJoin('baglog_mixing', 'baglog_sterilisasi.MixingID', '=', 'baglog_mixing.id')
                    ->select('baglog_mixing.NoRecipe','baglog_mixing.TanggalMixing', 'baglog_mixing.Keterangan AS KeteranganMixing', 'baglog_sterilisasi.*')
                    ->get();
                 }
            }

            $data['InStock'] = $data['JumlahBaglog'] - $data['Kontaminasi'] - $UjiCoba;            
            $InStock += $data['InStock'] - $data['PemakaianMylea'] - $data['PemakaianComposite'] - $UjiCoba;
        }

        if(isset($request->Submit) || isset($request->Filter)){
            $InStock2 = $InStock;
        }

        return view('admin.baglog.Report',[
            'Data'=>$Data,
            'Konta'=>$Konta,
            'TotalInStock'=>$InStock,
            'InStock'=>$InStock2,
        ]);
    }

    public function  EditKartuKendali(Request $request){

        try {
            $TB = $newDate = date("y-m-d", strtotime($request['TanggalPembibitan']));
            $KodeProduksiRequest = $request['KodeProduksi'];
    
            if (substr($KodeProduksiRequest, 0, 4) === 'BLGN') {
                $result = 'BLGN';
            } elseif (substr($KodeProduksiRequest, 0, 4) === 'BLTP') {
                $result = 'BLTP';
            } else {
                $result = 'BL';
            }
            $KodeProduksi =  $result.$request['NoBatch'].$TB;
    
            Kartu_Kendali::where('id', $request['id'])->update([
                'KodeProduksi'=>$KodeProduksi,
                'TanggalPembibitan'=>$request['TanggalPembibitan'],
                'JumlahBaglog'=>$request['JumlahBaglog'],
                'Lokasi'=>$request['Lokasi'],
                'Status'=>$request['Status'],
                'TanggalBibit'=>$request['TanggalBibit'],
                'JumlahBibit'=>$request['JumlahBibit'],
                'KeteranganBibit'=>$request['KeteranganBibit'],
            ]);
    
            Details_Recipe::where('NoRecipe', $request['NoRecipe'])->update([
                'JenisBibit'=>$request['JenisBibit'],
            ]);
            return redirect(url('/admin/baglog/report'))->with('message', 'Data sudah di-update!');
        } catch (\Exception $e) {
            return redirect(url('/admin/baglog/report'))->with('message2', 'Message : '. $e->getMessage());
        }
 
    }


    public function DeleteKartuKendali($id){
        Kartu_Kendali::where('id', $id)->delete();
        return redirect(url('/admin/baglog/report'))->with('message', 'Data sudah dihapus!');
    }

    public function exportdata(Request $request){
        $Report = null;
        $Total = array();
        $Total['Produksi'] = 0;
        $Total['Kontaminasi'] = 0;
        $Total['SuccessRate'] = 0;


        if ($request['Submit'] == '1') {
            $Date1 = date('Y-m-d', strtotime($request['TanggalAwal']));
            $Date2 = date('Y-m-d', strtotime($request['TanggalAkhir']));
            $result = CarbonPeriod::create($Date1, $Date2);

            // $Report = Kartu_Kendali::whereBetween('TanggalPembibitan', [$Date1, $Date2])
            // ->orderBy('TanggalPembibitan', 'asc')->get();

            $Report = Kartu_Kendali::leftJoin('baglog_sterilisasi', 'baglog_kartu_kendali.SterilisasiID', '=', 'baglog_sterilisasi.id')
            ->leftJoin('baglog_mixing', 'baglog_mixing.id', '=', 'baglog_sterilisasi.MixingID')
            ->leftJoin('baglog_details_recipes', 'baglog_mixing.NoRecipe', '=', 'baglog_details_recipes.NoRecipe')
            ->whereBetween('baglog_kartu_kendali.TanggalPembibitan', [$Date1, $Date2])
            ->orderBy('baglog_kartu_kendali.TanggalPembibitan', 'asc')
            ->get();

            $Kontaminasi = Kontaminasi::all()->groupBy('KodeProduksi');

            foreach($Report as $data){
                $data['Kontaminasi'] = '0';
                $data['TanggalKontaminasi'] = '';
                if(isset($Kontaminasi[$data['KodeProduksi']])){
                    foreach($Kontaminasi[$data['KodeProduksi']] as $Konta){
                        $data['Kontaminasi'] = $data['Kontaminasi'] + $Konta['JumlahKontaminasi'];
                        $data['TanggalKontaminasi'] = $data['TanggalKontaminasi'].$Konta['Tanggal'].', ';
                    }
                }
                $data['InStock'] = $data['JumlahBaglog'] - $data['Kontaminasi'];
                if($data['JumlahBaglog'] != 0){
                    $data['ContaminationRate'] = $data['Kontaminasi']/$data['JumlahBaglog']*100;
                }
                else {
                    $data['ContaminationRate'] = 0;
                }
                
                $data['ContaminationRate'] = number_format($data['ContaminationRate'], 2);

                $data['MyleaOperator'] = MyleaBaglogPemakaian::where('KodeBaglog', $data['KodeProduksi'])->get();
                $data['MyleaAdmin'] = MyleaBaglog::where('KodeBaglog', $data['KodeProduksi'])->get();
    
                $data['CompositeOperator'] = CompositeBaglogPemakaian::where('KodeBaglog', $data['KodeProduksi'])->get();
                $data['CompositeAdmin'] = CompositeBaglog::where('KodeBaglog', $data['KodeProduksi'])->get();
    
                $data['PemakaianMylea'] = 0;
                $data['PemakaianComposite'] = 0;
                foreach($data['MyleaOperator'] as $DataMylea){
                   $data['PemakaianMylea'] =$data['PemakaianMylea'] + $DataMylea['Jumlah'];
                }
    
                foreach($data['CompositeOperator'] as $DataComposite){
                   $data['PemakaianComposite'] = $data['PemakaianComposite'] + $DataComposite['Jumlah'];
                }

                $Total['Produksi'] = $Total['Produksi'] + $data['JumlahBaglog'];
                $Total['Kontaminasi'] = $Total['Kontaminasi'] + $data['Kontaminasi'];
                $Total['SuccessRate'] = number_format(($Total['Produksi']-$Total['Kontaminasi'])/$Total['Produksi']*100, 2);
            }

        }

        return view('admin.baglog.ExportData', [
            'data' => $Report,
            'Resume' => $Total,
        ]);
    }

    public function BaglogMakingReport(Request $request){
        $Report = null;
        $Resume = array();
        $Resume['TotalBaglog'] = 0; $Resume['CaCO3'] = 0; $Resume['SKayu'] = 0;
        $Resume['Pollard'] = 0; $Resume['Tapioka'] = 0; $Resume['Air'] = 0; $Resume['KaliTerpakai'] = 0;

        if ($request['Submit'] == '1') {
            $Date1 = date('Y-m-d', strtotime($request['TanggalAwal']));
            $Date2 = date('Y-m-d', strtotime($request['TanggalAkhir']));

            $Report = Details_Recipe::whereBetween('TanggalKeluar', [$Date1, $Date2])
                ->orderBy('TanggalKeluar', 'asc')->get();
            
            
            foreach($Report as $data){
                $data['KaliTerpakai'] = Mixing::where('NoRecipe', $data['NoRecipe'])->count();
                $Mixing = Mixing::where('NoRecipe', $data['NoRecipe'])->get();
                $data['TanggalMixing'] = '';
                foreach($Mixing as $DataMixing){
                    $data['TanggalMixing'] = $data['TanggalMixing'].$DataMixing['TanggalMixing'].', ';
                }
                $Details = Bahan_Recipe::where('NoRecipe', $data['NoRecipe'])->get();
                if(isset($Details)){
                    $data['Bahan'] = $Details[0];
                }
                $Resume['TotalBaglog'] = $Resume['TotalBaglog'] + ($data['KaliTerpakai'] * $data['TotalBags']);
                $Resume['CaCO3'] = $Resume['CaCO3'] + ($data['KaliTerpakai'] * $data['Bahan']['CaCO3']);
                $Resume['SKayu'] = $Resume['SKayu'] + ($data['KaliTerpakai'] * $data['Bahan']['SKayu']);
                $Resume['Pollard'] = $Resume['Pollard'] + ($data['KaliTerpakai'] * $data['Bahan']['Pollard']);
                $Resume['Tapioka'] = $Resume['Tapioka'] + ($data['KaliTerpakai'] * $data['Bahan']['Tapioka']);
                $Resume['Air'] = $Resume['Air'] + ($data['KaliTerpakai'] * $data['Bahan']['Air']);
                $Resume['KaliTerpakai'] = $Resume['KaliTerpakai'] + $data['KaliTerpakai'];
            }

        }

        return view('admin.baglog.BaglogMakingReport', [
            'data' => $Report,
            'Resume' => $Resume,
        ]);
    }


    public function datamixing(){
        $Data = Mixing::orderby('TanggalMixing', 'desc')->paginate(15);
        return view('admin.baglog.DataMixing', [
            'Data'=>$Data,
        ]);
    }

    public function formeditmixing($id){
        $Data = Mixing::all()->where('id', '=', $id);
        return view('admin.baglog.EditMixing', [
            'Data'=>$Data,
        ]); 
    }

    public function submiteditmixing(Request $request){
        $update = [
            'NoRecipe'=>$request['NoRecipe'],
            'TanggalMixing'=>$request['TanggalMixing'],
            'Keterangan'=>$request['Keterangan'],
        ];

        Mixing::where('id', $request['id'])->update($update);

        $Data = Mixing::orderby('TanggalMixing', 'desc')->paginate(15);
        return view('admin.baglog.DataMixing', [
            'Data'=>$Data,
        ]);
    }

    public function deletemixing($id){
        Mixing::where('id', $id)->delete();

        $Data = Mixing::orderby('TanggalMixing', 'desc')->paginate(15);
        return view('admin.baglog.DataMixing', [
            'Data'=>$Data,
        ]);
    }

    public function datasterilisasi(){
        $Data = Sterilisasi::orderby('TanggalSterilisasi', 'desc')->paginate(15);
        return view('admin.baglog.DataSterilisasi', [
            'Data'=>$Data,
        ]);
    }

    public function formeditsterilisasi($id){
        $Data = Sterilisasi::all()->where('id', '=', $id);
        return view('admin.baglog.EditSterilisasi', [
            'Data'=>$Data,
        ]);     
    }

    public function submiteditsterilisasi(Request $request){
        $update = [
            'TanggalSterilisasi'=>$request['TanggalSterilisasi'],
            'NoBatch'=>$request['NoBatch'],
            'JenisAutoclave'=>$request['JenisAutoclave'],
            'NoRecipe'=>$request['NoRecipe'],
            'Jumlah'=>$request['Jumlah'],
            'Keterangan'=>$request['Keterangan'],
        ];

        Sterilisasi::where('id', $request['id'])->update($update);

        $Data = Sterilisasi::orderby('TanggalSterilisasi', 'desc')->paginate(15);
        return view('admin.baglog.DataSterilisasi', [
            'Data'=>$Data,
        ]);
    }

    public function deletesterilisasi($id){
        Sterilisasi::where('id', $id)->delete();

        $Data = Sterilisasi::orderby('TanggalSterilisasi', 'desc')->paginate(15);
        return view('admin.baglog.DataSterilisasi', [
            'Data'=>$Data,
        ]);
    }

    public function konta($KodeProduksi){
        $Konta = Kontaminasi::all()->where('KodeProduksi', '=', $KodeProduksi);
        return view('admin.baglog.Kontaminasi',[
            'Konta'=>$Konta,
        ]);
    }

    public function kontaform($KodeProduksi){
        return view('admin.baglog.AddKontaminasi', [
            'KodeProduksi' => $KodeProduksi,
        ]);
    }

    public function addkonta(Request $request){
        Kontaminasi::create([
            'KodeProduksi'=>$request['KodeProduksi'],
            'JumlahKontaminasi'=>$request['JumlahKontaminasi'],
            'Tanggal'=>$request['Tanggal'],
            'Keterangan'=>$request['Keterangan'],
        ]);

        return redirect (url('admin/baglog/report'))->with('message', 'Data has been saved!');
    }

    public function EditKonta(Request $request){
        Kontaminasi::where('id', $request['id'])->update([
            'KodeProduksi'=>$request['KodeProduksi'],
            'JumlahKontaminasi'=>$request['JumlahKontaminasi'],
            'Tanggal'=>$request['Tanggal'],
            'Keterangan'=>$request['Keterangan'],
        ]);

        return redirect(url('admin/baglog/report/'.$request['KodeProduksi']))->with('message', 'Data sudah di-update!');
    }

    public function deletekonta($id){
        Kontaminasi::where('id', '=', $id)->delete();

        $Data = Kartu_Kendali::orderBy('KodeProduksi', 'desc')->paginate(15);
        $Konta = Kontaminasi::all()->groupBy('KodeProduksi');
        $JumlahKonta = '0';
        return view('admin.baglog.Report',[
            'Data'=>$Data,
            'Konta'=>$Konta,
            'JumlahKonta'=>$JumlahKonta,
        ]);
    }

    public function UjiCobaCreate(Request $request){
        UjiCoba::create([
            'BaglogID'=>$request['BaglogID'],
            'Jumlah'=>$request['Jumlah'],
            'Tanggal'=>$request['Tanggal'],
            'Keterangan'=>$request['Keterangan'],
        ]);
        return redirect (url('admin/baglog/report'))->with('message', 'Data has been saved!');
    }
    public function UjiCobaDelete($id){
        UjiCoba::where('id', $id)->delete();
        return redirect(url('/admin/baglog/report'))->with('message2', 'Data sudah dihapus!');
    }
}