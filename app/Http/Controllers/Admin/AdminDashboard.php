<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BussLogic\GraphLogic;
use App\Models\baglog\Kartu_Kendali;
use App\Models\baglog\Kontaminasi;
use App\Models\Mylea\MyleaProduction;
use App\Models\Mylea\MyleaReminder;
use App\Models\baglog\Mixing;
use App\Models\Mylea\MyleaKonta;
use App\Models\Composite\CompositeProduction;
use App\Models\Composite\CompositeBaglog;
use App\Models\Composite\CompositeReminder;
use App\Models\Composite\CompositeKontaminasi;
use App\Models\PostTreatment\QualityControl1;
use App\Models\PostTreatment\QualityControl2;
use App\Models\Biobo\Harvest;
use App\Models\Biobo\PT1;
use App\Models\Biobo\PT2;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminDashboard extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $mixing = Mixing::all();
        $kartukendali = Kartu_Kendali::orderBy('TanggalPembibitan', 'asc')->get();
        $OrderMylea = MyleaProduction::orderBy('TanggalProduksi', 'asc')->get();
        $MyleaProduction = MyleaProduction::orderBy('TanggalProduksi', 'asc')->get();
        $PostTreatment = QualityControl2::orderBy('FinishDate', 'asc')->get();
        $QualityControl1 = QualityControl1::where('Status', '=' , Null)->get();
        $MyleaReminder = MyleaReminder::all();
        $BioboProduction = Harvest::orderBy('TanggalProduksi', 'asc')->get();
        $PT1 = PT1::all()->where('TanggalPressing', '=', null);
        $PT2 = PT2::all()->where('TanggalCutting', '=', null);

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

        //data baglog
        foreach($kartukendali as $data){
            $data['Kontaminasi'] = 0;
            $data['TanggalQC'] = date('Y-m-d', strtotime($data['TanggalPembibitan']. ' + 14 days'));
            $kontaminasi = Kontaminasi::where('KodeProduksi', $data['KodeProduksi'])->get();
            foreach($kontaminasi as $KontaBaglog){
                $data['Kontaminasi'] = $data['Kontaminasi'] + $KontaBaglog['JumlahKontaminasi'];
            }
            $data['InStock'] = $data['JumlahBaglog'] - $data['Kontaminasi'];
        }

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
        
        return view('admin.dashboard', [
            'mixing' => $mixing,
            'Composite' => $CompositeProductionAll,
            'kartukendali'=>$kartukendali,
            'OrderMylea'=>$OrderMylea,
            'OrderComposite'=>$OrderComposite,
            'BaglogComposite'=>$BaglogComposite,
            'MyleaProduction'=>$MyleaProduction,
            'MyleaReminder'=>$MyleaReminder,
            'PostTreatment'=>$PostTreatment,
            'QualityControl1'=>$QualityControl1,
            'BioboProduction'=>$BioboProduction,
            'BioboPT1'=>$PT1,
            'BioboPT2'=>$PT2,
        ]);
    }

    public function baglog()
    {
        $date = Carbon::now();
        $date->toDateString();
        $kartukendali = Kartu_Kendali::orderBy('TanggalPembibitan', 'asc')->whereMonth('TanggalPembibitan', $date)->get();
        $kontaminasi = Kontaminasi::orderBy('Tanggal', 'asc')->get();
        $GraphData = new GraphLogic();
        $Data = $GraphData->BaglogYearlyGraph();
        return view('admin.baglog.index', [
            'kartukendali'=>$kartukendali,
            'kontaminasi'=>$kontaminasi,
            'Data' => $Data
        ]);
    }

    public function mylea()
    {
        $date = Carbon::now();
        $date->toDateString();
        $MyleaProduction = MyleaProduction::orderBy('TanggalProduksi', 'asc')->whereMonth('TanggalProduksi', $date)->get();
        $MyleaKonta = MyleaKonta::orderBy('TanggalKonta', 'desc')->get();
        $GraphData = new GraphLogic();
        $Data = $GraphData->MyleaYearlyGraph();
        return view('admin.mylea.Index', [
            'MyleaProduction'=>$MyleaProduction,
            'MyleaKonta'=>$MyleaKonta,
            'Data' => $Data,
        ]);
    }

    public function biobo()
    {
        $date = Carbon::now();
        $date->toDateString();
        $BioboProduction = Harvest::orderBy('TanggalProduksi', 'asc')->whereMonth('TanggalProduksi', $date)->get();
        return view('admin.biobo.Index', [
            'BioboProduction'=>$BioboProduction,
        ]);
    }

    public function composite(){
        $date = Carbon::now();
        $date->toDateString();
        $GraphData = new GraphLogic();
        $Data = $GraphData->CompositeYearlyGraph();
        return view('admin.composite.Index',[
            'Data' => $Data,
        ]);
    }

}
