<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelUser;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Auth;

class Login_Con extends Controller
{
    public function login(){
        $villages = DB::select("SELECT villages.id, villages.name FROM villages JOIN districts ON villages.district_id=districts.id JOIN regencies ON districts.regency_id = regencies.id JOIN provinces ON regencies.province_id = provinces.id WHERE provinces.id = 32");
        $regency = DB::select("SELECT DISTINCT regencies.id, regencies.name FROM regencies JOIN provinces ON regencies.province_id = provinces.id WHERE provinces.id = 32");
    	return view('login', compact('villages', 'regency'));
    }
    
    public function autoLogin(Request $request){
        $user = ModelUser::where('email',$request->email)->first();
        // dd($request->all());
        if(Auth::loginUsingId($user->id, true)){
            $data_lokasi = Location::get($_SERVER['REMOTE_ADDR']); //nanti diganti jadi Location::get($_SERVER['REMOTE_ADDR'])
            $agent = new Agent();
            if($agent->isPhone()){
                // $device = $agent->device(); //Get the device name, if mobile. (iPhone, Nexus, AsusTablet, ...)
                $device = $agent->browser(); //get browser (chrome, mozilla, ...)
            }else{
                $device = $agent->platform(); //Get the operating system. (Ubuntu, Windows, OS X, ...)
            }
            DB::table('aktifitas_login')->insert([
                        'tanggal'       => date("Y-m-d H:i:s"),
                        'ip_address'    => $_SERVER['REMOTE_ADDR'],
                        'longitude'     => $data_lokasi->longitude,
                        'latitude'      => $data_lokasi->latitude,
                        'kota'          => $data_lokasi->cityName.', '.$data_lokasi->regionName.', '.$data_lokasi->countryName,
                        'device'        => $device,
                        'true_false'    => '',
                        'id_pengguna'   => auth()->user()->pengguna->id_pengguna
                    ]);
            $data = DB::select("SELECT * FROM hapus_akun WHERE id_pengguna = '".auth()->user()->pengguna->id_pengguna."'");
            if($data){
                DB::table('hapus_akun')->where('id_pengguna', auth()->user()->pengguna->id_pengguna)->delete();
            }
            return redirect()->intended('/sosial-media/beranda');
        }
        return redirect()->intended('/sosial-media');
    }


    public function get_district($id_regency){
        $data = DB::select("SELECT districts.id, districts.name FROM districts WHERE regency_id = '".$id_regency."'");
        return response()->json($data);
    }

    public function get_village($id_district){
        $data = DB::select("SELECT villages.id, villages.name FROM villages WHERE district_id = '".$id_district."'");
        return response()->json($data);
    }

    public function check_username($username){
		if (Auth::check()) {
			if (auth()->user()->pengguna->username != $username) {
				$data = DB::table('pengguna')->where('username', $username)->get();
			} else {
				$data = [];
			}
		} else {
			$data = DB::table('pengguna')->where('username', $username)->get();
		}
		
        return response()->json($data);
    }

    public function check_email($email){
		if (Auth::check()) {
			if (auth()->user()->pengguna->email != $email) {
				$data = DB::table('pengguna')->where('email', $email)->get();
			} else {
				$data = [];
			}
		} else {
			$data = DB::table('pengguna')->where('email', $email)->get();
		}
		
        return response()->json($data);
    }
    
