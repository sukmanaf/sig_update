<?php

namespace App\Http\Controllers;

use App\Models\desa;
use App\Models\kecamatan;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class ManagementUserController extends Controller
{
    function index() {
        $user = Auth::user();
        if ($user == null) {
            return redirect()->route('login');
        }
        $role = $user->getRoleNames()->first();
        $kec = kecamatan::all();
        $desa = desa::all();
        return view('tes.muser',['kecamatan'=>$kec,'desa'=>$desa,'role' =>$role]);
    }

    public function getUsers(Request $request)
    {
        $users = User::query();
        $shorting = $request->all()['order'][0];
        $column = $shorting['column'];
        if ($column != 0) {
            $dir = $shorting['dir'];
            $column_name = $request->all()['columns'][$column]['data'] ?? 'created_at';
            $users->orderBy($column_name, $dir);
        } else {
            $users->orderBy('created_at', 'desc');
        }
        return DataTables::of($users)
        ->addColumn('roles_id', function ($user) {
            return $user->roles->pluck('id')->implode(', ');
        })
        ->addColumn('roles_name', function ($user) {
            return $user->roles->pluck('name')->implode(', ');
        })
        ->make(true);
    }

    public function store(Request $request)  {
        $user =  User::create([
            'name' => $request['email'],
            'email' => $request['email'],
            'kode_desa' => $request['kode_desa'],
            'password' => Hash::make($request['password']),
        ]);
        $user->assignRole($request['role']);

        return  json_encode([ 
            'sts' => 'success',
        ]);
    }

    public function update(Request $request,$id){
        
        dd($request->all());

        $data = [
            'name' => $request['xemail'],
            'email' => $request['xemail'],
            'kode_desa' => $request['xkode_desa'],
        ];
        if (!empty($request['xpassword'])) {
            $data['password'] = Hash::make($request['xpassword']);
        }
        $user = user::find($id);
        // if
        if ($user) {
            $ins = user::where('id', $id)->update($data);
            
            if ($ins) {
                return response()->json(['sts' => 'success']);

            }
            return response()->json(['sts' => 'fail']);

        } else {
            return response()->json(['sts' => 'fail']);

        }
    }

        
    public function destroy($id)
    {
        $user = user::findOrFail($id);
        $user->delete();

        return response()->json(['sts' => 'success']);
    }
}
