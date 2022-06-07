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
        //$lahan = peralatan::paginate(9);
        //$lahan = DB::select("SELECT p.nama as pemilik, l.id,l.category_lahan_id,l.ukuran,l.deskripsi,l.gambar, cl.nama, l.id_user, p.username FROM pengguna p JOIN lahans l ON p.id_pengguna = l.id_user JOIN category_lahans cl ON l.category_lahan_id = cl.id");
        //return view('lahan', compact('lahan'));
        return view('peralatan');
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
        //$lahan = DB::select("SELECT p.nama as pemilik, l.id,l.category_lahan_id,l.ukuran,l.deskripsi,l.gambar, cl.nama FROM pengguna p JOIN lahans l ON p.id_pengguna = l.id_user JOIN category_lahans cl ON l.category_lahan_id = cl.id WHERE p.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        //return view('tampil_lahan', compact('lahan'));
    }   
}