    public function register(Request $request){
        // return response()->json([
        //         'success' => 1,
        //         'message'  => $request->all()
        //         ]);

        $tgl = date("Y-m-d H:i:s");
        if($request->role != 'USER'){
            $id = DB::table('pengguna')->insertGetId([
                'jenis_akun'    =>  'desa',
                'username'      =>  $request->username,
                'password'      =>  $request->password,
                'nama'          =>  ucwords(strtolower($request->nama)),
                'village_id'    =>  $request->village_id,
                'website'       =>  'https://desaku-desatour.masuk.id/pariwisata-wisata-filter?kota[]='.$request->regency_id.'&kecamatan[]='.$request->district_id.'&desa[]='.$request->village_id,
                'youtube'       =>  'https://desatube.masuk.web.id/search?query='.$request->nama,
                'berita'        =>  'http://marketpalcedesaku.masuk.web.id/stores/'.$request->village_id,
                'marketplace'   =>  'http://marketpalcedesaku.masuk.web.id/stores/'.$request->village_id,
                'email'         =>  $request->email,
                'nomor_hp'      =>  $request->nomor_hp,
                'tgl_join'      =>  $tgl
                ]);
        }else{
            $tgl = date("Y-m-d H:i:s");
            $id = DB::table('pengguna')->insertGetId([
                'jenis_akun'    =>  'pribadi',
                'username'      =>  $request->username,
                'password'      =>  $request->password,
                'nama'          =>  ucwords(strtolower($request->nama)),
                'village_id'    =>  $request->village_id,
                'email'         =>  $request->email,
                'nomor_hp'      =>  $request->nomor_hp,
                'tgl_join'      =>  $tgl
                ]);
        }
        

        DB::table('pengguna')->where('id_pengguna', $id)->update(['id' => $id]);


        DB::table('users')->insert([
            'id'            =>  $id,
            'name'          =>  ucwords(strtolower($request->nama)),
            'email'         =>  $request->email,
            'password'      =>  $request->password,
            'created_at'    =>  $tgl,
            'updated_at'    =>  $tgl
            ]);

        DB::table('pengaturan')->insert([
            'notifikasi_menyukai'   => 'dari semua orang',
            'notifikasi_komentar'   => 'dari semua orang',
            'notifikasi_pesan'      => 'dari semua orang',
            'akun_privat'           => 'tidak',
            'id_pengguna'           => $id
            ]);
            
        if($id){
            return response()->json([
                'success' => 1,
                'message'  => 'berhasil'
                ]);
        }else{
            return response()->json([
                'error' => 1,
                'message'  => 'gagal'
                ]);
        }
    }

