<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;


use App\Product;
use App\Lahan;
//use App\Models\Category_lahan;
use App\Category_lahan;
use App\Category;
use App\Transaction;
use App\ProductGallery;
use App\TransactionDetail;
use App\Pengguna;
use App\Peralatan;
use App\sewa_lahan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;


class PeralatanController extends Controller
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

    public function peralatan(){
        $peralatan = Peralatan::paginate(9);
        $peralatan = DB::select("SELECT p.username, a.id_peralatan, p.nama, p.id_pengguna, a.nama_alat, a.harga, a.deskripsi, a.gambar, a.id_pemilik FROM pengguna p JOIN peralatans a on p.id_pengguna = a.id_pemilik");
        return view('peralatan', compact('peralatan'));
    }

    public function create(){
        //$data['categori']= "select * from category_lahan";
        //$user = User::find($id);
        return view('create_peralatan',[
            'id_pengguna' => Auth::user()->pengguna->id_pengguna
        ]);
    }

    public function simpan(Request $request){
        // menyimpan data file yang diupload ke variabel $file
	    $file = $request->file('gambar');
        
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'gambar_peralatan';
        $file->move($tujuan_upload,$file->getClientOriginalName());

        DB::table('peralatans')->insert([
            'nama_alat' => $request->nama_alat,
            'harga'             => $request->harga,
            'deskripsi'         => $request->deskripsi,
            'gambar'            => $file->getClientOriginalName(),
            'id_pemilik'        => Auth::user()->pengguna->id_pengguna,
            'updated_at'        => date("Y-m-d H:i:s")
        ]);
        $peralatan = DB::select("SELECT a.id_peralatan, p.nama, p.id_pengguna, a.nama_alat, a.harga, a.deskripsi, a.gambar, a.id_pemilik FROM pengguna p JOIN peralatans a on p.id_pengguna = a.id_pemilik WHERE p.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        return view('kelola_peralatan', compact('peralatan'));
    }   
    public function kelola_peralatan(){
        $peralatan = DB::select("SELECT a.id_peralatan, p.nama, p.id_pengguna, a.nama_alat, a.harga, a.deskripsi, a.gambar, a.id_pemilik FROM pengguna p JOIN peralatans a on p.id_pengguna = a.id_pemilik WHERE p.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        return view('kelola_peralatan', compact('peralatan'));
    }    
    public function ubahperalatan($id){
        $peralatan = Peralatan::select('*')->where('id_peralatan', $id)->get();
        return view('ubahperalatan', compact('peralatan'));  
    }

    public function updateperalatan(Request $request){
        $file = $request->file('gambar');
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'gambar_lahan';
        $file->move($tujuan_upload,$file->getClientOriginalName());
        
        $peralatan = Peralatan::where('id_peralatan', $request->id_peralatan)->update([
            'nama_alat' => $request->nama_alat,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar' => $file->getClientOriginalName(),
            'updated_at'        => date("Y-m-d H:i:s")
        ]);
        return redirect('peralatan/kelola_peralatan');
    }

    public function hapus_peralatan($id){
        DB::table('peralatans')->where('id_peralatan',$id)->delete();
        return redirect('peralatan/kelola_peralatan');
    }
    public function detail_peralatan($id){

        $peralatan = DB::select("SELECT p.username, a.id_peralatan, p.nama, p.id_pengguna, a.nama_alat, a.harga, a.deskripsi, a.gambar, a.id_pemilik FROM pengguna p JOIN peralatans a on p.id_pengguna = a.id_pemilik");
       
        return view('detail_peralatan',compact('peralatan'));  
    }
    
    public function sewaPeralatan($id){
        $pengguna = Pengguna::select('*')->where('id_pengguna', Auth::user()->pengguna->id_pengguna)->get();
        $peralatan = Peralatan::select('*')->where('id_peralatan', $id)->get();
        return view('sewaPeralatan', compact('pengguna','peralatan'));  
    }
    public function updateSewaPeralatan(Request $request){
        

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
        $total = $request->totalHari*$request->harga*$request->qty;
        DB::table('sewa_peralatans')->insert([
            'id_penyewa'     => Auth::user()->pengguna->id_pengguna,
            'id_pemilik'     => $request->id_pemilik,
            'id_peralatan'   => $request->id_peralatan,
            'status'         => "Belum Acc",
            'harga'          => $request->harga,
            'totalHari'      => $request->totalHari,
            'totalHarga'     => $total,
            'statusPinjam'   => "-",
            'qty'            => $request->qty,            
            'updated_at'     => date("Y-m-d H:i:s")
        ]);

        return redirect('lahan');
    }
    


}