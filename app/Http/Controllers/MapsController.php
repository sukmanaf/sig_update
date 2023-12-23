<?php

namespace App\Http\Controllers;

use App\Models\Maps;
use App\Models\Nop;
use App\Models\Blok;
use App\Models\Bangunan;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MapsController extends Controller
{
    public function index()
    {
        // $maps = DB::table('nops')
        //     ->select(DB::raw('nops.*,ST_AsGeoJSON(geom)::json as geom' ))
        //     ->get();
        //    // echo "<pre>";
        //    // print_r ($maps[0]);
        //    // echo "</pre>";
		// 	$str= '{"type" : "FeatureCollection", "features" : [';

        //    foreach ($maps as $key => $value) {
				
		// 		$text  = '{"type": "Feature", "geometry":'.$value->geom.',"properties":';
		// 		unset($value->geom);
        //         // foreach ($value as $k => $v) {
        //         //     $k = strtolower($k);
        //         //     // unset($value['geom']);
                    
        //         //     $a[$k]=$v;   
        //         // }
        //         $text .=json_encode($value); 
                
		// 		$str .= $text.'},';
        //    }
        //    $str = substr($str,0,-1);
        //     $str .= ']}';
		// 		echo $str;
        //    		exit();         		
        // $maps = Maps::all();
        // // Fetch all mapss from the database
        // // $users = User::all();
        // $maps = DB::table('nops')->get();
        // dd($maps);
        // return response()->json([
        //     'data' => [
        //         'd_nop' => $maps->d_nop,
        //         'd_luas' => $maps->d_luas, 
        //         'geom' => $maps->geom 
        //     ]
        // ]);
        // echo "<pre>";
        // print_r ($maps);
        // echo "</pre>";exit();
        // $name = DB::table('bangunans')->where('d_nop','357501000100301840001')->get();
        // $name = DB::table('sessions')->get();
        // DB::enableQueryLog(); // Enable query log

        // Your Eloquent query executed by using get()


        return view('maps.index');
 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $jns = $request['jns'];

        if ($jns == 'desa') {
            $table = 'desas';
        }
        // exit();
        if ($jns == 'nop') {
            $table = 'nops';
        }
        if ($jns == 'blok') {
            $table = 'bloks';
        }
        if ($jns == 'bangunan') {
            $table = 'bangunans';
        }
        
        if ($table=='') {
            dd('Jns Kosong');
        }

        $data = file_get_contents(@$_FILES['files']['tmp_name']);
        $data = json_decode($data);

        
        $type=$data->features[0]->geometry->type;
        $ins=[];
        foreach ($data->features as $key => $value) {
            
            $str =  'tipe((';
            $ar =[];
            // echo "<pre>";
            // print_r ($value->geometry->coordinates[0]);
            // echo "</pre>";exit();
            
            
            //foreach pembuatan geometry
            foreach ($value->geometry->coordinates[0] as $key2 => $value2) {
                $tipee = $value->geometry->type;
                    $str = str_replace('tipe',$tipee,$str);
                // echo "<pre>";
                // print_r ($value2);
                // echo "</pre>";
                
                if(!is_array($value2[1])){
                    
                    $str .= @$value2[0].' '.@$value2[1].',';
                }

                else{
                    
                    foreach($value->geometry->coordinates as $k => $v){

                           foreach ($v as $k2 => $v2) {
                                $str .= '(';
                                foreach ($v2 as $k3 => $v3) {
                                    // dd($v3[0]);
                                    $str .= @$v3[0].' '.@$v3[1].',';
                                }
                                $str = mb_substr($str, 0, -1);
                                $str .='),';
                            }
                    }

                    $str = mb_substr($str, 0, -1);
                                $str .=')';
                    
                };
                
            };
            $str = mb_substr($str, 0, -1);
            // $str = mb_substr($str, 0, -1);
            $str.='))';

            // echo $str;
            // exit();
            $a=[];
            // $g=[];
            $adata=$value->properties;
            //pembuatan array insert
            foreach ($adata as $k => $v ) {
                        $kk=strtolower($k);
                        $a[$kk]=$v;
                
            }
            $a['geom']=$str; 
            $a['created_at']=date('Y-m-d H:i:s'); 
            $a['updated_at']=date('Y-m-d H:i:s'); 
            unset($a['layer']);
            unset($a['path']);
            unset($a['field2']);
            unset($a['field3']);
            unset($a['hotlink']);
            array_push($ins,$a);

        
        }
        
        
        foreach ($ins as $key => $value) {
            // DB::table('nops')
            //     ->whereRaw("ST_IsValid(ST_GeomFromText('".$value['geom']."'))") // Replace with your geometry data
            //     ->insert($value);
            try {
                DB::table($table)->insert($value);
                // dd($table);
            } catch (\Exception $e) {
                // Handle the exception or log the error
                // Example: Log the error using Laravel's Log facade
                 Log::error('Error inserting data: ' . $e->getMessage());
            }
        }
        
    }

    public function insNop($value='')
    {
        // dd($_FILES['files']);
        $data = file_get_contents(@$_FILES['files']['tmp_name']);
        $data = json_decode($data);

        // dd($data);
        
        
        $type=$data->features[0]->geometry->type;
        $ins=[];
        foreach ($data->features as $key => $value) {
            
            $str =  'tipe((';
            $ar =[];
            
            //foreach pembuatan geometry
            foreach ($value->geometry->coordinates[0] as $key2 => $value2) {
                $tipee = $value->geometry->type;
                    $str = str_replace('tipe',$tipee,$str);
                // echo "<pre>";
                // print_r ($value2);
                // echo "</pre>";
                
                if(!is_array($value2[1])){
                    
                    $str .= @$value2[0].' '.@$value2[1].',';
                }

                else{
                    
                    foreach($value->geometry->coordinates as $k => $v){

                           foreach ($v as $k2 => $v2) {
                                $str .= '(';
                                foreach ($v2 as $k3 => $v3) {
                                    // dd($v3[0]);
                                    $str .= @$v3[0].' '.@$v3[1].',';
                                }
                                $str = mb_substr($str, 0, -1);
                                $str .='),';
                            }
                    }

                    $str = mb_substr($str, 0, -1);
                                $str .=')';
                    
                };
                
            };
            $str = mb_substr($str, 0, -1);
            // $str = mb_substr($str, 0, -1);
            $str.='))';

            // echo $str;
            // exit();
            $a=[];
            // $g=[];
            $adata=$value->properties;
        //pembuatan array insert
            foreach ($adata as $k => $v ) {
                        $kk=strtolower($k);
                        $a[$kk]=$v;
                
            }
            
            $a['geom']=DB::raw("ST_GeomFromText('".$str."')"); 
            $a['created_at']=date('Y-m-d H:i:s'); 
            $a['updated_at']=date('Y-m-d H:i:s'); 
            array_push($ins,$a);

        
        }
        foreach ($ins as $key => $value) {
            DB::table('nops')
                ->whereRaw("ST_IsValid(ST_GeomFromText('".$value->geom."'))") // Replace with your geometry data
                ->insert($value);
            // Nop::insertOrIgnore($value);
            // DB::table('nop')->insert($value);
        }
    }

    public function insDesa($value='')
    {
        // dd($_FILES['files']);
        $data = file_get_contents(@$_FILES['files']['tmp_name']);
        $data = json_decode($data);

        // dd($data);
        
        
        $type=$data->features[0]->geometry->type;
        $ins=[];
        foreach ($data->features as $key => $value) {
            
            
            // $g=[];
            $adata=$value->properties;
        //pembuatan array insert
            foreach ($adata as $k => $v ) {
                        $kk=strtolower($k);
                        $a[$kk]=$v;
                
            }
            array_push($ins,$a);

        
        }
        // dd($ins[0]);
        foreach ($ins as $key => $value) {
            Desa::insert($value);
            // DB::table('nop')->insert($value);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Maps  $maps
     * @return \Illuminate\Http\Response
     */
    public function show(Maps $maps)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Maps  $maps
     * @return \Illuminate\Http\Response
     */
    public function edit(Maps $maps)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Maps  $maps
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Maps $maps)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'file|mimes:jpg,png,pdf|max:2048', // Add the desired file extensions here
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($request->file('img')){
        
            $directory = 'public/uploads/' . $request['nop'];
            
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }
            
            foreach ($request->file('ximg') as $image) {
                $fileName = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs($directory, $fileName);
            }
        }
            if ($request['jenis'] == 1) {
                

                $ins = DB::table('nops')->where('d_nop', $request->nop_old)->update([
                            'd_nop'     => $request->nop, 
                            'geom'   => $request->geom
                        ]);
                $maps = $this->getSearchNop($request->nop);
                $str= '{"type" : "FeatureCollection", "features" : [';
                    foreach ($maps as $key => $value) {
                    
                        $text  = '{"type": "Feature", "geometry":'.$value->geom.',"properties":';
                        unset($value->geom);
                    
                        $text .=json_encode($value); 
                        
                        $str .= $text.'},';
                }
                $str = substr($str,0,-1);
                $str .= ']}';
                $ret = [ 
                    'sts' => 'success',
                    'jns' => 'nop',
                    'new_poly' => $str,
    
                ];
                        
               
                return json_encode($ret);
            }elseif ($request['jenis'] == 2) {
                // dd($request->nop_old);
               
                $ins = DB::table('bloks')->where('d_blok', $request->nop_old)->update([
                            'd_blok'     => $request->nop, 
                            'geom'   => $request->geom
                        ]);
                  $ret = [ 
                            'sts' => 'success',
                            'jns' => 'blok',

                        ];
                return json_encode($ret);
            }elseif ($request['jenis'] == 3) {
                
               
                $ins = DB::table('bangunans')->where('d_nop', $request->nop_old)->update([
                            'd_nop'     => $request->nop, 
                            'geom'   => $request->geom
                        ]);
                  $ret = [ 
                            'sts' => 'success',
                            'jns' => 'bangunan',

                        ];
                return json_encode($ret);
            }


        
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Maps  $maps
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maps $maps)
    {
        //
    }
    public function getAllNop()
    {
       $maps = DB::table('nops')
            ->select(DB::raw('nops.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->get();
           
            $str= '{"type" : "FeatureCollection", "features" : [';

           foreach ($maps as $key => $value) {
                
                $text  = '{"type": "Feature", "geometry":'.$value->geom.',"properties":';
                unset($value->geom);
                // foreach ($value as $k => $v) {
                //     $k = strtolower($k);
                //     // unset($value['geom']);
                    
                //     $a[$k]=$v;   
                // }
                $text .=json_encode($value); 
                
                $str .= $text.'},';
           }
           $str = substr($str,0,-1);
            $str .= ']}';
            return $str;
            
    }

    public function getWilayah()
    {
        $user = Auth::user();
        $role = $user->getRoleNames()->first();
        $kd_desa = $user->kode_desa;
        if ($role == 'admin') {
            $maps = DB::table('desas')
            ->select(DB::raw('desas.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->get();
        }else{
            $maps = DB::table('desas')
            ->select(DB::raw('desas.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->where('d_kd_kel',$kd_desa)
            ->get();

        }
            $str= '{"type" : "FeatureCollection", "features" : [';

           foreach ($maps as $key => $value) {
                
                $text  = '{"type": "Feature", "geometry":'.$value->geom.',"properties":';
                unset($value->geom);
                // foreach ($value as $k => $v) {
                //     $k = strtolower($k);
                //     // unset($value['geom']);
                    
                //     $a[$k]=$v;   
                // }
                $text .=json_encode($value); 
                
                $str .= $text.'},';
           }
           $str = substr($str,0,-1);
            $str .= ']}';
            return $str;
            
    }
    public function getNop($kec,$kel)
    {
        if ($kec == '00') {
            $maps = DB::table('nops')
            ->select(DB::raw('nops.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->orwhere('d_nop', 'like', '%3575010%')
            ->orwhere('d_nop', 'like', '%3575020%')
            ->orwhere('d_nop', 'like', '%3575030%')
            ->orwhere('d_nop', 'like', '%3575040%')
            ->get();
        }elseif ($kec != 00 && $kel == 00) {
            $maps = DB::table('nops')
            ->select(DB::raw('nops.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->where('d_nop', 'like', '%' . $kec . '%')
            ->get();
        }else{

            $maps = DB::table('nops')
            ->select(DB::raw('nops.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->where('d_nop', 'like', '%' . $kel . '%')
            ->get();

        }
        // dd($maps);
       

        if ($maps->isEmpty()) {
            return json_encode(['msg' => 'Data Kosong','sts' => 'fail']);
        } else {
           
		    $str= '{"type" : "FeatureCollection", "features" : [';
           foreach ($maps as $key => $value) {
                
				$text  = '{"type": "Feature", "geometry":'.$value->geom.',"properties":';
				unset($value->geom);
                $text .=json_encode($value); 
                
				$str .= $text.'},';
           }
           $str = substr($str,0,-1);
            $str .= ']}';
            // return $str;
            $blok = DB::table('bloks')
            ->select(DB::raw('bloks.d_blok' ))
            ->where('d_blok', 'like', '%' . $kel . '%')
            ->orderBy('d_blok', 'asc')
            ->get();

            $bloks=[];
            foreach ($blok as $key => $value) {
                $only = substr($value->d_blok,10,3);
                $bloks[$only] = $value->d_blok;
            }
           return json_encode(['msg' => 'Ada Data', 'sts' => 'success','data' =>$str,'blok' =>$bloks]);
        }
    }

      public function getNops($kec,$kel)
    {
        if ($kec == '00') {
            $maps = DB::table('nops')
            ->select(DB::raw('nops.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->orwhere('d_nop', 'like', '%3575010%')
            ->orwhere('d_nop', 'like', '%3575020%')
            ->orwhere('d_nop', 'like', '%3575030%')
            ->orwhere('d_nop', 'like', '%3575040%')
            ->get();
        }elseif ($kec != 00 && $kel == 00) {
            $maps = DB::table('nops')
            ->select(DB::raw('nops.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->where('d_nop', 'like', '%' . $kec . '%')
            ->get();
        }else{

            $maps = DB::table('nops')
            ->select(DB::raw('nops.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->where('d_nop', 'like', '%' . $kel . '%')
            ->get();

        }
       

        if ($maps->isEmpty()) {
            return json_encode(['msg' => 'Data Kosong','sts' => 'fail']);
        } else {
           
            $str= '{"type" : "FeatureCollection", "features" : [';
            $n=0;
            $c=0;
            $dts=[];
            $dts[$n]= $str;
           foreach ($maps as $key => $value) {
                    
                     if($c < 10000){

                        $text  = '{"type": "Feature", "geometry":'.$value->geom.',"properties":';
                        unset($value->geom);
                        $text .=json_encode($value); 
                        
                        $dts[$n] .= $text.'},';
                        $c++;
                     }else{
                        $dts[$n] = substr($dts[$n],0,-1);
                        $dts[$n] .= ']}';
                        $n++;
                        $c=0;
                        $dts[$n]= $str;
                     }
           }
           $dts[$n] = substr($dts[$n],0,-1);
            $dts[$n] .= ']}';
            // dd($dts);
            // return json_encode($dts);
            // return $str;

           return json_encode(['msg' => 'Ada Data', 'sts' => 'success','data' =>$dts]);
        }
    }

    public function getBlok($kec,$kel)
    {
        
        if ($kec == '00') {
            $maps = DB::table('bloks')
            ->select(DB::raw('bloks.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->get();
        }elseif ($kec != 00 && $kel == 00) {
            $maps = DB::table('bloks')
            ->select(DB::raw('bloks.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->where('d_blok', 'like', '%' . $kec . '%')
            ->get();
        }else{

            $maps = DB::table('bloks')
            ->select(DB::raw('bloks.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->where('d_blok', 'like', '%' . $kel . '%')
            ->get();

        }
       
        if ($maps->isEmpty()) {
            return json_encode(['msg' => 'Data Kosong','sts' => 'fail']);
        } else {
           
        
            $str= '{"type" : "FeatureCollection", "features" : [';

           foreach ($maps as $key => $value) {
                
                $text  = '{"type": "Feature", "geometry":'.$value->geom.',"properties":';
                unset($value->geom);
               
                $text .=json_encode($value); 
                
                $str .= $text.'},';
           }
           $str = substr($str,0,-1);
            $str .= ']}';
           return json_encode(['msg' => 'Ada Data', 'sts' => 'success','data' =>$str]);
           
        }
    }
    public function getBng($kec,$kel)
    {
        if ($kec == '00') {
            $maps = DB::table('bangunans')
            ->select(DB::raw('bangunans.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->get();
        }elseif ($kec != 00 && $kel == 00) {
            $maps = DB::table('bangunans')
            ->select(DB::raw('bangunans.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->where('d_nop', 'like', '%' . $kec . '%')
            ->get();
        }else{
            $maps = DB::table('bangunans')
            ->select(DB::raw('bangunans.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->where('d_nop', 'like', '%' . $kel . '%')
            ->get();
        }

        if ($maps->isEmpty()) {
            return json_encode(['msg' => 'Data Kosong','sts' => 'fail']);
        } else {
           
        
            $str= '{"type" : "FeatureCollection", "features" : [';

           foreach ($maps as $key => $value) {
                
                $text  = '{"type": "Feature", "geometry":'.$value->geom.',"properties":';
                unset($value->geom);
               
                $text .=json_encode($value); 
                
                $str .= $text.'},';
           }
           $str = substr($str,0,-1);
            $str .= ']}';
           return json_encode(['msg' => 'Ada Data', 'sts' => 'success','data' =>$str]);
           
        }
    }

      public function getSearchNop($nop)
    {
        $maps = DB::table('nops')
            ->select(DB::raw('nops.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->where('d_nop',$nop)
            ->get();
        return $maps;

       
    }

    public function save_nop(Request $request)
    {      
        

            $validator = Validator::make($request->all(), [
                'file' => 'file|mimes:jpg,png,pdf|max:2048', // Add the desired file extensions here
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if($request->file('img')){

                $directory = 'public/uploads/' . $request['nop'];
                if (!Storage::exists($directory)) {
                    Storage::makeDirectory($directory);
                }
                foreach ($request->file('img') as $image) {
                    $fileName = time() . '_' . $image->getClientOriginalName();
                    $path = $image->storeAs($directory, $fileName);
                }
            }

            if ($request['jenis'] == 1) {
                
                $ins['d_nop']=$request['nop']; 
                $ins['d_luas']=0; 
                $ins['geom']=$request['geom']; 
                $ins['created_at']=date('Y-m-d H:i:s'); 
                $ins['updated_at']=date('Y-m-d H:i:s');
                $insert = DB::table('nops')->insert($ins);
                $maps = $this->getSearchNop($request['nop']);
                $str= '{"type" : "FeatureCollection", "features" : [';
                    foreach ($maps as $key => $value) {
                    
                        $text  = '{"type": "Feature", "geometry":'.$value->geom.',"properties":';
                        unset($value->geom);
                    
                        $text .=json_encode($value); 
                        
                        $str .= $text.'},';
                }
                $str = substr($str,0,-1);
                $str .= ']}';
                $ret = [ 
                    'sts' => 'success',
                    'jns' => 'nop',
                    'new_poly' => $str,
    
                ];
        
                return json_encode($ret);
            }elseif ($request['jenis'] == 2) {
                
                $ins['d_blok']=$request['nop']; 
                $ins['geom']=$request['geom']; 
                $ins['created_at']=date('Y-m-d H:i:s'); 
                $ins['updated_at']=date('Y-m-d H:i:s');
                
                $insert = DB::table('bloks')->insert($ins);
                  $ret = [ 
                            'sts' => 'success',
                            'jns' => 'blok',

                        ];
                return json_encode($ret);
            }elseif ($request['jenis'] == 3) {
                
                $ins['d_nop']=$request['nop']; 
                $ins['geom']=$request['geom']; 
                $ins['created_at']=date('Y-m-d H:i:s'); 
                $ins['updated_at']=date('Y-m-d H:i:s');
                
                $insert = DB::table('bangunans')->insert($ins);
                  $ret = [ 
                            'sts' => 'success',
                            'jns' => 'bangunan',

                        ];
                return json_encode($ret);
            }

                        
    }

    public function masuk()
    {
        // $exists = Storage::disk('public')->exists('logo/logo.png');
        return view('tes.login');
        
    }

    public function smartmap($value='')
    {
        $user = Auth::user();
        if ($user == null) {
            return redirect()->route('login');
        }
        $role = $user->getRoleNames()->first();
        $kd_desa = $user->kode_desa;
        
        
        $kec = Kecamatan::all();

        
        // dd($desa);
        // dd($kd_desa);
                 
        // echo "<pre>";
        // print_r ($desa);
        // echo "</pre>";exit();
        
        $desa =[];
        if($role == 'desa'){
            $desa = Desa::where('d_kd_kel', 'like', '%' . $kd_desa . '%')
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
        return view('tes.content',$ret);
    }

    public function muser($value='')
    {
        $items = Desa::paginate(10); // Paginate the data with 10 items per page

        return view('tes.muser', compact('items'));
    }

    public function desas(Request $request)
    {
        $items = Desa::paginate(10); // Paginate the data with 10 items per page

        return view('tes.muser', compact('items'));
    }

     public function deleteNop(Request $request, $id)
    {
        $column = 'd_nop';
        $value = $id;

        $model = Nop::where($column, $value)->first();

        if (!$model) {
            return response()->json(['status' => 'error', 'message' => 'Record not found'], 404);
        }
        $model->delete();
        
        return response()->json(['status' => 'success', 'message' => 'Record deleted successfully']);
    }
     public function deleteBlok(Request $request, $id)
    {
        $column = 'd_blok';
        $value = $id;

        $model = Blok::where($column, $value)->first();

        if (!$model) {
            return response()->json(['status' => 'error', 'message' => 'Record not found'], 404);
        }
        $model->delete();
        
        return response()->json(['status' => 'success', 'message' => 'Record deleted successfully']);
    }
     public function deleteBangunan(Request $request, $id)
    {
        $column = 'd_nop';
        $value = $id;

        $model = Bangunan::where($column, $value)->first();

        if (!$model) {
            return response()->json(['status' => 'error', 'message' => 'Record not found'], 404);
        }
        $model->delete();
        
        return response()->json(['status' => 'success', 'message' => 'Record deleted successfully']);
    }

    public function getDesa($kec='')
    {
        // $desa = Desa::all();
        $desa = Desa::where('d_kd_kel', 'like', '%' . $kec . '%')
                 ->get();
        return json_encode($desa);
    }


    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:jpg,png,pdf|max:2048', // Add the desired file extensions here
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            // Specify the directory where you want to store the uploaded file
            $path = storage_path('app/public/uploads');
            // Generate a unique name for the file
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            // Move the uploaded file to the specified directory with the generated name
            $file->move($path, $fileName);
            // Optionally, you can store the file's metadata or perform additional actions
            // For example, you can save the file's details to a database
        }

        // File upload logic here

        return "File uploaded successfully!";
    }

    function jenis_tanah(Request $request) {
        $postData=  $request->all();
        $datas=[];
        $detailHitung = '';
        $color= [
            "TANAH + BANGUNAN" => 'red',
            "KAVLING SIAP BANGUN" => 'green',
            "TANAH KOSONG" => 'blue',
            "FASILITAS UMUM" => 'yellow'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('URL_PBB').'/sismiop/sig_api/GetsPublicData/jenisTanah'); // Set the URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
        curl_setopt($ch, CURLOPT_POST, true); // Set the request method to POST
        $postDataString = http_build_query($postData);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataString);
        $response = curl_exec($ch);
        if ($response === false) {
            echo 'cURL Error: ' . curl_error($ch);
        } else {
            $data = json_decode($response);
            foreach ($data->data as $key => $value) {
                $datas[$key] =[];
                $detailHitung .= '<div class="row" style="margin-top: 5px">'.
                        '<div class="col-md-2">'.
                            '<div class="" style="opacity: 0.4;background-color: '.$color[$key].';height: 25px;width: 25px"></div>'.
                        '</div>'.
                        '<div class="col-md-7"><span style="font-size: 12px">'.$key.'</span></div>'.
                        '<div class="col-md-3"><span style="font-size: 12px">['.count($data->data->$key).']</span></div>'.
                    '</div>';
                foreach ($value as $k => $v) {
                    $nop = str_replace('.','',str_replace('-','',$v->NOP));
                    array_push($datas[$key],$nop);
                }
            }
            
        }

        curl_close($ch);
            $param=  $request["KD_PROPINSI"].$request["KD_DATI2"].$request["KD_KECAMATAN"].$request["KD_KELURAHAN"];
            $maps = DB::table('nops')
            ->select(DB::raw('nops.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->whereRaw("d_nop like '%{$param}%'")->get();
       
        $style = [];
        foreach ($maps as $key => $value) {
            foreach ($datas as $k => $v) {
                // dd(count($datas[$k])); 
                
                // dd($value->d_nop);
                if (in_array($value->d_nop,$datas[$k])) {
                    
                    // dd($color[$k]);
                    $maps[$key]->color = $color[$k];
                    array_push($style,$maps[$key]);

                    // array_push($maps[$key],['jns' => $k]);
                    // echo $key;
                }
            }
        }
        if ($maps->isEmpty()) {
            return json_encode(['msg' => 'Data Kosong','sts' => 'fail']);
        } else {
           
			$str= '{"type" : "FeatureCollection", "features" : [';

           foreach ($style as $key => $value) {
                    # code...
				
				$text  = '{"type": "Feature", "geometry":'.$value->geom.',"properties":';
				unset($value->geom);
                // foreach ($value as $k => $v) {
                //     $k = strtolower($k);
                //     // unset($value['geom']);
                    
                //     $a[$k]=$v;   
                // }
                $text .=json_encode($value); 
                
				$str .= $text.'},';
           }
           $str = substr($str,0,-1);
            $str .= ']}';
            // return $str;
        //    dd($str);
           return json_encode(['msg' => 'Ada Data', 'sts' => 'success','data' =>$str,'detail' => $detailHitung]);
        }
    }

    function jenis_penggunaan_bangunan(Request $request) {
        $postData=  $request->all();
        $datas=[];
        $detailHitung = '';
        $listColor= [ 'red','green','blue','yellow','pink','orange','cyan','#60f542','#42f5ef','#05521d'
        ];
        $no = 0;
        $color=[];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('URL_PBB').'/sismiop/sig_api/GetsPublicData/jenisPenggunaanBangunan'); // Set the URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
        curl_setopt($ch, CURLOPT_POST, true); // Set the request method to POST
        $postDataString = http_build_query($postData);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataString);
        $response = curl_exec($ch);
        if ($response === false) {
            echo 'cURL Error: ' . curl_error($ch);
        } else {
            $data = json_decode($response);

            foreach ($data->data as $key => $value) {
                $datas[$key] =[];

                $color[$key] =$listColor[$no];
                $detailHitung .= '<div class="row" style="margin-top: 5px">'.
                        '<div class="col-md-2">'.
                            '<div class="" style="opacity: 0.4;background-color: '.$listColor[$no].';height: 25px;width: 25px"></div>'.
                        '</div>'.
                        '<div class="col-md-7"><span style="font-size: 12px">'.$key.'</span></div>'.
                        '<div class="col-md-3"><span style="font-size: 12px">['.count($data->data->$key).']</span></div>'.
                    '</div>';
                    $no++;
                foreach ($value as $k => $v) {
                    $nop = str_replace('.','',str_replace('-','',$v->NOP));
                    array_push($datas[$key],$nop);
                }
            }
            
        }
        curl_close($ch);
            $param=  $request["KD_PROPINSI"].$request["KD_DATI2"].$request["KD_KECAMATAN"].$request["KD_KELURAHAN"];
            $maps = DB::table('nops')
            ->select(DB::raw('nops.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->whereRaw("d_nop like '%{$param}%'")->get();
       
        $style = [];
        foreach ($maps as $key => $value) {
            foreach ($datas as $k => $v) {
                // dd(count($datas[$k])); 
                
                // dd($value->d_nop);
                if (in_array($value->d_nop,$datas[$k])) {
                    $maps[$key]->color = $color[$k];
                    array_push($style,$maps[$key]);

                    // array_push($maps[$key],['jns' => $k]);
                    // echo $key;
                }
            }
        }


        if ($maps->isEmpty()) {
            return json_encode(['msg' => 'Data Kosong','sts' => 'fail']);
        } else {
           
			$str= '{"type" : "FeatureCollection", "features" : [';

           foreach ($maps as $key => $value) {
                // dd($value);
				if (!empty($value->geom)) {
                    // do something
                    $text  = '{"type": "Feature", "geometry":'.$value->geom.',"properties":';
                    unset($value->geom);
                    //     $k = strtolower($k);
                    //     // unset($value['geom']);
                    
                    //     $a[$k]=$v;   
                    // }
                    $text .=json_encode($value); 
                    
                    $str .= $text.'},';
                }
           }
           $str = substr($str,0,-1);
            $str .= ']}';
            // return $str;
        //    dd($str);
           return json_encode(['msg' => 'Ada Data', 'sts' => 'success','data' =>$str,'detail' => $detailHitung]);
        }
    }

    function nilai_individu(Request $request) {
        $postData=  $request->all();
        $datas=[];
        $detailHitung = '';
        $listColor= [ 'red','green','blue','yellow','pink','orange','cyan','#60f542','#42f5ef','#05521d'
        ];
        $no = 0;
        $color=[];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('URL_PBB').'/sismiop/sig_api/GetsPublicData/nilaiIndividu'); // Set the URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
        curl_setopt($ch, CURLOPT_POST, true); // Set the request method to POST
        $postDataString = http_build_query($postData);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataString);
        $response = curl_exec($ch);
        if ($response === false) {
            echo 'cURL Error: ' . curl_error($ch);
        } else {
            $data = json_decode($response);

            foreach ($data->data as $key => $value) {
                $datas[$key] =[];

                $color[$key] =$listColor[$no];
                $detailHitung .= '<div class="row" style="margin-top: 5px">'.
                        '<div class="col-md-1">'.
                            '<div class="" style="opacity: 0.4;background-color: '.$listColor[$no].';height: 15px;width: 15px"></div>'.
                        '</div>'.
                        '<div class="col-md-8"><span style="font-size: 12px">'.str_replace('_',' ',$key).'</span></div>'.
                        '<div class="col-md-3"><span style="font-size: 12px">['.count($data->data->$key).']</span></div>'.
                    '</div>';
                    $no++;
                foreach ($value as $k => $v) {
                    $nop = str_replace('.','',str_replace('-','',$v->NOP));
                    array_push($datas[$key],$nop);
                }
            }
            
        }
        curl_close($ch);
            $param=  $request["KD_PROPINSI"].$request["KD_DATI2"].$request["KD_KECAMATAN"].$request["KD_KELURAHAN"];
            $maps = DB::table('nops')
            ->select(DB::raw('nops.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->whereRaw("d_nop like '%{$param}%'")->get();
       
        $style = [];
        foreach ($maps as $key => $value) {
            foreach ($datas as $k => $v) {
                // dd(count($datas[$k])); 
                
                // dd($value->d_nop);
                if (in_array($value->d_nop,$datas[$k])) {
                    $maps[$key]->color = $color[$k];
                    array_push($style,$maps[$key]);

                    // array_push($maps[$key],['jns' => $k]);
                    // echo $key;
                }
            }
        }


        if ($maps->isEmpty()) {
            return json_encode(['msg' => 'Data Kosong','sts' => 'fail']);
        } else {
           
			$str= '{"type" : "FeatureCollection", "features" : [';

           foreach ($maps as $key => $value) {
                // dd($value);
				if (!empty($value->geom)) {
                    // do something
                    $text  = '{"type": "Feature", "geometry":'.$value->geom.',"properties":';
                    unset($value->geom);
                    //     $k = strtolower($k);
                    //     // unset($value['geom']);
                    
                    //     $a[$k]=$v;   
                    // }
                    $text .=json_encode($value); 
                    
                    $str .= $text.'},';
                }
           }
           $str = substr($str,0,-1);
            $str .= ']}';
            // return $str;
        //    dd($str);
           return json_encode(['msg' => 'Ada Data', 'sts' => 'success','data' =>$str,'detail' => $detailHitung]);
        }
    }


    function npwp(Request $request) {
        $postData=  $request->all();
        $datas=[];
        $detailHitung = '';
        $listColor= [ 
            'red','#2ecc71','yellow','#9b59b6','#34495e',
            '#16a085','#27ae60','#2980b9','#8e44ad','#2c3e50',
            '#f1c40f','#e67e22','#e74c3c','#ecf0f1','#95a5a6',
            '#f39c12','#d35400','#c0392b','#bdc3c7','#7f8c8d',
            '#f6e58d','#ffbe76','#ff7979','#badc58','#dff9fb',
            '#f9ca24','#f0932b','#eb4d4b','#6ab04c','#c7ecee',
            '#7ed6df','#e056fd','#686de0','#30336b','#95afc0',
            '#22a6b3','#be2edd','#4834d4','#130f40','#535c68',
            '#00a8ff','#9c88ff','#fbc531','#4cd137','#487eb0',
            '#0097e6','#8c7ae6','#e1b12c','#44bd32','#40739e',
            '#e84118','#f5f6fa','#7f8fa6','#273c75','#353b48',
            '#c23616','#dcdde1','#718093','#192a56','#2f3640',
            '#ff9ff3','#feca57','#ff6b6b','#48dbfb','#10ac84',
            '#f368e0','#ff9f43','#ee5253','#0abde3','#ffb8b8',
            '#00d2d3','#54a0ff','#5f27cd','#c8d6e5','#576574',
            '#01a3a4','#2e86de','#341f97','#8395a7','#222f3e',
            '#FEA47F','#25CCF7','#EAB543','#55E6C1','#CAD3C8',
            '#F97F51','#1B9CFC','#F8EFBA','#58B19F','#2C3A47',
            '#B33771','#3B3B98','#FD7272','#9AECDB','#D6A2E8',
            '#6D214F','#182C61','#FC427B','#BDC581','#82589F'
        ];
        $no = 0;
        $color=[];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('URL_PBB').'/sismiop/sig_api/GetsPublicData/npwp'); // Set the URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
        curl_setopt($ch, CURLOPT_POST, true); // Set the request method to POST
        $postDataString = http_build_query($postData);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataString);
        $response = curl_exec($ch);
        if ($response === false) {
            echo 'cURL Error: ' . curl_error($ch);
        } else {
            $data = json_decode($response);

            foreach ($data->data as $key => $value) {
                $datas[$key] =[];

                $color[$key] =$listColor[$no];
                $detailHitung .= '<div class="row" style="margin-top: 5px">'.
                        '<div class="col-md-1">'.
                            '<div class="" style="opacity: 0.4;background-color: '.$listColor[$no].';height: 15px;width: 15px"></div>'.
                        '</div>'.
                        '<div class="col-md-8"><span style="font-size: 12px">'.str_replace('_',' ',$key).'</span></div>'.
                        '<div class="col-md-3"><span style="font-size: 12px">['.count($data->data->$key).']</span></div>'.
                    '</div>';
                    $no++;
                foreach ($value as $k => $v) {
                    $nop = str_replace('.','',str_replace('-','',$v->NOP));
                    array_push($datas[$key],$nop);
                }
            }
            
        }
        curl_close($ch);
            $param=  $request["KD_PROPINSI"].$request["KD_DATI2"].$request["KD_KECAMATAN"].$request["KD_KELURAHAN"];
            $maps = DB::table('nops')
            ->select(DB::raw('nops.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->whereRaw("d_nop like '%{$param}%'")->get();
       
        $style = [];
        foreach ($maps as $key => $value) {
            foreach ($datas as $k => $v) {
                // dd(count($datas[$k])); 
                
                // dd($value->d_nop);
                if (in_array($value->d_nop,$datas[$k])) {
                    $maps[$key]->color = $color[$k];
                    array_push($style,$maps[$key]);

                    // array_push($maps[$key],['jns' => $k]);
                    // echo $key;
                }
            }
        }


        if ($maps->isEmpty()) {
            return json_encode(['msg' => 'Data Kosong','sts' => 'fail']);
        } else {
           
			$str= '{"type" : "FeatureCollection", "features" : [';

           foreach ($style as $key => $value) {
                // dd($value);
				if (!empty($value->geom)) {
                    // do something
                    $text  = '{"type": "Feature", "geometry":'.$value->geom.',"properties":';
                    unset($value->geom);
                    //     $k = strtolower($k);
                    //     // unset($value['geom']);
                    
                    //     $a[$k]=$v;   
                    // }
                    $text .=json_encode($value); 
                    
                    $str .= $text.'},';
                }
           }
           $str = substr($str,0,-1);
            $str .= ']}';
            // return $str;
        //    dd($str);
           return json_encode(['msg' => 'Ada Data', 'sts' => 'success','data' =>$str,'detail' => $detailHitung]);
        }
    }
    function nik(Request $request) {
        $postData=  $request->all();
        $datas=[];
        $detailHitung = '';
        $listColor= [ 
            'red','#2ecc71','yellow','#9b59b6','#34495e',
            '#16a085','#27ae60','#2980b9','#8e44ad','#2c3e50',
            '#f1c40f','#e67e22','#e74c3c','#ecf0f1','#95a5a6',
            '#f39c12','#d35400','#c0392b','#bdc3c7','#7f8c8d',
            '#f6e58d','#ffbe76','#ff7979','#badc58','#dff9fb',
            '#f9ca24','#f0932b','#eb4d4b','#6ab04c','#c7ecee',
            '#7ed6df','#e056fd','#686de0','#30336b','#95afc0',
            '#22a6b3','#be2edd','#4834d4','#130f40','#535c68',
            '#00a8ff','#9c88ff','#fbc531','#4cd137','#487eb0',
            '#0097e6','#8c7ae6','#e1b12c','#44bd32','#40739e',
            '#e84118','#f5f6fa','#7f8fa6','#273c75','#353b48',
            '#c23616','#dcdde1','#718093','#192a56','#2f3640',
            '#ff9ff3','#feca57','#ff6b6b','#48dbfb','#10ac84',
            '#f368e0','#ff9f43','#ee5253','#0abde3','#ffb8b8',
            '#00d2d3','#54a0ff','#5f27cd','#c8d6e5','#576574',
            '#01a3a4','#2e86de','#341f97','#8395a7','#222f3e',
            '#FEA47F','#25CCF7','#EAB543','#55E6C1','#CAD3C8',
            '#F97F51','#1B9CFC','#F8EFBA','#58B19F','#2C3A47',
            '#B33771','#3B3B98','#FD7272','#9AECDB','#D6A2E8',
            '#6D214F','#182C61','#FC427B','#BDC581','#82589F'
        ];
        $no = 0;
        $color=[];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('URL_PBB').'/sismiop/sig_api/GetsPublicData/nik'); // Set the URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
        curl_setopt($ch, CURLOPT_POST, true); // Set the request method to POST
        $postDataString = http_build_query($postData);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataString);
        $response = curl_exec($ch);
        if ($response === false) {
            echo 'cURL Error: ' . curl_error($ch);
        } else {
            $data = json_decode($response);
            
            foreach ($data->data as $key => $value) {
                $datas[$key] =[];

                $color[$key] =$listColor[$no];
                $detailHitung .= '<div class="row" style="margin-top: 5px">'.
                        '<div class="col-md-1">'.
                            '<div class="" style="opacity: 0.4;background-color: '.$listColor[$no].';height: 15px;width: 15px"></div>'.
                        '</div>'.
                        '<div class="col-md-8"><span style="font-size: 12px">'.str_replace('_',' ',$key).'</span></div>'.
                        '<div class="col-md-3"><span style="font-size: 12px">['.count($data->data->$key).']</span></div>'.
                    '</div>';
                    $no++;
                foreach ($value as $k => $v) {
                    $nop = str_replace('.','',str_replace('-','',$v->NOP));
                    array_push($datas[$key],$nop);
                }
            }
            
        }
        curl_close($ch);
            $param=  $request["KD_PROPINSI"].$request["KD_DATI2"].$request["KD_KECAMATAN"].$request["KD_KELURAHAN"];
            $maps = DB::table('nops')
            ->select(DB::raw('nops.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->whereRaw("d_nop like '%{$param}%'")->get();
       
        $style = [];
        foreach ($maps as $key => $value) {
            foreach ($datas as $k => $v) {
                // dd(count($datas[$k])); 
                
                // dd($value->d_nop);
                if (in_array($value->d_nop,$datas[$k])) {
                    $maps[$key]->color = $color[$k];
                    array_push($style,$maps[$key]);

                    // array_push($maps[$key],['jns' => $k]);
                    // echo $key;
                }
            }
        }


        if ($maps->isEmpty()) {
            return json_encode(['msg' => 'Data Kosong','sts' => 'fail']);
        } else {
           
			$str= '{"type" : "FeatureCollection", "features" : [';

           foreach ($style as $key => $value) {
                // dd($value);
				if (!empty($value->geom)) {
                    // do something
                    $text  = '{"type": "Feature", "geometry":'.$value->geom.',"properties":';
                    unset($value->geom);
                    //     $k = strtolower($k);
                    //     // unset($value['geom']);
                    
                    //     $a[$k]=$v;   
                    // }
                    $text .=json_encode($value); 
                    
                    $str .= $text.'},';
                }
           }
           $str = substr($str,0,-1);
            $str .= ']}';
            // return $str;
        //    dd($str);
           return json_encode(['msg' => 'Ada Data', 'sts' => 'success','data' =>$str,'detail' => $detailHitung]);
        }
    }
    function kelas_tanah(Request $request) {
        $postData=  $request->all();
        $datas=[];
        $detailHitung = '';
        $listColor= [ 
            'red','#2ecc71','yellow','#9b59b6','#34495e',
            '#16a085','#27ae60','#2980b9','#8e44ad','#2c3e50',
            '#f1c40f','#e67e22','#e74c3c','#ecf0f1','#95a5a6',
            '#f39c12','#d35400','#c0392b','#bdc3c7','#7f8c8d',
            '#f6e58d','#ffbe76','#ff7979','#badc58','#dff9fb',
            '#f9ca24','#f0932b','#eb4d4b','#6ab04c','#c7ecee',
            '#7ed6df','#e056fd','#686de0','#30336b','#95afc0',
            '#22a6b3','#be2edd','#4834d4','#130f40','#535c68',
            '#00a8ff','#9c88ff','#fbc531','#4cd137','#487eb0',
            '#0097e6','#8c7ae6','#e1b12c','#44bd32','#40739e',
            '#e84118','#f5f6fa','#7f8fa6','#273c75','#353b48',
            '#c23616','#dcdde1','#718093','#192a56','#2f3640',
            '#ff9ff3','#feca57','#ff6b6b','#48dbfb','#10ac84',
            '#f368e0','#ff9f43','#ee5253','#0abde3','#ffb8b8',
            '#00d2d3','#54a0ff','#5f27cd','#c8d6e5','#576574',
            '#01a3a4','#2e86de','#341f97','#8395a7','#222f3e',
            '#FEA47F','#25CCF7','#EAB543','#55E6C1','#CAD3C8',
            '#F97F51','#1B9CFC','#F8EFBA','#58B19F','#2C3A47',
            '#B33771','#3B3B98','#FD7272','#9AECDB','#D6A2E8',
            '#6D214F','#182C61','#FC427B','#BDC581','#82589F'
        ];
        $no = 0;
        $color=[];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('URL_PBB').'/sismiop/sig_api/GetsPublicData/kelasTanah'); // Set the URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
        curl_setopt($ch, CURLOPT_POST, true); // Set the request method to POST
        $postDataString = http_build_query($postData);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataString);
        $response = curl_exec($ch);
        if ($response === false) {
            echo 'cURL Error: ' . curl_error($ch);
        } else {
            $data = json_decode($response);

            foreach ($data->data as $key => $value) {
                $datas[$key] =[];

                $color[$key] =$listColor[$no];
                $detailHitung .= '<div class="row" style="margin-top: 5px">'.
                        '<div class="col-md-1">'.
                            '<div class="" style="opacity: 0.4;background-color: '.$listColor[$no].';height: 15px;width: 15px"></div>'.
                        '</div>'.
                        '<div class="col-md-8"><span style="font-size: 12px">'.str_replace('_',' ',$key).'</span></div>'.
                        '<div class="col-md-3"><span style="font-size: 12px">['.count($data->data->$key).']</span></div>'.
                    '</div>';
                    $no++;
                foreach ($value as $k => $v) {
                    $nop = str_replace('.','',str_replace('-','',$v->NOP));
                    array_push($datas[$key],$nop);
                }
            }
            
        }
        curl_close($ch);
            $param=  $request["KD_PROPINSI"].$request["KD_DATI2"].$request["KD_KECAMATAN"].$request["KD_KELURAHAN"];
            $maps = DB::table('nops')
            ->select(DB::raw('nops.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->whereRaw("d_nop like '%{$param}%'")->get();
       
        $style = [];
        foreach ($maps as $key => $value) {
            foreach ($datas as $k => $v) {
                // dd(count($datas[$k])); 
                
                // dd($value->d_nop);
                if (in_array($value->d_nop,$datas[$k])) {
                    $maps[$key]->color = $color[$k];
                    array_push($style,$maps[$key]);

                    // array_push($maps[$key],['jns' => $k]);
                    // echo $key;
                }
            }
        }


        if ($maps->isEmpty()) {
            return json_encode(['msg' => 'Data Kosong','sts' => 'fail']);
        } else {
           
			$str= '{"type" : "FeatureCollection", "features" : [';

           foreach ($style as $key => $value) {
                // dd($value);
				if (!empty($value->geom)) {
                    // do something
                    $text  = '{"type": "Feature", "geometry":'.$value->geom.',"properties":';
                    unset($value->geom);
                    //     $k = strtolower($k);
                    //     // unset($value['geom']);
                    
                    //     $a[$k]=$v;   
                    // }
                    $text .=json_encode($value); 
                    
                    $str .= $text.'},';
                }
           }
           $str = substr($str,0,-1);
            $str .= ']}';
            // return $str;
        //    dd($str);
           return json_encode(['msg' => 'Ada Data', 'sts' => 'success','data' =>$str,'detail' => $detailHitung]);
        }
    }
    function kelas_bangunan(Request $request) {
        $postData=  $request->all();
        $datas=[];
        $detailHitung = '';
        $listColor= [ 
            'red','#2ecc71','yellow','#9b59b6','#34495e',
            '#16a085','#27ae60','#2980b9','#8e44ad','#2c3e50',
            '#f1c40f','#e67e22','#e74c3c','#ecf0f1','#95a5a6',
            '#f39c12','#d35400','#c0392b','#bdc3c7','#7f8c8d',
            '#f6e58d','#ffbe76','#ff7979','#badc58','#dff9fb',
            '#f9ca24','#f0932b','#eb4d4b','#6ab04c','#c7ecee',
            '#7ed6df','#e056fd','#686de0','#30336b','#95afc0',
            '#22a6b3','#be2edd','#4834d4','#130f40','#535c68',
            '#00a8ff','#9c88ff','#fbc531','#4cd137','#487eb0',
            '#0097e6','#8c7ae6','#e1b12c','#44bd32','#40739e',
            '#e84118','#f5f6fa','#7f8fa6','#273c75','#353b48',
            '#c23616','#dcdde1','#718093','#192a56','#2f3640',
            '#ff9ff3','#feca57','#ff6b6b','#48dbfb','#10ac84',
            '#f368e0','#ff9f43','#ee5253','#0abde3','#ffb8b8',
            '#00d2d3','#54a0ff','#5f27cd','#c8d6e5','#576574',
            '#01a3a4','#2e86de','#341f97','#8395a7','#222f3e',
            '#FEA47F','#25CCF7','#EAB543','#55E6C1','#CAD3C8',
            '#F97F51','#1B9CFC','#F8EFBA','#58B19F','#2C3A47',
            '#B33771','#3B3B98','#FD7272','#9AECDB','#D6A2E8',
            '#6D214F','#182C61','#FC427B','#BDC581','#82589F'
        ];
        $no = 0;
        $color=[];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('URL_PBB').'/sismiop/sig_api/GetsPublicData/kelasBangunan'); // Set the URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
        curl_setopt($ch, CURLOPT_POST, true); // Set the request method to POST
        $postDataString = http_build_query($postData);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataString);
        $response = curl_exec($ch);
        if ($response === false) {
            echo 'cURL Error: ' . curl_error($ch);
        } else {
            $data = json_decode($response);

            foreach ($data->data as $key => $value) {
                $datas[$key] =[];
                // dd($listColor[$no]);
                $color[$key] =$listColor[$no];
                // $color[$key] =$no;
                
                
                $detailHitung .= '<div class="row" style="margin-top: 5px">'.
                        '<div class="col-md-1">'.
                            '<div class="" style="opacity: 0.4;background-color: '.$listColor[$no].';height: 15px;width: 15px"></div>'.
                        '</div>'.
                        '<div class="col-md-8"><span style="font-size: 12px">'.str_replace('_',' ',$key).'</span></div>'.
                        '<div class="col-md-3"><span style="font-size: 12px">['.count($data->data->$key).']</span></div>'.
                    '</div>';
                    $no++;
                foreach ($value as $k => $v) {
                    $nop = str_replace('.','',str_replace('-','',$v->NOP));
                    array_push($datas[$key],$nop);
                }
            }
            
        }
        curl_close($ch);
            $param=  $request["KD_PROPINSI"].$request["KD_DATI2"].$request["KD_KECAMATAN"].$request["KD_KELURAHAN"];
            $maps = DB::table('nops')
            ->select(DB::raw('nops.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->whereRaw("d_nop like '%{$param}%'")->get();
       
        $style = [];
        foreach ($maps as $key => $value) {
            foreach ($datas as $k => $v) {
                // dd(count($datas[$k])); 
                
                // dd($value->d_nop);
                if (in_array($value->d_nop,$datas[$k])) {
                    $maps[$key]->color = $color[$k];
                    array_push($style,$maps[$key]);

                    // array_push($maps[$key],['jns' => $k]);
                    // echo $key;
                }
            }
        }


        if ($maps->isEmpty()) {
            return json_encode(['msg' => 'Data Kosong','sts' => 'fail']);
        } else {
           
			$str= '{"type" : "FeatureCollection", "features" : [';

           foreach ($style as $key => $value) {
                // dd($value);
				if (!empty($value->geom)) {
                    // do something
                    $text  = '{"type": "Feature", "geometry":'.$value->geom.',"properties":';
                    unset($value->geom);
                    //     $k = strtolower($k);
                    //     // unset($value['geom']);
                    
                    //     $a[$k]=$v;   
                    // }
                    $text .=json_encode($value); 
                    
                    $str .= $text.'},';
                }
           }
           $str = substr($str,0,-1);
            $str .= ']}';
            // return $str;
        //    dd($str);
           return json_encode(['msg' => 'Ada Data', 'sts' => 'success','data' =>$str,'detail' => $detailHitung]);
        }
    }
    function znt(Request $request) {
        $postData=  $request->all();
        $datas=[];
        $detailHitung = '';
        $listColor= [ 
            'red','#2ecc71','yellow','#9b59b6','#34495e',
            '#16a085','#27ae60','#2980b9','#8e44ad','#2c3e50',
            '#f1c40f','#e67e22','#e74c3c','#ecf0f1','#95a5a6',
            '#f39c12','#d35400','#c0392b','#bdc3c7','#7f8c8d',
            '#f6e58d','#ffbe76','#ff7979','#badc58','#dff9fb',
            '#f9ca24','#f0932b','#eb4d4b','#6ab04c','#c7ecee',
            '#7ed6df','#e056fd','#686de0','#30336b','#95afc0',
            '#22a6b3','#be2edd','#4834d4','#130f40','#535c68',
            '#00a8ff','#9c88ff','#fbc531','#4cd137','#487eb0',
            '#0097e6','#8c7ae6','#e1b12c','#44bd32','#40739e',
            '#e84118','#f5f6fa','#7f8fa6','#273c75','#353b48',
            '#c23616','#dcdde1','#718093','#192a56','#2f3640',
            '#ff9ff3','#feca57','#ff6b6b','#48dbfb','#10ac84',
            '#f368e0','#ff9f43','#ee5253','#0abde3','#ffb8b8',
            '#00d2d3','#54a0ff','#5f27cd','#c8d6e5','#576574',
            '#01a3a4','#2e86de','#341f97','#8395a7','#222f3e',
            '#FEA47F','#25CCF7','#EAB543','#55E6C1','#CAD3C8',
            '#F97F51','#1B9CFC','#F8EFBA','#58B19F','#2C3A47',
            '#B33771','#3B3B98','#FD7272','#9AECDB','#D6A2E8',
            '#6D214F','#182C61','#FC427B','#BDC581','#82589F'
        ];
        $no = 0;
        $color=[];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('URL_PBB').'/sismiop/sig_api/GetsPublicData/zonaNilaiTanah'); // Set the URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
        curl_setopt($ch, CURLOPT_POST, true); // Set the request method to POST
        $postDataString = http_build_query($postData);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataString);
        $response = curl_exec($ch);
        if ($response === false) {
            echo 'cURL Error: ' . curl_error($ch);
        } else {
            $data = json_decode($response);

            foreach ($data->data as $key => $value) {
                $datas[$key] =[];
                // dd($listColor[$no]);
                $color[$key] =$listColor[$no];
                // $color[$key] =$no;
                
                $detailHitung .= '<div class="row" style="margin-top: 5px">'.
                        '<div class="col-md-1">'.
                            '<div class="" style="opacity: 0.4;background-color: '.$listColor[$no].';height: 15px;width: 15px"></div>'.
                        '</div>'.
                        '<div class="col-md-8"><span style="font-size: 12px">'.str_replace('_',' ',$key).'</span></div>'.
                        '<div class="col-md-3"><span style="font-size: 12px">['.count($data->data->$key).']</span></div>'.
                    '</div>';
                    $no++;
                foreach ($value as $k => $v) {
                    $nop = str_replace('.','',str_replace('-','',$v->NOP));
                    array_push($datas[$key],$nop);
                }
            }
            
        }
        curl_close($ch);
            $param=  $request["KD_PROPINSI"].$request["KD_DATI2"].$request["KD_KECAMATAN"].$request["KD_KELURAHAN"];
            $maps = DB::table('nops')
            ->select(DB::raw('nops.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->whereRaw("d_nop like '%{$param}%'")->get();
       
        $style = [];
        foreach ($maps as $key => $value) {
            foreach ($datas as $k => $v) {
                // dd(count($datas[$k])); 
                
                // dd($value->d_nop);
                if (in_array($value->d_nop,$datas[$k])) {
                    $maps[$key]->color = $color[$k];
                    array_push($style,$maps[$key]);

                    // array_push($maps[$key],['jns' => $k]);
                    // echo $key;
                }
            }
        }


        if ($maps->isEmpty()) {
            return json_encode(['msg' => 'Data Kosong','sts' => 'fail']);
        } else {
           
			$str= '{"type" : "FeatureCollection", "features" : [';

           foreach ($style as $key => $value) {
                // dd($value);
				if (!empty($value->geom)) {
                    // do something
                    $text  = '{"type": "Feature", "geometry":'.$value->geom.',"properties":';
                    unset($value->geom);
                    //     $k = strtolower($k);
                    //     // unset($value['geom']);
                    
                    //     $a[$k]=$v;   
                    // }
                    $text .=json_encode($value); 
                    
                    $str .= $text.'},';
                }
           }
           $str = substr($str,0,-1);
            $str .= ']}';
            // return $str;
        //    dd($str);
           return json_encode(['msg' => 'Ada Data', 'sts' => 'success','data' =>$str,'detail' => $detailHitung]);
        }
    }
    function buku(Request $request) {
        $postData=  $request->all();
        $datas=[];
        $detailHitung = '';
        $listColor= [ 
            'red','#2ecc71','yellow','#9b59b6','#34495e',
            '#16a085','#27ae60','#2980b9','#8e44ad','#2c3e50',
            '#f1c40f','#e67e22','#e74c3c','#ecf0f1','#95a5a6',
            '#f39c12','#d35400','#c0392b','#bdc3c7','#7f8c8d',
            '#f6e58d','#ffbe76','#ff7979','#badc58','#dff9fb',
            '#f9ca24','#f0932b','#eb4d4b','#6ab04c','#c7ecee',
            '#7ed6df','#e056fd','#686de0','#30336b','#95afc0',
            '#22a6b3','#be2edd','#4834d4','#130f40','#535c68',
            '#00a8ff','#9c88ff','#fbc531','#4cd137','#487eb0',
            '#0097e6','#8c7ae6','#e1b12c','#44bd32','#40739e',
            '#e84118','#f5f6fa','#7f8fa6','#273c75','#353b48',
            '#c23616','#dcdde1','#718093','#192a56','#2f3640',
            '#ff9ff3','#feca57','#ff6b6b','#48dbfb','#10ac84',
            '#f368e0','#ff9f43','#ee5253','#0abde3','#ffb8b8',
            '#00d2d3','#54a0ff','#5f27cd','#c8d6e5','#576574',
            '#01a3a4','#2e86de','#341f97','#8395a7','#222f3e',
            '#FEA47F','#25CCF7','#EAB543','#55E6C1','#CAD3C8',
            '#F97F51','#1B9CFC','#F8EFBA','#58B19F','#2C3A47',
            '#B33771','#3B3B98','#FD7272','#9AECDB','#D6A2E8',
            '#6D214F','#182C61','#FC427B','#BDC581','#82589F'
        ];
        $no = 0;
        $color=[];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('URL_PBB').'/sismiop/sig_api/GetsPublicData/ketetapanPerBuku'); // Set the URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
        curl_setopt($ch, CURLOPT_POST, true); // Set the request method to POST
        $postDataString = http_build_query($postData);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataString);
        $response = curl_exec($ch);
        if ($response === false) {
            echo 'cURL Error: ' . curl_error($ch);
        } else {
            $data = json_decode($response);

            foreach ($data->data as $key => $value) {
                $datas[$key] =[];
                // dd($listColor[$no]);
                $color[$key] =$listColor[$no];
                // $color[$key] =$no;
                
                
                $detailHitung .= '<div class="row" style="margin-top: 5px">'.
                        '<div class="col-md-1">'.
                            '<div class="" style="opacity: 0.4;background-color: '.$listColor[$no].';height: 15px;width: 15px"></div>'.
                        '</div>'.
                        '<div class="col-md-8"><span style="font-size: 12px">'.str_replace('_',' ',$key).'</span></div>'.
                        '<div class="col-md-3"><span style="font-size: 12px">['.count($data->data->$key).']</span></div>'.
                    '</div>';
                    $no++;
                foreach ($value as $k => $v) {
                    $nop = str_replace('.','',str_replace('-','',$v->NOP));
                    array_push($datas[$key],$nop);
                }
            }
            
        }
        curl_close($ch);
            $param=  $request["KD_PROPINSI"].$request["KD_DATI2"].$request["KD_KECAMATAN"].$request["KD_KELURAHAN"];
            $maps = DB::table('nops')
            ->select(DB::raw('nops.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->whereRaw("d_nop like '%{$param}%'")->get();
       
        $style = [];
        foreach ($maps as $key => $value) {
            foreach ($datas as $k => $v) {
                // dd(count($datas[$k])); 
                
                // dd($value->d_nop);
                if (in_array($value->d_nop,$datas[$k])) {
                    $maps[$key]->color = $color[$k];
                    array_push($style,$maps[$key]);

                    // array_push($maps[$key],['jns' => $k]);
                    // echo $key;
                }
            }
        }


        if ($maps->isEmpty()) {
            return json_encode(['msg' => 'Data Kosong','sts' => 'fail']);
        } else {
           
			$str= '{"type" : "FeatureCollection", "features" : [';

           foreach ($style as $key => $value) {
                // dd($value);
				if (!empty($value->geom)) {
                    // do something
                    $text  = '{"type": "Feature", "geometry":'.$value->geom.',"properties":';
                    unset($value->geom);
                    //     $k = strtolower($k);
                    //     // unset($value['geom']);
                    
                    //     $a[$k]=$v;   
                    // }
                    $text .=json_encode($value); 
                    
                    $str .= $text.'},';
                }
           }
           $str = substr($str,0,-1);
            $str .= ']}';
            // return $str;
        //    dd($str);
           return json_encode(['msg' => 'Ada Data', 'sts' => 'success','data' =>$str,'detail' => $detailHitung]);
        }
    }
    function status_pembayaran(Request $request) {
        $postData=  $request->all();
        $datas=[];
        $detailHitung = '';
        $listColor= [ 
            'red','#2ecc71','yellow','#9b59b6','#34495e',
            '#16a085','#27ae60','#2980b9','#8e44ad','#2c3e50',
            '#f1c40f','#e67e22','#e74c3c','#ecf0f1','#95a5a6',
            '#f39c12','#d35400','#c0392b','#bdc3c7','#7f8c8d',
            '#f6e58d','#ffbe76','#ff7979','#badc58','#dff9fb',
            '#f9ca24','#f0932b','#eb4d4b','#6ab04c','#c7ecee',
            '#7ed6df','#e056fd','#686de0','#30336b','#95afc0',
            '#22a6b3','#be2edd','#4834d4','#130f40','#535c68',
            '#00a8ff','#9c88ff','#fbc531','#4cd137','#487eb0',
            '#0097e6','#8c7ae6','#e1b12c','#44bd32','#40739e',
            '#e84118','#f5f6fa','#7f8fa6','#273c75','#353b48',
            '#c23616','#dcdde1','#718093','#192a56','#2f3640',
            '#ff9ff3','#feca57','#ff6b6b','#48dbfb','#10ac84',
            '#f368e0','#ff9f43','#ee5253','#0abde3','#ffb8b8',
            '#00d2d3','#54a0ff','#5f27cd','#c8d6e5','#576574',
            '#01a3a4','#2e86de','#341f97','#8395a7','#222f3e',
            '#FEA47F','#25CCF7','#EAB543','#55E6C1','#CAD3C8',
            '#F97F51','#1B9CFC','#F8EFBA','#58B19F','#2C3A47',
            '#B33771','#3B3B98','#FD7272','#9AECDB','#D6A2E8',
            '#6D214F','#182C61','#FC427B','#BDC581','#82589F'
        ];
        $no = 0;
        $color=[];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('URL_PBB').'/sismiop/sig_api/GetsPublicData/statusPembayaran'); // Set the URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
        curl_setopt($ch, CURLOPT_POST, true); // Set the request method to POST
        $postDataString = http_build_query($postData);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataString);
        $response = curl_exec($ch);
        if ($response === false) {
            echo 'cURL Error: ' . curl_error($ch);
        } else {
            $data = json_decode($response);

            foreach ($data->data as $key => $value) {
                $datas[$key] =[];
                // dd($listColor[$no]);
                $color[$key] =$listColor[$no];
                // $color[$key] =$no;
                
                
                $detailHitung .= '<div class="row" style="margin-top: 5px">'.
                        '<div class="col-md-1">'.
                            '<div class="" style="opacity: 0.4;background-color: '.$listColor[$no].';height: 15px;width: 15px"></div>'.
                        '</div>'.
                        '<div class="col-md-8"><span style="font-size: 12px">'.str_replace('_',' ',$key).'</span></div>'.
                        '<div class="col-md-3"><span style="font-size: 12px">['.count($data->data->$key).']</span></div>'.
                    '</div>';
                
                    $no++;
                foreach ($value as $k => $v) {
                    $nop = str_replace('.','',str_replace('-','',$v->NOP));
                    array_push($datas[$key],$nop);
                }
            }
            
        }
        curl_close($ch);
            $param=  $request["KD_PROPINSI"].$request["KD_DATI2"].$request["KD_KECAMATAN"].$request["KD_KELURAHAN"];
            $maps = DB::table('nops')
            ->select(DB::raw('nops.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->whereRaw("d_nop like '%{$param}%'")->get();
       
        $style = [];
        foreach ($maps as $key => $value) {
            foreach ($datas as $k => $v) {
                // dd(count($datas[$k])); 
                
                // dd($value->d_nop);
                if (in_array($value->d_nop,$datas[$k])) {
                    $maps[$key]->color = $color[$k];
                    array_push($style,$maps[$key]);

                    // array_push($maps[$key],['jns' => $k]);
                    // echo $key;
                }
            }
        }


        if ($maps->isEmpty()) {
            return json_encode(['msg' => 'Data Kosong','sts' => 'fail']);
        } else {
           
			$str= '{"type" : "FeatureCollection", "features" : [';

           foreach ($style as $key => $value) {
                // dd($value);
				if (!empty($value->geom)) {
                    // do something
                    $text  = '{"type": "Feature", "geometry":'.$value->geom.',"properties":';
                    unset($value->geom);
                    //     $k = strtolower($k);
                    //     // unset($value['geom']);
                    
                    //     $a[$k]=$v;   
                    // }
                    $text .=json_encode($value); 
                    
                    $str .= $text.'},';
                }
           }
           $str = substr($str,0,-1);
            $str .= ']}';
            // return $str;
        //    dd($str);
           return json_encode(['msg' => 'Ada Data', 'sts' => 'success','data' =>$str,'detail' => $detailHitung]);
        }
    }
    function getTematik(Request $request) {
        $postData=  $request->all();

        $datas=[];
        $detailHitung = '';
        $listColor= [ 
            'red','#2ecc71','yellow','#9b59b6','#34495e',
            '#16a085','#27ae60','#2980b9','#8e44ad','#2c3e50',
            '#f1c40f','#e67e22','#e74c3c','#ecf0f1','#95a5a6',
            '#f39c12','#d35400','#c0392b','#bdc3c7','#7f8c8d',
            '#f6e58d','#ffbe76','#ff7979','#badc58','#dff9fb',
            '#f9ca24','#f0932b','#eb4d4b','#6ab04c','#c7ecee',
            '#7ed6df','#e056fd','#686de0','#30336b','#95afc0',
            '#22a6b3','#be2edd','#4834d4','#130f40','#535c68',
            '#00a8ff','#9c88ff','#fbc531','#4cd137','#487eb0',
            '#0097e6','#8c7ae6','#e1b12c','#44bd32','#40739e',
            '#e84118','#f5f6fa','#7f8fa6','#273c75','#353b48',
            '#c23616','#dcdde1','#718093','#192a56','#2f3640',
            '#ff9ff3','#feca57','#ff6b6b','#48dbfb','#10ac84',
            '#f368e0','#ff9f43','#ee5253','#0abde3','#ffb8b8',
            '#00d2d3','#54a0ff','#5f27cd','#c8d6e5','#576574',
            '#01a3a4','#2e86de','#341f97','#8395a7','#222f3e',
            '#FEA47F','#25CCF7','#EAB543','#55E6C1','#CAD3C8',
            '#F97F51','#1B9CFC','#F8EFBA','#58B19F','#2C3A47',
            '#B33771','#3B3B98','#FD7272','#9AECDB','#D6A2E8',
            '#6D214F','#182C61','#FC427B','#BDC581','#82589F'
        ];
        $no = 0;
        $color=[];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('URL_PBB').'/sismiop/sig_api/GetsPublicData/'.$request['url']); // Set the URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
        curl_setopt($ch, CURLOPT_POST, true); // Set the request method to POST
        $postDataString = http_build_query($postData);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataString);
        $response = curl_exec($ch);
        if ($response === false) {
           return json_encode(['sts' => 'fail']);
           exit();

        } else {
            $data = json_decode($response);
            foreach ($data->data as $key => $value) {
                // dd($value[0]);
                
              
                
                $datas[$key] =[];
                // dd($listColor[$no]);
                $color[$key] =$listColor[$no];
                // $color[$key] =$no;
                $nir='';
                if($request['url'] == 'zonaNilaiTanah'){
                    $nir =  ' - NIR: '.$value[0]->NIR;
                }

                $detailHitung .= '<div class="row" style="margin-top: 5px">'.
                '<div class="col-md-1">'.
                    '<div class="" style="opacity: 0.4;background-color: '.$listColor[$no].';height: 12px;width: 12px;margin-top:3px"></div>'.
                '</div>'.
                '<div class="col-md-7"><span style="white-space: nowrap;font-size: 8pt">'.str_replace('_',' ',$key).$nir.'</span></div>'.
                '<div class="col-md-3"><span style="white-space: nowrap;font-size: 8pt">['.count($data->data->$key).']</span></div>'.
            '</div>';
                
                    $no++;
                foreach ($value as $k => $v) {
                    $nop = str_replace('.','',str_replace('-','',$v->NOP));
                    array_push($datas[$key],$nop);
                }
            }
            
        }
        curl_close($ch);
            $param=  $request["KD_PROPINSI"].$request["KD_DATI2"].$request["KD_KECAMATAN"].$request["KD_KELURAHAN"];
            $maps = DB::table('nops')
            ->select(DB::raw('nops.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->whereRaw("d_nop like '%{$param}%'")->get();
       
        $style = [];
        foreach ($maps as $key => $value) {
            foreach ($datas as $k => $v) {
                // dd(count($datas[$k])); 
                
                // dd($value->d_nop);
                if (in_array($value->d_nop,$datas[$k])) {
                    $maps[$key]->color = $color[$k];
                    array_push($style,$maps[$key]);

                    // array_push($maps[$key],['jns' => $k]);
                    // echo $key;
                }
            }
        }


        if ($maps->isEmpty()) {
            return json_encode(['msg' => 'Data Kosong','sts' => 'fail']);
        } else {
           
			$str= '{"type" : "FeatureCollection", "features" : [';

           foreach ($maps as $key => $value) {
                // dd($value);
				if (!empty($value->geom)) {
                    // do something
                    $text  = '{"type": "Feature", "geometry":'.$value->geom.',"properties":';
                    unset($value->geom);
                    //     $k = strtolower($k);
                    //     // unset($value['geom']);
                    
                    //     $a[$k]=$v;   
                    // }
                    $text .=json_encode($value); 
                    
                    $str .= $text.'},';
                }
           }
           $str = substr($str,0,-1);
            $str .= ']}';
            // return $str;
        //    dd($str);
           return json_encode(['msg' => 'Ada Data', 'sts' => 'success','data' =>$str,'detail' => $detailHitung]);
        }
    }

    function informasiOP(Request $request) {
        
        $postData=  $request->all();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('URL_PBB').'/sismiop/sig_api/GetsPublicData/InformasiOp'); // Set the URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
        curl_setopt($ch, CURLOPT_POST, true); // Set the request method to POST
        $postDataString = http_build_query($postData);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataString);
        $response = curl_exec($ch);
        if ($response === false) {
            echo 'cURL Error: ' . curl_error($ch);
        } else {
            $data = json_decode($response);
            $folderPath = storage_path('app/public/uploads/'.str_replace('.','',$request['NOP'])); // Ganti dengan path folder yang ingin Anda periksa
            // Gunakan glob() untuk mencocokkan file dalam folder
            // dd($folderPath);
            $files = glob($folderPath . '/*');
            $data->img = [];
            foreach ($files as $file) {
                $file = explode('public/',$file);
                array_push($data->img,$file[1]);
            }
            return json_encode($data);
            
        }
        curl_close($ch);
    }
        
    function getPrintPeta($blok){
        $nop = DB::table('nops')
            ->select(DB::raw('nops.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->where('d_nop', 'like', '%' . $blok . '%')
            ->get();
        $str_nop= '{"type" : "FeatureCollection", "features" : [';
        foreach ($nop as $key => $value) {
                
                $text  = '{"type": "Feature", "geometry":'.$value->geom.',"properties":';
                unset($value->geom);
                $text .=json_encode($value); 
                
                $str_nop .= $text.'},';
        }
        $str_nop = substr($str_nop,0,-1);
        $str_nop .= ']}';
        $bloks = DB::table('bloks')
            ->select(DB::raw('bloks.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->where('d_blok', 'like', '%' . $blok . '%')
            ->get();
        $str_blok= '{"type" : "FeatureCollection", "features" : [';
            foreach ($bloks as $key => $value) {
                    
                    $text  = '{"type": "Feature", "geometry":'.$value->geom.',"properties":';
                    unset($value->geom);
                    $text .=json_encode($value); 
                    
                    $str_blok .= $text.'},';
            }
            $str_blok = substr($str_blok,0,-1);
            $str_blok .= ']}';

            $bg  = DB::table('bangunans')
            ->select(DB::raw('bangunans.*,ST_AsGeoJSON(geom)::json as geom' ))
            ->where('d_nop', 'like', '%' . $blok . '%')
            ->get();
        $str_bg= '{"type" : "FeatureCollection", "features" : [';
            foreach ($bg as $key => $value) {
                    
                    $text  = '{"type": "Feature", "geometry":'.$value->geom.',"properties":';
                    unset($value->geom);
                    $text .=json_encode($value); 
                    
                    $str_bg .= $text.'},';
            }
            $str_bg = substr($str_bg,0,-1);
            $str_bg .= ']}';

        return json_encode(['msg' => 'Ada Data', 'sts' => 'success','nop' =>$str_nop,'blok' =>$str_blok,'bg' =>$str_bg]);
        
    }

}
            