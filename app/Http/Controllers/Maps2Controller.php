<?php

namespace App\Http\Controllers;

use App\Models\desa;
use App\Models\kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Maps2Controller extends Controller
{
    function view() {
        return view("maps.content");
    }
    
    function template()  {
        $user = Auth::user();
        if ($user == null) {
            return redirect()->route('login');
        }
        $role = $user->getRoleNames()->first();
        $kd_desa = $user->kode_desa;
        $kec = kecamatan::all();
        $desa =[];
        if($role == 'desa'){
            $desa = desa::where('d_kd_kel', 'like', '%' . $kd_desa . '%')
            ->get();
            $kec = Kecamatan::where('d_kd_kec', 'like', '%' . substr($kd_desa,0,7) . '%')
            ->get();
        }
        // echo json_encode($desa);exit();
        // $usr = Auth::user();
        // dd(session()->all());
        $ret = [
            'kecamatan'=>$kec,
            'desa' => $desa,
            'role' => $role
        ];
        return view("maps.content",$ret);
    }
}
