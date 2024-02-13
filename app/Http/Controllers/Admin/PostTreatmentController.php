<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostTreatment\QualityControl1;
use App\Models\PostTreatment\MPT1;
use App\Models\PostTreatment\MPT2;
use App\Models\PostTreatment\MPT3;
use App\Models\PostTreatment\MPT4;
use App\Models\PostTreatment\QualityDetails;
use App\Models\PostTreatment\QualityControl2;
use App\Models\PostTreatment\QualityDetails2;
use App\Models\PostTreatment\Pemakaian;

class PostTreatmentController extends Controller
{
    public function index(){
        return view('admin.mylea.PostTreatment.Index');
    }

    public function addstock(){
        return view('admin.mylea.PostTreatment.AddStock');
    }

    public function addstocksubmit (Request $request){
        $request->validate([
            'FinishDate'=> 'Required',
            'ArrivalDate'=> 'Required',
        ]);

        $KodeProduksi = '';
        $ArrivalDate = $request['ArrivalDate'];
        $JenisMylea = $request['JenisMylea'];
        $TB = date("d-m-y", strtotime($ArrivalDate));
        if($JenisMylea == "Konta") {
            $KodeProduksi =  "MYPT_K".$TB;
        } elseif ($JenisMylea == "Normal"){
            $KodeProduksi =  "MYPT_N".$TB;
        }

        $Jumlah = '0';
        foreach($request->data as $key => $value){
            QualityDetails2::create([
                'KodeProduksi'=>$KodeProduksi,
                'Grade'=>$value['Grade'],
                'KategoriReinforce'=>$value['KategoriReinforce'],
                'Warna'=>$value['Warna'],
                'Jumlah'=>$value['Jumlah'],
                'Ukuran'=>$value['Ukuran'],
            ]);
            $Jumlah = $Jumlah + $value['Jumlah'];
        }

        QualityControl2::create([
            'KodeProduksi'=>$KodeProduksi,
            'FinishDate'=>$request['FinishDate'],
            'Jumlah'=>$Jumlah,
        ]);

        return view('admin.mylea.PostTreatment.AddStock');
    }

    public function stockcard(Request $request){
        $Data = QualityDetails2::all();
        if($request){
            $data = QualityDetails2::where('Warna', '=', $request['Warna'])
                ->where('Grade', '=', $request['Grade'])
                ->where('Ukuran', '=', $request['Ukuran'])
                ->where('KategoriReinforce', '=', $request['KategoriReinforce'])
                ->get();
            
            $Group = [];
            foreach($data as $item){
                $Group[substr($item['KodeProduksi'], 9, 5)] = [];
                $Group[substr($item['KodeProduksi'], 9, 5)]['Jumlah'] = 0;
                $Group[substr($item['KodeProduksi'], 9, 5)]['Terpakai'] = Pemakaian::where('id_details', substr($item['KodeProduksi'], 9, 5))->get()->sum('Jumlah');
            }
            foreach($data as $d){
                if(isset($Group[substr($d['KodeProduksi'], 9, 5)])){
                    $Group[substr($d['KodeProduksi'], 9, 5)][] = $d['KodeProduksi'];
                    $Group[substr($d['KodeProduksi'], 9, 5)]['Jumlah'] += $d['Jumlah'];
                }
            }
            $Jumlah = 0; $Pemakaian = 0;
            foreach($Group as $item){
                $Jumlah += $item['Jumlah'];
                $Pemakaian += $item['Terpakai'];
            }



        }


        return view('admin.mylea.PostTreatment.StockCard', [
            'data'=>$Data,
            'FilteredData'=>$data,
            'Jumlah'=>$Jumlah - $Pemakaian,
            'Pemakaian'=>$Pemakaian,
            'grup' =>$Group,
        ]);
    }

    public function formpemakaian($id){
        return view('admin.mylea.PostTreatment.FormPemakaian',[
            'id'=>$id,
        ]);
    }

    public function formpemakaiansubmit(Request $request){
        Pemakaian::create([
            'id_details'=>$request['id_details'],
            'Tanggal'=>$request['Tanggal'],
            'Jumlah'=>$request['Jumlah'],
            'Notes'=>$request['Notes'],
        ]);

        return redirect(url('/admin/mylea/post-treatment/stock-card'));
    }

    public function datapemakaian ($id){
        $Details = QualityDetails2::where('id', $id)->get();
        $Pemakaian = Pemakaian::where('id_details', $id)->get();

        return view('admin.mylea.PostTreatment.DataPemakaian', [
            'Details'=>$Details,
            'Pemakaian'=>$Pemakaian,
        ]);
    }

    public function deletepemakaian ($id){
        Pemakaian::where('id', $id)->delete();

        return redirect(url('/admin/mylea/post-treatment/stock-card'));
    }

    public function deletestock ($id){
        QualityDetails2::where('id', $id)->delete();

        return redirect(url('/admin/mylea/post-treatment/stock-card'));
    }

    public function monitoring(){
        $QualityControl1 = QualityControl1::paginate(15);
        return view('admin.mylea.PostTreatment.Monitoring', [
            'QualityControl1' => $QualityControl1,
        ]);
    }

    public function deletequalitydetails($id){
        QualityDetails::where('id', $id)->delete();

        MPT2::where('id', $id)->delete();

        MPT3::where('id', $id)->delete();

        MPT4::where('id', $id)->delete();

        return redirect(url('/admin/mylea/post-treatment/monitoring'));
    }
}
