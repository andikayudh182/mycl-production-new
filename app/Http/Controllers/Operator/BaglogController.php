<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\baglog\Details_Recipe;
use App\Models\baglog\Bahan_Recipe;
use App\Models\baglog\Mixing;
use App\Models\baglog\Sterilisasi;
use App\Models\baglog\Kartu_Kendali;
use App\Models\baglog\Kontaminasi;
use App\Models\baglog\UjiCoba;
use App\Models\Mylea\MyleaBaglogPemakaian;
use App\Models\Mylea\MyleaBaglog;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BaglogController extends Controller
{
    public function baglog(){
        $date = Carbon::now();
        $date->toDateString();
        $kartukendali = Kartu_Kendali::orderBy('TanggalPembibitan', 'asc')->get();
        $chart = Kartu_Kendali::orderBy('TanggalPembibitan', 'asc')->whereMonth('TanggalPembibitan', $date)->get();
        $kontaminasi = Kontaminasi::orderBy('Tanggal', 'asc')->get();
        $mixing = Mixing::all();

        foreach($kartukendali as $data){
            $data['Kontaminasi'] = 0;
            $data['TanggalQC'] = date('Y-m-d', strtotime($data['TanggalPembibitan']. ' + 14 days'));
            $kontaminasi = Kontaminasi::where('KodeProduksi', $data['KodeProduksi'])->get();
            foreach($kontaminasi as $KontaBaglog){
                $data['Kontaminasi'] = $data['Kontaminasi'] + $KontaBaglog['JumlahKontaminasi'];
            }
            $data['InStock'] = $data['JumlahBaglog'] - $data['Kontaminasi'];
        }

        return view('operator.baglog.BaglogIndex', [
            'kartukendali'=>$kartukendali,
            'kontaminasi'=>$kontaminasi,
            'mixing'=>$mixing,
            'chart'=>$chart,
        ]);
    }

    public function ProduksiBaglog1(){
        $OrderMixing = Mixing::orderBy('TanggalMixing', 'asc')->get();
        foreach($OrderMixing as $data){
            if($data['Status']=='0'){
                $data['StatusOrder'] = 'Belum di mixing';
            } 
            else if($data['Status']=='1' && $data['StatusSterilisasi']==NULL)
            {
                $data['StatusOrder'] = 'Menunggu proses sterilisasi';
            }
            $data['Details'] = Details_Recipe::where('NoRecipe', $data['NoRecipe'])->get()->first();
            if(!$data['Details']) echo "no user found".$data['NoRecipe'].$data['id'];
        }
        return view ('operator.baglog.ProduksiBaglog1', [
            'OrderMixing' => $OrderMixing, 
        ]);
    }

    public function mixing(){
        $OrderMixing = Mixing::all();
        return view ('operator.baglog.Mixing', [
            'OrderMixing' => $OrderMixing, 
        ]);
    }

    public function mixingdetails($NoRecipe){
        $Bahan = Bahan_Recipe::all()->where('NoRecipe', '=', $NoRecipe);
        $Detail = Details_Recipe::all()->where('NoRecipe', '=', $NoRecipe);
        return view ('operator.baglog.DetailMixing', [
            'Detail' => $Detail, 
            'Bahan' => $Bahan,
        ]);
    }

    public function updatemixingstatus(Request $request, $id){
        $update = Mixing::find($id);

        if($update){
            $update->status = '1';
            $update->Keterangan = $request['Keterangan'];
            $update->save();
        }
        $OrderMixing = Mixing::all();
        return redirect(url('/operator/baglog/produksi-baglog-1'))->with('message', 'Data Telah Di Update!');
    }

    public function sterilisasi(){
        $NoRecipe = Details_Recipe::all();

        return view('operator.baglog.Sterilisasi', [
            'NoRecipe' => $NoRecipe,
        ]);
    }

    public function submitsterilisasi(Request $request){
        $user_id = Auth::user()->id;
        Sterilisasi::create([
            'UserID'=>$user_id,
            'MixingID'=> $request['MixingID'],
            'TanggalSterilisasi' => $request['Tanggal'],
            'NoBatch'  => $request['NoBatch'],
            'JenisAutoclave'  => $request['JenisAutoclave'],
            'NoRecipe'  => $request['NoRecipe'],
            'Jumlah'  => $request['Jumlah'],
            'Keterangan'=> $request['Keterangan'],
            'Status' => '0',
        ]);
        $update = Mixing::find($request['MixingID']);

        if($update){
            $update->StatusSterilisasi = '1';
            $update->save();
        }
        return  redirect(url('/operator/baglog/produksi-baglog-1'))->with('message', 'Data Telah Di Update!');
    }

    public function pembibitan(){
        $Pembibitan = Sterilisasi::all()
                            ->groupBy(['TanggalSterilisasi', 'NoBatch']);
        return view('operator.baglog.Pembibitan', [
            'Pembibitan' => $Pembibitan,
        ]);
    }

    public function startpembibitan($TanggalSterilisasi, $NoBatch, $Jumlah, $sterilisasi_id){
      
        //  $JenisBibit= Sterilisasi::where('baglog_sterilisasi.id', $sterilisasi_id)
        //             ->leftJoin('baglog_mixing', 'baglog_sterilisasi.MixingID', '=', 'baglog_mixing.id')
        //             ->leftJoin('baglog_details_recipes', 'baglog_details_recipes.NoRecipe', '=', 'baglog_mixing.NoRecipe')
        //             ->select('baglog_details_recipes.JenisBibit')
        //             ->get();
        return view('operator.baglog.FormPembibitan', [
            'TanggalSterilisasi'=>$TanggalSterilisasi,
            'NoBatch'=>$NoBatch,
            'Jumlah'=>$Jumlah,
            'sterilisasi_id'=>$sterilisasi_id,
            // 'JenisBibit'=>$JenisBibit[0]->JenisBibit,
        ]);
    }

    public function submitpembibitan(Request $request){
        $user_id = Auth::user()->id;
        $TanggalCrushing = date('Y-m-d', strtotime($request['TanggalPembibitan']. ' + 7 days'));
        $TanggalHarvest = date('Y-m-d', strtotime($request['TanggalPembibitan']. ' + 21 days'));
        $TB = $newDate = date("y-m-d", strtotime($request['TanggalPembibitan']));

        $JenisBibitQuery= Sterilisasi::where('baglog_sterilisasi.id', $request['SterilisasiID'])
                    ->leftJoin('baglog_mixing', 'baglog_sterilisasi.MixingID', '=', 'baglog_mixing.id')
                    ->leftJoin('baglog_details_recipes', 'baglog_details_recipes.NoRecipe', '=', 'baglog_mixing.NoRecipe')
                    ->select('baglog_details_recipes.JenisBibit')
                    ->get();
        $JenisBibit = $JenisBibitQuery[0]->JenisBibit;
        $KodeProduksi =  "BL".$JenisBibit.$request['NoBatch'].$TB;

        Kartu_Kendali::create([
            'SterilisasiID'=>$request['SterilisasiID'],
            'UserID'=>$user_id,
            'KodeProduksi'=>$KodeProduksi,
            'TanggalPembibitan'=>$request['TanggalPembibitan'],
            'TanggalCrushing'=>$TanggalCrushing,
            'TanggalHarvest'=>$TanggalHarvest,
            'JumlahBaglog'=>$request['JumlahBaglog'],
            'Keterangan'=>$request['Keterangan'],
            'Lokasi'=>$request['Lokasi'],
            'Status'=>'0',
            'TanggalBibit'=>$request['TanggalBibit'],
            'JumlahBibit'=>$request['JumlahBibit'],
            'KeteranganBibit'=>$request['KeteranganBibit'],
        ]);

        Sterilisasi::where(['TanggalSterilisasi'=>$request['TanggalSterilisasi'], 'NoBatch'=>$request['NoBatch']])
        ->update(['Status'=>'1',]);
        
        return redirect(url('/operator/baglog/qcbaglog'));
    }

    public function qcbaglog(){
        $Data = Kartu_Kendali::orderBy('TanggalPembibitan', 'desc')->get();
        $Kontaminasi = Kontaminasi::all()->groupBy('KodeProduksi');
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

            $data['UjiCoba'] = UjiCoba::where('BaglogID', $data['id'])->get();
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
            $data['Pemakaian'] = 0;
            foreach($data['MyleaAdmin'] as $DataMylea){
                $data['Pemakaian'] = $data['Pemakaian'] + $DataMylea['Jumlah'];
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
        }
        return view('operator.baglog.QCBaglog', [
            'KartuKendali' => $Data,
            'Kontaminasi' => $Kontaminasi,
        ]);
    }

    public function kontaminasi($KodeProduksi){
        return view('operator.baglog.Kontaminasi', [
            'KodeProduksi' => $KodeProduksi,
        ]);
    }

    public function datakontaminasi($KodeProduksi){
        $data = Kontaminasi::where('KodeProduksi', '=', $KodeProduksi)->get();
        return view('operator.baglog.DataKonta', [
            'data' => $data,
        ]);
    }

    public function deletekonta($id){
        Kontaminasi::where('id', '=', $id)->delete();

        return redirect(url('/operator/baglog/qcbaglog'));
    }

    public function submitkontaminasi(Request $request){
        Kontaminasi::create([
            'KodeProduksi'=>$request['KodeProduksi'],
            'JumlahKontaminasi'=>$request['JumlahKontaminasi'],
            'Tanggal'=>$request['Tanggal'],
            'Keterangan'=>$request['Keterangan'],
        ]);

        return redirect(url('/operator/baglog/qcbaglog'));
    }

    public function submitkartukendali($KodeProduksi){
        Kartu_Kendali::where(['KodeProduksi'=>$KodeProduksi])
        ->update(['Status'=>'1']);
        $KartuKendali = Kartu_Kendali::all();
        return redirect(url('/operator/baglog/qcbaglog'));
    }
}