    public function register_proses(Request $request){
        // dd($request->all());
    	$this->validate($request, [
    		'konfirmasi_password'=>'same:password',
    		]);
        date_default_timezone_set("Asia/Jakarta");

        $file_prof = $request->file('foto_prof');
        $file_samp = $request->file('foto_samp');
        $nama_file_prof = $file_prof->getClientOriginalName();
        $nama_file_samp = $file_samp->getClientOriginalName();
        
        $data = explode("+++",$request->nama_desa);
        $data_district = explode("+++",$request->nama_kec);
        $data_regency = explode("+++",$request->nama_kab);
    
        $nama = $data[0];
        $nm = substr($nama, 5);
        $village_id = $data[1];
        $district_id = $data_district[1];
        $regency_id = $data_regency[1];
        $province_id = 32;
        if($request->jenis_akun == 'desa'){
            // $data = explode("+++",$request->nama_desa);
            // $data_district = explode("+++",$request->nama_kec);
            // $data_regency = explode("+++",$request->nama_kab);
        
            // $nama = $data[0];
            // $nm = substr($nama, 5);
            // $village_id = $data[1];
            // $district_id = $data_district[1];
            // $regency_id = $data_regency[1];
            // $province_id = 32;
            $tgl = date("Y-m-d H:i:s");
            $id = DB::table('pengguna')->insertGetId([
                'jenis_akun'    =>  $request->jenis_akun,
                'username'      =>  $request->username,
                'password'      =>  $request->password,
                'nama'          =>  ucwords(strtolower($nama)),
                'village_id'    =>  $village_id,
                'website'       =>  'https://desaku-desatour.masuk.id/pariwisata-wisata-filter?kota[]='.$regency_id.'&kecamatan[]='.$district_id.'&desa[]='.$village_id,
                'youtube'       =>  'https://desatube.masuk.web.id/search?query='.$nm,
                'berita'        =>  'https://desaku-desanews.masuk.id/'.$village_id,
                'marketplace'   =>  'http://marketpalcedesaku.masuk.web.id/stores/'.$village_id,
                'email'         =>  $request->email,
                'nomor_hp'      =>  $request->nomor_hp,
                'foto_profil'   =>  $nama_file_prof,
                'foto_sampul'   =>  $nama_file_samp,
                'tgl_join'      =>  $tgl
                ]);

            DB::table('pengguna')->where('id_pengguna', $id)->update(['id' => $id]);
        }else{
            $nama = $request->nama_pribadi;
            // $village_id = 0;
            // $district_id = 0;
            // $regency_id = 0;
            // $province_id = 0;
            $tgl = date("Y-m-d H:i:s");
            $id = DB::table('pengguna')->insertGetId([
                'jenis_akun'    =>  $request->jenis_akun,
                'username'      =>  $request->username,
                'password'      =>  Hash::make($request->password),
                'nama'          =>  ucwords(strtolower($nama)),
                'village_id'    =>  $village_id,
                'email'         =>  $request->email,
                'nomor_hp'      =>  $request->nomor_hp,
                'foto_profil'   =>  $nama_file_prof,
                'foto_sampul'   =>  $nama_file_samp,
                'tgl_join'      =>  $tgl
                ]);

            DB::table('pengguna')->where('id_pengguna', $id)->update(['id' => $id]);
        }

        $nama_folder_prof = 'data_file/'.$request->username.'/foto_profil';
        $tujuan_upload_prof = $nama_folder_prof;
        $file_prof->move($tujuan_upload_prof,$nama_file_prof);

        $nama_folder_samp = 'data_file/'.$request->username.'/foto_sampul';
        $tujuan_upload_samp = $nama_folder_samp;
        $file_samp->move($tujuan_upload_samp,$nama_file_samp);

        DB::table('users')->insert([
            'id'            =>  $id,
            'name'          =>  ucwords(strtolower($nama)),
            'email'         =>  $request->email,
            'password'      =>  Hash::make($request->password),
            'created_at'    =>  $tgl,
            'updated_at'    =>  $tgl
            ]);

        DB::table('pengaturan')->insert([
            'notifikasi_menyukai'   => 'dari semua orang',
            'notifikasi_komentar'   => 'dari semua orang',
            'notifikasi_pesan'      => 'dari semua orang',
            'akun_privat'           => 'tidak',
            'id_pengguna'           => $id
            ]);
        
        if($village_id != 0){       
            $data1 = [
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'id_desa'   => $village_id,
                'name'      => ucwords(strtolower($nama)),
                'from'      => 'desafeed',
                'oleh'      => 'Registrasi',
                'action'    => 'create',
                'desc'      => 'via registration-page'
            ];
            
            $url = 'https://desaku-desacuss.masuk.id/api/register';
        	$data_string = json_encode($data1);
        	$ch=curl_init($url);
        	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        	curl_setopt($ch, CURLOPT_POST, 1);
        	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        	$result = curl_exec($ch);
        	curl_close($ch);
        }
    	
        
        $data2 = array(
    		'name'			=> ucwords(strtolower($nama)),
    	  	'email'			=> $request->email,
    	  	'password'		=> Hash::make($request->password),
    	  	'phone_number'	=> $request->nomor_hp,
    	  	'provinces_id'  => $province_id,
    	  	'regencies_id'	=> $regency_id,
    	  	'districts_id'  => $district_id,
    	  	'villages_id'   => $village_id
    	);
        
        $url = 'https://marketpalcedesaku.masuk.web.id/api/register';
    	$data_string = json_encode($data2);
    	$ch = curl_init($url);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    	$result = curl_exec($ch);
    	curl_close($ch);
    	
    	if($request->jenis_akun == 'desa'){
        	$data3 = array(
        		'name'			=> ucwords(strtolower($nama)),
        	  	'email'			=> $request->email,
        	  	'password'		=> $request->password,
        	  	'villages_id'   => $village_id
        	);
    	
            $url = 'https://desaku-desatour.masuk.id/api/register';
        	$data_string = json_encode($data3);
        	$ch = curl_init($url);
        	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        	curl_setopt($ch, CURLOPT_POST, 1);
        	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        	$result = curl_exec($ch);
        	curl_close($ch);
    	}
    	
    	$data4 = array(
    	  	'name' => ucwords(strtolower($nama)),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'provinsis' => '35',
            'kota_kabupatens' =>$regency_id,
            'kecamatans' => $district_id,
            'kelurahans' => $village_id,

    	);
        
        $url = 'https://desaku-desanews.masuk.id/api/register';
    	$data_string = json_encode($data4);
    	$ch = curl_init($url);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    	$result = curl_exec($ch);
    	curl_close($ch);
    	
    	return redirect('/sosial-media')->with('success','Kamu berhasil Register');
    }

