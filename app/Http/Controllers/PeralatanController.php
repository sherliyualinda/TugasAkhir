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
use App\sewa_peralatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;


class PeralatanController extends BaseController
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
        $peralatans = Peralatan::where('status', 'Ready')->with('pengguna')->paginate(9);
        return view('peralatan', compact('peralatans'));
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
            'nama_alat'         => $request->nama_alat,
            'harga'             => $request->harga,
            'deskripsi'         => $request->deskripsi,
            'stok'              => $request->stok,
            'gambar'            => $file->getClientOriginalName(),
            'id_pemilik'        => Auth::user()->pengguna->id_pengguna,
            'updated_at'        => date("Y-m-d H:i:s")
        ]);
        return redirect()->route('peralatan.kelola_peralatan');
    }   
    public function kelola_peralatan(){
       // $peralatans = Peralatan::where('id_pemilik', Auth::user()->pengguna->id_pengguna)->paginate(10);
        $peralatans= DB::table('peralatans')->select('id_peralatan','nama_alat','stok','harga','deskripsi','gambar','id_pemilik','status','updated_at')->where('id_pemilik',Auth::user()->pengguna->id_pengguna)->paginate(3);
        return view('kelola_peralatan', compact('peralatans'));
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
            'nama_alat'         => $request->nama_alat,
            'deskripsi'         => $request->deskripsi,
            'harga'             => $request->harga,
            'gambar'            => $file->getClientOriginalName(),
            'updated_at'        => date("Y-m-d H:i:s")
        ]);
        return redirect('peralatan/kelola_peralatan');
    }

    public function hapus_peralatan($id){
        DB::table('peralatans')->where('id_peralatan',$id)->delete();
        return redirect('peralatan/kelola_peralatan');
    }
    public function detail_peralatan($id){

        $peralatan = DB::select("SELECT p.username, a.id_peralatan, p.nama, p.id_pengguna, a.nama_alat, a.harga, a.deskripsi, a.gambar, a.id_pemilik FROM pengguna p JOIN peralatans a on p.id_pengguna = a.id_pemilik WHERE id_peralatan = $id");
       
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
            'bukti_bayar'    => "-",          
            'updated_at'     => date("Y-m-d H:i:s")
        ]);

        return redirect('lahan/pembayaran-sewa');
    }

    public function request($id){
        session_start();
        $sewa = DB::select("SELECT nama,l.stok, s.qty,alamat,s.bukti_bayar,s.id_sewa,s.id_peralatan, nik, foto_ktp, id_penyewa, s.totalHari, s.totalHarga, s.status FROM pengguna p join sewa_peralatans s on p.id_pengguna = s.id_penyewa JOIN peralatans l ON l.id_peralatan = s.id_peralatan WHERE id_pengguna = ANY (SELECT s.id_penyewa FROM peralatans l join sewa_peralatans s on l.id_peralatan = s.id_peralatan) and s.id_peralatan = $id  or p.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        $peralatan = Peralatan::select('*')->where('id_peralatan', $id)->get();
        return view('request_peralatan', compact('sewa','peralatan'));
    }
    
    public function accRequest(Request $request, $id, $id2, $id3, $id4){
        $sewa= Sewa_peralatan::where('id_sewa', $id)->update([
            'status' => "Acc" ,
            //'progres' => "Proses",
            'updated_at' => date("Y-m-d H:i:s")

        ]);
        $stok = $request->id3 - $request->id4;
        $peralatan = Peralatan::where('id_peralatan', $id2)->update([
            'stok'         => $stok,
            'updated_at'   => date("Y-m-d H:i:s")
        ]);

        $sewa = DB::select("SELECT nama,l.stok, s.qty,alamat,s.bukti_bayar,s.id_sewa,s.id_peralatan, nik, foto_ktp, id_penyewa, s.totalHari, s.totalHarga, s.status FROM pengguna p join sewa_peralatans s on p.id_pengguna = s.id_penyewa JOIN peralatans l ON l.id_peralatan = s.id_peralatan WHERE id_pengguna = ANY (SELECT s.id_penyewa FROM peralatans l join sewa_peralatans s on l.id_peralatan = s.id_peralatan) and s.id_peralatan = $id  or p.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        $peralatan = Peralatan::select('*')->where('id_peralatan', $id)->get();
        return view('request_peralatan', compact('sewa','peralatan'));
    }

    public function tolakRequest($id){
        $sewa= Sewa_peralatan::where('id_sewa', $id)->update([
            'status' => "Tolak" ,
            //'progres' => "Gagal",
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        //return redirect('lahan/kelola_lahan');
        
        $sewa = DB::select("SELECT nama,l.stok, s.qty,alamat,s.bukti_bayar,s.id_sewa,s.id_peralatan, nik, foto_ktp, id_penyewa, s.totalHari, s.totalHarga, s.status FROM pengguna p join sewa_peralatans s on p.id_pengguna = s.id_penyewa JOIN peralatans l ON l.id_peralatan = s.id_peralatan WHERE id_pengguna = ANY (SELECT s.id_penyewa FROM peralatans l join sewa_peralatans s on l.id_peralatan = s.id_peralatan) and s.id_peralatan = $id  or p.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        $peralatan = Peralatan::select('*')->where('id_peralatan', $id)->get();
        return view('request_peralatan', compact('sewa','peralatan'));
    }

    public function doneRequest(Request $request, $id, $id2, $id3, $id4){
        $sewa= Sewa_peralatan::where('id_sewa', $id)->update([
            'status' => "Done" ,
            //'progres' => "Proses",
            'updated_at' => date("Y-m-d H:i:s")

        ]);
        $stok = $request->id3 + $request->id4;
        $peralatan = Peralatan::where('id_peralatan', $id2)->update([
            'stok'         => $stok,
            'updated_at'   => date("Y-m-d H:i:s")
        ]);

        $sewa = DB::select("SELECT nama,l.stok, s.qty,alamat,s.bukti_bayar,s.id_sewa,s.id_peralatan, nik, foto_ktp, id_penyewa, s.totalHari, s.totalHarga, s.status FROM pengguna p join sewa_peralatans s on p.id_pengguna = s.id_penyewa JOIN peralatans l ON l.id_peralatan = s.id_peralatan WHERE id_pengguna = ANY (SELECT s.id_penyewa FROM peralatans l join sewa_peralatans s on l.id_peralatan = s.id_peralatan) and s.id_peralatan = $id  or p.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        $peralatan = Peralatan::select('*')->where('id_peralatan', $id)->get();
        return view('request_peralatan', compact('sewa','peralatan'));
    }

    public function transaksi(){
        //$transaksi = DB::select("SELECT sl.qty, p.username,l.nama_alat,sl.id_sewa, l.gambar, sl.id_peralatan,l.deskripsi,l.harga,sl.totalHari,sl.totalHarga,sl.bukti_bayar, sl.status FROM peralatans l JOIN pengguna p on l.id_pemilik = p.id_pengguna JOIN sewa_peralatans sl on l.id_peralatan = sl.id_peralatan Where id_penyewa ='".Auth::user()->pengguna->id_pengguna."'");
        
        $transaksi= DB::table('peralatans')->join('pengguna','peralatans.id_pemilik','=','pengguna.id_pengguna')->join('sewa_peralatans','peralatans.id_peralatan','=','sewa_peralatans.id_peralatan')->select('sewa_peralatans.qty', 'pengguna.username','peralatans.nama_alat','sewa_peralatans.id_sewa', 'peralatans.gambar', 'sewa_peralatans.id_peralatan','peralatans.deskripsi','peralatans.harga','sewa_peralatans.totalHari','sewa_peralatans.totalHarga','sewa_peralatans.bukti_bayar', 'sewa_peralatans.status')->where('id_penyewa',Auth::user()->pengguna->id_pengguna)->paginate(3);
        return view('transaksi_peralatan', compact('transaksi'));
    }

    public function bukti_bayar($id){
        $sewa = Sewa_peralatan::select('*')->where('id_sewa', $id)->get();
        return view('form_Buktibayar', compact('sewa'));  
    }

    public function simpan_bukti(Request $request){

        $file = $request->file('bukti_bayar');
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'bukti_bayar';
        $file->move($tujuan_upload,$file->getClientOriginalName());
        
        $pengguna = Sewa_peralatan::where('id_sewa', $request->id_sewa)->update([
            'bukti_bayar' => $file->getClientOriginalName(),
            'updated_at'     => date("Y-m-d H:i:s")
        ]);
       // $transaksi = DB::select("SELECT sl.qty, p.username,l.nama_alat,sl.id_sewa, l.gambar, sl.id_peralatan,l.deskripsi,l.harga,sl.totalHari,sl.totalHarga,sl.bukti_bayar, sl.status FROM peralatans l JOIN pengguna p on l.id_pemilik = p.id_pengguna JOIN sewa_peralatans sl on l.id_peralatan = sl.id_peralatan Where id_penyewa ='".Auth::user()->pengguna->id_pengguna."'");

        $transaksi= DB::table('peralatans')->join('pengguna','peralatans.id_pemilik','=','pengguna.id_pengguna')->join('sewa_peralatans','peralatans.id_peralatan','=','sewa_peralatans.id_peralatan')->select('sewa_peralatans.qty', 'pengguna.username','peralatans.nama_alat','sewa_peralatans.id_sewa', 'peralatans.gambar', 'sewa_peralatans.id_peralatan','peralatans.deskripsi','peralatans.harga','sewa_peralatans.totalHari','sewa_peralatans.totalHarga','sewa_peralatans.bukti_bayar', 'sewa_peralatans.status')->where('id_penyewa',Auth::user()->pengguna->id_pengguna)->paginate(3);
        
        return view('transaksi_peralatan', compact('transaksi'));
    }
}