<?php

namespace App\Http\Controllers;

use App\Models\usulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UsulanController extends Controller
{
    function index() {
        $user = Auth::user();
        if ($user == null) {
            return redirect()->route('login');
        }
        $role = $user->getRoleNames()->first();
        return view('tes.usulan',['role' =>$role]);
    }

    function getUsulan() {
        $usulan = usulan::query()->where('status','1');
        return DataTables::of($usulan)->make(true);
    }

    function save_usulan(Request $request) {
        $user =  usulan::create([
            'nop' => $request['nop'],
            'usulan' => $request['usulan'],
            'status' => '1',
        ]);

        return  json_encode([ 
            'sts' => 'success',
        ]);
    }

    public function nonaktifkanUsulan($id)  {
        $ins = usulan::where('id', $id)->update(['status' => '0']);
        return  json_encode([ 
            'sts' => 'success',
        ]);
    }
}