    // public function login_proses(Request $request){
    //     $data_lokasi = Location::get('180.252.55.240'); //nanti diganti jadi Location::get($_SERVER['REMOTE_ADDR'])
    //     // dd($data);
    //     $agent = new Agent();
    //     if($agent->isPhone()){
    //         $device = $agent->device();
    //     }else{
    //         $device = $agent->platform();
    //     }

    // 	$username = $request->username;
    //     $password = $request->password;

    //     $data = ModelUser::where('username',$username)->first();
    //     if($data){ 
    //         if($password == $data->password){
    //             Session::put('id_pengguna',Auth::user()->id);
    //             Session::put('jenis_akun', Auth::user()->pengguna->jenis_akun);
    //             Session::put('nama',$data->nama);
    //             Session::put('username',$data->username);
    //             Session::put('foto_profil',url('/data_file/foto_profil/'.$data->foto_profil));
    //             Session::put('login',TRUE);

    //             DB::table('aktifitas_login')->insert([
    //                 'tanggal'       => date("Y-m-d H:i:s"),
    //                 'ip_address'    => $_SERVER['REMOTE_ADDR'],
    //                 'longitude'     => $request->long,
    //                 'latitude'      => $request->lat,
    //                 'kota'          => $data_lokasi->cityName.', '.$data_lokasi->regionName.', '.$data_lokasi->countryName,
    //                 'device'        => $device,
    //                 'true_false'    => '',
    //                 'id_pengguna'   => auth()->user()->pengguna->id_pengguna
    //             ]);

    //             $data = DB::select("SELECT * FROM hapus_akun WHERE id_pengguna = '".Session::get('id_pengguna')."'");
    //             if($data){
    //                 DB::table('hapus_akun')->where('id_pengguna', Session::get('id_pengguna'))->delete();
    //             }
    //             return redirect('/sosial-media/beranda');
    //         }
    //         else{
    //             return redirect('/sosial-media')->with('alert','Username atau Password, Salah !');
    //         }
    //     }else{
    //         return redirect('/sosial-media')->with('alert','Username atau Password, Salah !');
    //     }
    // }

    public function logout_proses(){
    	Auth::logout();
        return redirect('/sosial-media')->with('alert','Kamu sudah logout');
    }

    public function reset_password(Request $request){
        $data = DB::table('pengguna')->where('email', $request->email)->update([
                'password'=>$request->password
            ]);

        $data_user = DB::table('users')->where('email', $request->email)->update([
                'password'=>Hash::make($request->password)
            ]);

        if($data && $data_user){
            return response()->json([
                    'success'   => 1,
                    'message'   => 'Reset Password Berhasil'
                ]);
        }else{
            return response()->json([
                    'error'   => 1,
                    'message' => 'Reset Password Gagal'
                ]);
        }
    }
  
}
