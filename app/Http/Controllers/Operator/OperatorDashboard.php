<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\baglog\Kartu_Kendali;
use App\Models\baglog\Kontaminasi;
use App\Models\Mylea\MyleaProduction;
use App\Models\Mylea\MyleaReminder;
use App\Models\baglog\Mixing;
use App\Models\Mylea\MyleaKonta;
use App\Models\PostTreatment\QualityControl1;
use App\Models\PostTreatment\QualityControl2;
use Illuminate\Http\Request;

class OperatorDashboard extends Controller
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
        $MyleaProduction = MyleaProduction::orderBy('TanggalProduksi', 'asc')->get();
        $PostTreatment = QualityControl2::orderBy('FinishDate', 'asc')->get();
        $QualityControl1 = QualityControl1::where('Status', '=' , Null)->get();
        $MyleaReminder = MyleaReminder::all();
        return view('operator.dashboard', [
            'mixing' => $mixing,
            'kartukendali'=>$kartukendali,
            'MyleaProduction'=>$MyleaProduction,
            'MyleaReminder'=>$MyleaReminder,
            'PostTreatment'=>$PostTreatment,
            'QualityControl1'=>$QualityControl1,
        ]);
    }
}
