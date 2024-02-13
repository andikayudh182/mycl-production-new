<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mylea\MyleaHarvest;
use App\Models\PostTreatment\QualityControl1;
use App\Models\PostTreatment\MPT1;
use App\Models\PostTreatment\MPT2;
use App\Models\PostTreatment\MPT3;
use App\Models\PostTreatment\MPT4;
use App\Models\PostTreatment\QualityDetails;
use App\Models\PostTreatment\QualityControl2;
use App\Models\PostTreatment\QualityDetails2;

class PostTreatmentController extends Controller
{
    public function index(){
        return view('operator.mylea.PostTreatment.Index');
    }

    public function qc1(){
        $Mylea = array();
        $PanenMylea = MyleaHarvest::groupBy('KodeProduksi')
        ->groupBy('JenisPanen')
        ->select(['KodeProduksi', 'JenisPanen'])
        ->selectRaw("SUM(Passed) as GradeA")
        ->selectRaw("SUM(Reject) as GradeE")->get();

        foreach($PanenMylea as $DataMylea){
            $Pemakaian = QualityControl1::where('KPMylea', $DataMylea['KodeProduksi'])
            ->where('JenisMylea', $DataMylea['JenisPanen'])
            ->groupBy('KPMylea')
            ->selectRaw("SUM(GradeA) as GradeA")
            ->selectRaw("SUM(GradeE) as GradeE")->get();

            if(isset($Pemakaian[0])){
                $DataMylea['GradeA'] -= $Pemakaian[0]['GradeA'];
                $DataMylea['GradeE'] -= $Pemakaian[0]['GradeE'];
            }
        }

        return view('operator.mylea.PostTreatment.QualityControl1',[
            'Mylea' => $PanenMylea,
        ]);
    }

    public function submitqc1(Request $request){
        $request->validate([
            'ArrivalDate'=>'required',
            'JenisMylea',
            'GradeA'=>'required',
            'GradeE'=>'required',
        ]);

        $KodeProduksi = '';
        $DataMylea = explode(",",$request['KodeMylea']);
        $ArrivalDate = $request['ArrivalDate'];
        $JenisMylea = $DataMylea[1];
        $TB = $newDate = date("d-m-y", strtotime($ArrivalDate));
        $GradeA = $request['GradeA'];
        $GradeE = $request['GradeE'];
        if($JenisMylea == "Konta") {
            $KodeProduksi =  "MYPT_K".$TB;
        } elseif ($JenisMylea == "Normal"){
            $KodeProduksi =  "MYPT_N".$TB;
        }

        QualityControl1::create([
            'KodeProduksi'=>$KodeProduksi,
            'ArrivalDate'=>$ArrivalDate,
            'KPMylea'=>$DataMylea[0],
            'JenisMylea'=>$JenisMylea,
            'GradeA'=>$GradeA,
            'GradeE'=>$GradeE,
        ]);

        MPT1::create([
            'KodeProduksi'=>$KodeProduksi,
        ]);

        return redirect(url('/operator/mylea/post-treatment/qc1'));
    }

    public function monitoring(){
        $QualityControl1 = QualityControl1::all()->where('Status', NULL);
        return view('operator.mylea.PostTreatment.Monitoring', [
            'QualityControl1' => $QualityControl1,
        ]);
    }

    public function mpt1($KodeProduksi){
        $MPT1 = MPT1::all()->where('KodeProduksi', $KodeProduksi);

        return view('operator.mylea.PostTreatment.MPT1', [
            'MPT1' => $MPT1,
        ]);
    }

