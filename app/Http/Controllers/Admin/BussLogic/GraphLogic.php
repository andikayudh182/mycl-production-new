<?php

namespace App\Http\Controllers\Admin\BussLogic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\baglog\baglogrecipe;
use App\Models\baglog\Bahan_Recipe;
use App\Models\baglog\Details_Recipe;
use App\Models\baglog\Kartu_Kendali;
use App\Models\baglog\Kontaminasi;
use App\Models\baglog\Mixing;
use App\Models\baglog\Sterilisasi;
use App\Models\Mylea\MyleaBaglogPemakaian;
use App\Models\Mylea\MyleaBaglog;
use App\Models\Mylea\MyleaProduction;
use App\Models\Mylea\MyleaReminder;
use App\Models\Mylea\MyleaKonta;
use App\Models\Mylea\MyleaHarvest;
use App\Models\Composite\CompositeBaglog;
use App\Models\Composite\CompositeProduction;
use App\Models\Composite\CompositeReminder;
use App\Models\Composite\CompositeBaglogPemakaian;
use App\Models\Composite\CompositeKontaminasi;
use App\Models\Composite\CompositeHarvest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GraphLogic
{
    public function BaglogYearlyGraph(){
        $date = Carbon::now();
        $date->toDateString();
        $Data = Kartu_Kendali::orderBy('TanggalPembibitan', 'desc')->whereYear('TanggalPembibitan', $date)->get();
        $RetDat = array();
        $DataPoint = array();
        $DataPoint2 = array();
        $DataPoint3 = array();
        if(isset($Data)){
            //kontaminasi
            foreach($Data as $data){
                $Kontaminasi = Kontaminasi::where('KodeProduksi', $data['KodeProduksi'])->get();
                $data['JumlahKonta'] = 0;
                foreach($Kontaminasi as $DataKonta){
                    $data['JumlahKonta'] = $data['JumlahKonta'] + $DataKonta['JumlahKontaminasi'];
                }
            }

            for($i = 1; $i < 13; $i++){
                $produksi = 0;
                $kontaminasi = 0;
                $j = 0;

                foreach($Data as $data){
                    $TanggalPembibitan = $data['TanggalPembibitan'];
                    $Kontaminasi = Kontaminasi::where('KodeProduksi', $data['KodeProduksi'])->get();

                    if(substr($TanggalPembibitan, 5, 2) == $i){
                        $produksi = $produksi + $data['JumlahBaglog'];
                        $kontaminasi = $kontaminasi + $data['JumlahKonta'];
                        $j++;
                    }

                }
                $DataPoint[$i] = $produksi; 
                $DataPoint2[$i] = $kontaminasi;
                if(!($produksi == 0)){
                    $DataPoint3[$i]= round($kontaminasi/$produksi*100, 2);
                } else{
                    $DataPoint3[$i]= 0;
                }

            }

        }
        $RetDat['DataPoint'] = $DataPoint; //Data Produksi Baglog
        $RetDat['DataPoint2'] = $DataPoint2; //Data Jumlah Konta
        $RetDat['DataPoint3'] = $DataPoint3; //Data Persentase Konta
        return $RetDat;
    }

    public function MyleaYearlyGraph(){
        $date = Carbon::now();
        $date->toDateString();
        $Data = MyleaProduction::orderBy('TanggalProduksi', 'desc')->whereYear('TanggalProduksi', $date)->get();
        $RetDat = array();
        $DataPoint = array();
        $DataPoint2 = array();
        $DataPoint3 = array();
        if(isset($Data)){
            //kontaminasi
            foreach($Data as $data){
                $Kontaminasi = MyleaKonta::where('KodeProduksi', $data['KodeProduksi'])->get();
                $data['JumlahKonta'] = 0;
                foreach($Kontaminasi as $DataKonta){
                    $data['JumlahKonta'] = $data['JumlahKonta'] + $DataKonta['Jumlah'];
                }
            }

            for($i = 1; $i < 13; $i++){
                $produksi = 0;
                $kontaminasi = 0;
                $j = 0;

                foreach($Data as $data){
                    $TanggalProduksi = $data['TanggalProduksi'];

                    if(substr($TanggalProduksi, 5, 2) == $i){
                        $produksi = $produksi + $data['JumlahBaglog'];
                        $kontaminasi = $kontaminasi + $data['JumlahKonta'];
                        $j++;
                    }

                }
                $DataPoint[$i] = $produksi; 
                $DataPoint2[$i] = $kontaminasi;
                if(!($produksi == 0)){
                    $DataPoint3[$i]= round($kontaminasi/$produksi*100, 2);
                } else{
                    $DataPoint3[$i]= 0;
                }

            }

        }
        $RetDat['DataPoint'] = $DataPoint; //Data Produksi Baglog
        $RetDat['DataPoint2'] = $DataPoint2; //Data Jumlah Konta
        $RetDat['DataPoint3'] = $DataPoint3; //Data Persentase Konta
        return $RetDat;
    }

    public function CompositeYearlyGraph(){
        $date = Carbon::now();
        $date->toDateString();
        $Data = CompositeProduction::orderBy('TanggalProduksi', 'desc')->whereYear('TanggalProduksi', $date)->get();
        $RetDat = array();
        $DataPoint = array();
        $DataPoint2 = array();
        $DataPoint3 = array();
        if(isset($Data)){
            //kontaminasi
            foreach($Data as $data){
                $Kontaminasi = CompositeKontaminasi::where('KodeProduksi', $data['KodeProduksi'])->get();
                $data['JumlahKonta'] = 0;
                foreach($Kontaminasi as $DataKonta){
                    $data['JumlahKonta'] = $data['JumlahKonta'] + $DataKonta['Jumlah'];
                }
            }

            for($i = 1; $i < 13; $i++){
                $produksi = 0;
                $kontaminasi = 0;
                $j = 0;

                foreach($Data as $data){
                    $TanggalProduksi = $data['TanggalProduksi'];

                    if(substr($TanggalProduksi, 5, 2) == $i){
                        $produksi = $produksi + $data['JumlahBaglog'];
                        $kontaminasi = $kontaminasi + $data['JumlahKonta'];
                        $j++;
                    }

                }
                $DataPoint[$i] = $produksi; 
                $DataPoint2[$i] = $kontaminasi;
                if(!($produksi == 0)){
                    $DataPoint3[$i]= round($kontaminasi/$produksi*100, 2);
                } else{
                    $DataPoint3[$i]= 0;
                }

            }

        }
        $RetDat['DataPoint'] = $DataPoint; //Data Produksi Baglog
        $RetDat['DataPoint2'] = $DataPoint2; //Data Jumlah Konta
        $RetDat['DataPoint3'] = $DataPoint3; //Data Persentase Konta
        return $RetDat;
    }
}