<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Product;
use App\Lahan;
use App\Category_lahan;
use App\Category;
use App\Sewa_lahan;
use App\Transaction;
use App\ProductGallery;
use App\TransactionDetail;
use App\Pengguna;
use App\Task;
use APp\Link;
use App\Wbs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;


class LahanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     *
     */
    //protected $guarded=[];
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function lahan(){
        $lahan = Lahan::paginate(9);
        $lahan = DB::select("SELECT p.nama as pemilik,l.statusLahan, l.id,l.category_lahan_id,l.ukuran,l.deskripsi,l.gambar, cl.nama, l.id_user, p.username FROM pengguna p JOIN lahans l ON p.id_pengguna = l.id_user JOIN category_lahans cl ON l.category_lahan_id = cl.id WHERE p.id_pengguna != '".Auth::user()->pengguna->id_pengguna."'");
        return view('lahan', compact('lahan'));
        // return view('lahan');
    }

    public function create(){
        //$data['categori']= "select * from category_lahan";
        //$user = User::find($id);
        $categori=category_lahan::all();
        return view('create_lahan',[
            'categori' => $categori,
            'id_pengguna' => Auth::user()->pengguna->id_pengguna
        ]);
    }

    public function simpan(Request $request){
        // menyimpan data file yang diupload ke variabel $file
	    $file = $request->file('gambar');
        
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'gambar_lahan';
        $file->move($tujuan_upload,$file->getClientOriginalName());

        DB::table('lahans')->insert([
            'category_lahan_id' => $request->category_lahan_id,
            'ukuran'            => $request->ukuran,
            'deskripsi'         => $request->deskripsi,
            'gambar'            => $file->getClientOriginalName(),
            'id_user'           => Auth::user()->pengguna->id_pengguna,
            'statusLahan'       => "Ready",
            'updated_at'        => date("Y-m-d H:i:s")
        ]);
        $lahan = DB::select("SELECT p.nama as pemilik, l.id,l.category_lahan_id,l.ukuran,l.deskripsi,l.gambar, cl.nama FROM pengguna p JOIN lahans l ON p.id_pengguna = l.id_user JOIN category_lahans cl ON l.category_lahan_id = cl.id WHERE p.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        return view('kelola_lahan', compact('lahan'));
    }
    public function kelola_lahan(){
        $lahan = DB::select("SELECT p.nama as pemilik, l.id,l.category_lahan_id,l.ukuran,l.deskripsi,l.gambar, cl.nama FROM pengguna p JOIN lahans l ON p.id_pengguna = l.id_user JOIN category_lahans cl ON l.category_lahan_id = cl.id WHERE p.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        return view('kelola_lahan', compact('lahan'));
    }    
    public function ubahlahan($id){
        $categori = category_lahan::all();
        $lahan = Lahan::select('*')->where('id', $id)->get();
        $lahan2 = Lahan::select('*')->where('id', $id)->get();
        return view('ubahlahan', compact('lahan','categori','lahan2'));  
    }

    public function updatelahan(Request $request){
        $file = $request->file('gambar');
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'gambar_lahan';
        $file->move($tujuan_upload,$file->getClientOriginalName());
        
        $lahan = Lahan::where('id', $request->id)->update([
            'category_lahan_id' => $request->category_lahan_id,
            'ukuran' => $request->ukuran,
            'deskripsi' => $request->deskripsi,
            'gambar' => $file->getClientOriginalName()
        ]);
        return redirect('lahan/kelola_lahan');
    }

    public function hapus_lahan($id){
        DB::table('lahans')->where('id',$id)->delete();
        return redirect('lahan/kelola_lahan');
    }
    public function detail_lahan($id){

        $lahan = DB::select("SELECT p.nama as pemilik,l.statusLahan,l.id_user, l.id,l.category_lahan_id,l.ukuran,l.deskripsi,l.gambar, cl.nama FROM pengguna p JOIN lahans l ON p.id_pengguna = l.id_user JOIN category_lahans cl ON l.category_lahan_id = cl.id");
       
        return view('detail_lahan',compact('lahan'));  
    }
   

    public function ubahSewa($id){
        $pengguna = Pengguna::select('*')->where('id_pengguna', Auth::user()->pengguna->id_pengguna)->get();
        $lahan = lahan::select('*')->where('id', $id)->get();
        return view('ubahsewa', compact('pengguna','lahan'));  
    }

    public function updateSewa(Request $request){
        

        $file = $request->file('foto_ktp');
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'foto_ktp';
        $file->move($tujuan_upload,$file->getClientOriginalName());
        
        $pengguna = Pengguna::where('id_pengguna', Auth::user()->pengguna->id_pengguna)->update([
            'alamat' => $request->alamat,
            'nik' => $request->nik,
            'pekerjaan' => $request->pekerjaan,
            'foto_ktp' => $file->getClientOriginalName()
        ]);

        DB::table('sewa_lahans')->insert([
            'id_penyewa'     => Auth::user()->pengguna->id_pengguna,
            'id_pemilik'     => $request->id_pemilik,
            'id_lahan'       => $request->id_lahan,
            'status'         => "Belum Acc",
            'progres'        => "Belum",
            'updated_at'     => date("Y-m-d H:i:s")
        ]);

        return redirect('lahan');
    }
    public function request($id){
        session_start();
        $sewa = DB::select("SELECT nama,alamat,s.id_sewa,s.id_lahan, nik, foto_ktp, id_penyewa, s.status, s.progres FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa WHERE id_pengguna = ANY (SELECT s.id_penyewa FROM lahans l join sewa_lahans s on l.id = s.id_lahan) and s.id_lahan = $id  or p.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        return view('request', compact('sewa'));
    }

    public function accRequest($id){
        session_start();
        $lahan= Lahan::where('id',$_SESSION['id_lahan'])->update([
            'statusLahan' => "Not Ready",
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        $sewa= Sewa_lahan::where('id_penyewa', $id)->update([
            'status' => "Acc" ,
            'progres' => "Proses",
            'updated_at' => date("Y-m-d H:i:s")

        ]);
        //return redirect('lahan/kelola_lahan');
       
        $sewa = DB::select("SELECT nama,alamat, nik, foto_ktp, id_penyewa, s.status, s.progres FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa WHERE id_pengguna = ANY (SELECT s.id_penyewa FROM lahans l join sewa_lahans s on l.id = s.id_lahan) or p.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        return view('request', compact('sewa'));
    }
    public function tolakRequest($id){
        session_start();
        $lahan= Lahan::where('id',$_SESSION['id_lahan'])->update([
            'statusLahan' => "Ready",
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        $sewa= Sewa_lahan::where('id_penyewa', $id)->update([
            'status' => "Tolak" ,
            'progres' => "Gagal",
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        //return redirect('lahan/kelola_lahan');
        
        $sewa = DB::select("SELECT nama,alamat, nik, foto_ktp, id_penyewa,s.id_sewa, s.status, s.progres FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa WHERE id_pengguna = ANY (SELECT s.id_penyewa FROM lahans l join sewa_lahans s on l.id = s.id_lahan) or p.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        return view('request', compact('sewa'));
    }
    public function doneRequest($id){
        $sewa= Sewa_lahan::where('id_sewa', $id)->update([
            'progres' => "Done",
            'updated_at' => date("Y-m-d H:i:s")

        ]);
        //return redirect('lahan/kelola_lahan');
        session_start();
        $sewa = DB::select("SELECT nama,alamat,s.id_sewa, nik, foto_ktp, id_penyewa, s.status, s.progres FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa WHERE id_pengguna = ANY (SELECT s.id_penyewa FROM lahans l join sewa_lahans s on l.id = s.id_lahan) or p.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        return view('request', compact('sewa'));
    }
    public function wbs($id){
        
        $wbs = DB::select("SELECT w.harga, w.qty, w.totalHarga, text, duration,start_date, parent, t.id FROM tasks t JOIN lahans l on t.id_lahan =l.id JOIN wbs w on t.id = w.id_kegiatan");
        return view('wbs', compact('wbs'));
    }
    public function wbs_user($id){
        
        $wbs = DB::select("SELECT w.harga, w.qty, w.totalHarga, text, duration,start_date, parent, t.id FROM tasks t JOIN lahans l on t.id_lahan =l.id JOIN wbs w on t.id = w.id_kegiatan");
        return view('wbs_user', compact('wbs'));
    
    }
    public function simpan_wbs(Request $request){
        $total = $request->qty * $request->harga;
        $wbs= Wbs::where('id_kegiatan', $request->id_kegiatan)->update([
            'qty' => $request->qty,
            'harga' => $request->harga,
            'totalHarga' => $total,
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        $wbs = DB::select("SELECT w.harga, w.qty, w.totalHarga, text, duration,start_date, parent, t.id FROM tasks t JOIN lahans l on t.id_lahan =l.id JOIN wbs w on t.id = w.id_kegiatan");
        return view('wbs', compact('wbs'));
        //return view('kelola_lahan', compact('lahan'));
    }

    public function update_wbs($id){
        $wbs = DB::select("SELECT w.harga, w.qty, w.totalHarga, text, duration,start_date, parent, t.id FROM tasks t JOIN lahans l on t.id_lahan =l.id JOIN wbs w on t.id = w.id_kegiatan where id_kegiatan ='".$id."'");
        return view('updateWbs', compact('wbs'));
        //return view('kelola_lahan', compact('lahan'));

    }
    
}