    public function mpt1reportsubmit($id, $case){
        date_default_timezone_set("Asia/Jakarta");
        $Tanggal = date("Y-m-d");
        $KodeProduksi = MPT1::where('id',$id)->get();

        switch($case){
            case "Washing":
                MPT1::where('id', $id)->update([
                    'StatusWashing'=> '1',
                    'TanggalWashing'=> $Tanggal,
                ]);
                break;
            case "Pengerikan":
                MPT1::where('id', $id)->update([
                    'StatusPengerikan'=> '1',
                    'TanggalPengerikan'=> $Tanggal,
                ]);
                break;
            case "ScoringDyeing":
                MPT1::where('id', $id)->update([
                    'StatusScoringDyeing'=> '1',
                    'TanggalScoringDyeing'=> $Tanggal,
                ]);
                break;
            case "WashingDrying":
                MPT1::where('id', $id)->update([
                    'StatusWashingDrying'=> '1',
                    'TanggalWashingDrying'=> $Tanggal,
                ]);
                break;
            case "WashingDrying":
                MPT1::where('id', $id)->update([
                    'StatusWashingDrying'=> '1',
                    'TanggalWashingDrying'=> $Tanggal,
                ]);
                break;
            case "PEGDrying":
                MPT1::where('id', $id)->update([
                    'StatusPEGDrying'=> '1',
                    'TanggalPEGDrying'=> $Tanggal,
                ]);
                break;
        }

        return redirect(url('/operator/mylea/post-treatment/mpt1/'.$KodeProduksi[0]['KodeProduksi']));
    }

    public function mpt2($KodeProduksi){
        $QC1 =  QualityControl1::all()->where('KodeProduksi', $KodeProduksi);
        $QDetails = QualityDetails::all()->where('KodeProduksi', $KodeProduksi);
        return view('operator.mylea.PostTreatment.MPT2', [
            'QC1' => $QC1,
            'QDetails'=>$QDetails,
        ]);
    }


    public function mpt2submit($KodeProduksi, Request $request){
        $request->validate([
            'Jumlah'=>'Required',
        ]);

        $id = QualityDetails::create([
            'KodeProduksi'=>$KodeProduksi,
            'KategoriReinforce'=>$request['KategoriReinforce'],
            'Warna'=>$request['Warna'],
            'Grade'=>$request['Grade'],
            'Jumlah'=>$request['Jumlah'],
        ])->id;

        MPT2::create([
            'KodeProduksi'=>$KodeProduksi,
            'Grade'=>$request['Grade'],
            'id'=>$id,
        ]);

        MPT3::create([
            'KodeProduksi'=>$KodeProduksi,
            'Grade'=>$request['Grade'],
            'id'=>$id
        ]);

        MPT4::create([
            'KodeProduksi'=>$KodeProduksi,
            'Grade'=>$request['Grade'],
            'id'=>$id,
        ]);

        $QC1 =  QualityControl1::all()->where('KodeProduksi', $KodeProduksi);
        $QDetails = QualityDetails::all()->where('KodeProduksi', $KodeProduksi);
        return view('operator.mylea.PostTreatment.MPT2', [
            'QC1' => $QC1,
            'QDetails'=>$QDetails,
        ]);
    }

    public function mpt2report($id){
        $MPT2 = MPT2::where('id', $id)->get();
        $Details = QualityDetails::where('id', $id)->get();

        return view('operator.mylea.PostTreatment.MPT2Report', [
            'MPT2'=>$MPT2,
            'Details'=>$Details,
        ]);
    }

    public function mpt2reportsubmit($id, $case){
        date_default_timezone_set("Asia/Jakarta");
        $Tanggal = date("Y-m-d");

        switch($case){
            case "ReinforceDrying":
                MPT2::where('id', $id)->update([
                    'StatusReinforceDrying'=> '1',
                    'TanggalReinforceDrying'=> $Tanggal,
                ]);
                break;
        }

        $MPT2 = MPT2::where('id', $id)->get();
        $MPT2Details = QualityDetails::where('id', $id)->get();

        return view('operator.mylea.PostTreatment.MPT2Report', [
            'MPT2'=>$MPT2,
            'Details'=>$MPT2Details,
        ]);
    }

    public function mpt3($KodeProduksi){
        $QC1 =  QualityControl1::all()->where('KodeProduksi', $KodeProduksi);
        $QDetails = QualityDetails::all()->where('KodeProduksi', $KodeProduksi);
        return view('operator.mylea.PostTreatment.MPT3', [
            'QC1' => $QC1,
            'QDetails'=>$QDetails,
        ]);
    }

    public function mpt3report($id){
        $MPT3 = MPT3::where('id', $id)->get();
        $Details = QualityDetails::where('id', $id)->get();

        return view('operator.mylea.PostTreatment.MPT3Report', [
            'MPT3'=>$MPT3,
            'Details'=>$Details,
        ]);
    }

