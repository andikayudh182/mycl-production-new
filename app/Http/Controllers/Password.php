<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\baglog\Mixing;
use App\Models\baglog\Kartu_Kendali;


class Password extends Controller
{
    public function index() {
        $role = Auth::user()->role; 
        if($role == 'admin'){
            $layout = 'layouts.admin';
        } else {
            $layout = 'layouts.operator';
        }
        return view('auth.password', ['layout' => $layout,]);
    }

    public function submit(Request $request){
        $data = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $id = Auth::user()->id;
        $role = Auth::user()->role; 
        User::where(['id'=>$id])
        ->update(['Password'=>Hash::make($data['password']),]);
        switch ($role) {
            case 'admin':
                $mixing = Mixing::all();
                $kartukendali = Kartu_Kendali::all();
              return view('admin.dashboard', [
                'mixing' => $mixing,
                'kartukendali'=>$kartukendali,
            ]);
              break;
            case 'operator':
              return view('operator.baglog.BaglogIndex');
              break; 
          }
    }
}