    public function mpt3reportsubmit($id, $case){
        date_default_timezone_set("Asia/Jakarta");
        $Tanggal = date("Y-m-d");

        switch($case){
            case "Pengeringan":
                MPT3::where('id', $id)->update([
                    'StatusPengeringan3'=> '1',
                    'TanggalPengeringan3'=> $Tanggal,
                ]);
                break;
            case "Pressing":
                MPT3::where('id', $id)->update([
                    'StatusPressing'=> '1',
                    'TanggalPressing'=> $Tanggal,
                ]);
                break;
        }

        $MPT3 = MPT3::where('id', $id)->get();
        $Details = QualityDetails::where('id', $id)->get();

        return view('operator.mylea.PostTreatment.MPT3Report', [
            'MPT3'=>$MPT3,
            'Details'=>$Details,
        ]);
    }

    public function mpt4($KodeProduksi){
        $QC1 =  QualityControl1::all()->where('KodeProduksi', $KodeProduksi);
        $QDetails = QualityDetails::all()->where('KodeProduksi', $KodeProduksi);
        return view('operator.mylea.PostTreatment.MPT4', [
            'QC1' => $QC1,
            'QDetails'=>$QDetails,
        ]);
    }

    public function mpt4report($id){
        $MPT4 = MPT4::where('id', $id)->get();
        $Details = QualityDetails::where('id', $id)->get();

        return view('operator.mylea.PostTreatment.MPT4Report', [
            'MPT4'=>$MPT4,
            'Details'=>$Details,
        ]);
    }

    public function mpt4reportsubmit($id, $case){
        date_default_timezone_set("Asia/Jakarta");
        $Tanggal = date("Y-m-d");

        switch($case){
            case "Cutting":
                MPT4::where('id', $id)->update([
                    'StatusCutting'=> '1',
                    'TanggalCutting'=> $Tanggal,
                ]);
                break;
            case "CoatingPigmen":
                MPT4::where('id', $id)->update([
                    'StatusCoatingPigmen'=> '1',
                    'TanggalCoatingPigmen'=> $Tanggal,
                ]);
                break;
            case "Pengeringan4":
                MPT4::where('id', $id)->update([
                    'StatusPengeringan4'=> '1',
                    'TanggalPengeringan4'=> $Tanggal,
                ]);
                break;
        }

        $MPT4 = MPT4::where('id', $id)->get();
        $Details = QualityDetails::where('id', $id)->get();

        return view('operator.mylea.PostTreatment.MPT4Report', [
            'MPT4'=>$MPT4,
            'Details'=>$Details,
        ]);
    }

    public function qc2(){
        $QC1 =  QualityControl1::all()->where('Status',null);

        return view('operator.mylea.PostTreatment.QualityControl2', [
            'QC1'=>$QC1,
        ]);
    }

    public function qc2form($KodeProduksi){
        $DataPT = QualityDetails::where('KodeProduksi', $KodeProduksi)->get();
        return view('operator.mylea.PostTreatment.QualityControl2Form', [
            'KodeProduksi'=>$KodeProduksi,
            'DataPT' => $DataPT,
        ]);
    }

    public function qc2formsubmit (Request $request){
        $request->validate([
            'FinishDate'=> 'Required',
        ]);

        $Jumlah = '0';
        foreach($request->data as $key => $value){
            QualityDetails2::create([
                'KodeProduksi'=>$request['KodeProduksi'],
                'Grade'=>$value['Grade'],
                'KategoriReinforce'=>$value['KategoriReinforce'],
                'Warna'=>$value['Warna'],
                'Jumlah'=>$value['Jumlah'],
                'Ukuran'=>$value['Ukuran'],
            ]);
            $Jumlah = $Jumlah + $value['Jumlah'];
        }

        QualityControl2::create([
            'KodeProduksi'=>$request['KodeProduksi'],
            'FinishDate'=>$request['FinishDate'],
            'Jumlah'=>$Jumlah,
        ]);

        QualityControl1::where('KodeProduksi', $request['KodeProduksi'])->update([
            'Status'=> '1',
        ]);

        $QC1 =  QualityControl1::all()->where('Status', null);

        return view('operator.mylea.PostTreatment.QualityControl2', [
            'QC1'=>$QC1,
        ]);
    }

}
