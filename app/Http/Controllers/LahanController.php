<?php

namespace App\Http\Controllers;

use App\Boq;
use Illuminate\Http\Request;

use App\Product;
use App\Lahan;
use App\Struk;
use App\CategoryLahan;
use App\Category;
use App\Daily;
use App\Impact;
use App\Sewa_lahan;
use App\Transaction;
use App\ProductGallery;
use App\TransactionDetail;
use App\Pengguna;
use App\Task_histori;
use App\Task;
use APp\Link;
use App\Probabilitas;
use App\Wbs;
use App\Jadwal;
use App\Lahan_resources;
use App\Manual_book;
use App\Risk;
use App\Traits\NavbarTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use mysqli;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Mockery\Matcher\Any;

class LahanController extends Controller
{
    use NavbarTrait;
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
        // $lahan = Lahan::paginate(9);
        $lahan = DB::select("SELECT p.nama as pemilik,l.statusLahan, p.alamat,l.id,l.category_lahan_id,l.ukuran,l.deskripsi,l.gambar, cl.nama, l.id_user, p.username FROM pengguna p JOIN lahans l ON p.id_pengguna = l.id_user JOIN category_lahans cl ON l.category_lahan_id = cl.id WHERE p.id_pengguna != '".Auth::user()->pengguna->id_pengguna."'");
        $lahans = DB::select("SELECT p.nama as pemilik,l.statusLahan,p.alamat, l.id,l.category_lahan_id,l.ukuran,l.deskripsi,l.gambar, cl.nama, l.id_user, p.username FROM pengguna p JOIN lahans l ON p.id_pengguna = l.id_user JOIN category_lahans cl ON l.category_lahan_id = cl.id WHERE p.id_pengguna != '".Auth::user()->pengguna->id_pengguna."'");
        $total_notif = $this->total_notif();
        $list_notif_display = $this->list_notif_display();
        $notif_pesan = $this->notif_pesan();
        $notif_group = $this->notif_group();
        return view('lahan', compact('lahan', 'total_notif', 'list_notif_display', 'notif_pesan', 'notif_group'));
        // return view('lahan');
    }

    public function create(){
        //$data['categori']= "select * from Category_lahan";
        //$user = User::find($id);
        $categori=CategoryLahan::all();
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
            'statusLahan'       => "Waiting",
            'created_at'        => date("Y-m-d H:i:s"),
            'updated_at'        => date("Y-m-d H:i:s")
        ]);
        return redirect()->route('lahan.kelola_lahan');
    }
    public function kelola_lahan(){
        // $lahan = DB::select("SELECT p.nama as pemilik, l.id,l.category_lahan_id,l.ukuran,l.deskripsi,l.gambar, l.statusLahan, cl.nama FROM pengguna p JOIN lahans l ON p.id_pengguna = l.id_user JOIN category_lahans cl ON l.category_lahan_id = cl.id WHERE p.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");//
        $categori=CategoryLahan::all();
        $lahan = DB::table('pengguna')->join('lahans', 'pengguna.id_pengguna', '=', 'lahans.id_user')->join('category_lahans', 'lahans.category_lahan_id', '=', 'category_lahans.id')->select('pengguna.nama as pemilik', 'lahans.id','lahans.category_lahan_id','lahans.ukuran','lahans.deskripsi','lahans.gambar', 'lahans.statusLahan', 'category_lahans.nama')->where('pengguna.id_pengguna', Auth::user()->pengguna->id_pengguna)->orderby('lahans.updated_at')->Paginate(3);

        return view('kelola_lahan', compact('lahan','categori'));
        
    }    
    public function ubahlahan($id){
        $categori = CategoryLahan::all();
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
        return redirect()->route('lahan.kelola_lahan');
    }

    public function hapus_lahan($id){
        DB::table('lahans')->where('id',$id)->delete();
        return redirect()->route('lahan.kelola_lahan');
    }
    public function detail_lahan($id){
       
        $lahan = DB::select("SELECT p.username, p.nama as pemilik,l.statusLahan,l.id_user, l.id,l.category_lahan_id,l.ukuran,l.deskripsi,l.gambar, cl.nama FROM pengguna p JOIN lahans l ON p.id_pengguna = l.id_user JOIN category_lahans cl ON l.category_lahan_id = cl.id WHERE l.id = $id");
        $orang = DB::select("SELECT DISTINCT lr.keterangan, lr.resource FROM lahan_resources lr JOIN lahans s WHERE lr.id_resources = 1 AND lr.id_lahan = $id");
        $material = DB::select("SELECT DISTINCT lr.keterangan, lr.resource FROM lahan_resources lr JOIN lahans s WHERE lr.id_resources = 2 AND lr.id_lahan = $id");
        $sewa = DB::select("SELECT COUNT(id_lahan) as totSewa FROM sewa_lahans WHERE id_lahan = $id AND progres='Done'");
        $alat = DB::select("SELECT DISTINCT lr.keterangan, lr.resource FROM lahan_resources lr JOIN lahans s WHERE lr.id_resources = 3 AND lr.id_lahan = $id");
        $lahan4 = DB::select("SELECT l.id, l.category_lahan_id,l.ukuran,l.deskripsi,l.gambar, cl.nama FROM pengguna p JOIN lahans l ON p.id_pengguna = l.id_user JOIN category_lahans cl ON l.category_lahan_id = cl.id WHERE l.id = $id limit 1");
        return view('detail_lahan',compact('lahan','orang','material','alat','lahan4','sewa'));  
    }
    public function projek_user(){
        $projek = DB::select("SELECT p.username,sl.id_sewa, l.gambar, sl.id_lahan,l.deskripsi,l.ukuran,l.category_lahan_id, cl.nama,sl.progres, sl.status FROM lahans l JOIN pengguna p on l.id_user = p.id_pengguna JOIN category_lahans cl on cl.id =l.category_lahan_id  JOIN sewa_lahans sl on l.id =sl.id_lahan WHERE sl.status='Acc' And id_penyewa ='".Auth::user()->pengguna->id_pengguna."'");
        
        return view('projek', compact('projek'));
    }

    public function Dprojek_user($id){
        session_start();
        $_SESSION['id_sewa'] = $id;
        $sewa =DB::select("SELECT l.gambar, l.deskripsi,l.ukuran,l.category_lahan_id, cl.nama,sl.progres, sl.status,sl.id_sewa,sl.id_lahan,sl.id_penyewa FROM lahans l JOIN category_lahans cl on cl.id =l.category_lahan_id  JOIN sewa_lahans sl on l.id =sl.id_lahan  WHERE sl.status='Acc' And id_sewa = $id AND id_penyewa ='".Auth::user()->pengguna->id_pengguna."'");

        $surat = DB::Select("Select surat_perjanjian, id_sewa FROM surats Where id_sewa='".$_SESSION['id_sewa']."' ORDER BY updated_at DESC LIMIT 1");

        $daily = DB::select("SELECT d.id_sewa,d.gambar,d.keterangan,d.date,d.updated_at,s.id_lahan, d.id_daily FROM dailies d JOIN sewa_lahans s ON d.id_sewa= s.id_sewa where d.id_sewa = $id");

        $struk = DB::select("SELECT d.keterangan,d.gambar,d.tanggal,d.updated_at,s.id_lahan, d.id_struk FROM struks d JOIN sewa_lahans s ON d.id_sewa= s.id_sewa where d.id_sewa = $id");

        $risk=DB::select("SELECT r.id_sewa,r.penyebab,r.dampak,r.strategi,r.biaya,r.probabilitas,r.impact,r.levelRisk,r.updated_at,s.id_lahan, r.id_risk FROM risks r JOIN sewa_lahans s ON r.id_sewa= s.id_sewa where r.id_sewa = $id ");
       
        $orang = DB::select("SELECT DISTINCT lr.keterangan, lr.resource FROM lahan_resources lr JOIN lahans l JOIN sewa_lahans sl on sl.id_lahan = l.id WHERE lr.id_resources = 1 AND sl.status ='Acc'");
        $material = DB::select("SELECT DISTINCT lr.keterangan, lr.resource FROM lahan_resources lr JOIN lahans l JOIN sewa_lahans sl on sl.id_lahan = l.id WHERE lr.id_resources = 2 AND sl.status ='Acc'");
        $alat = DB::select("SELECT DISTINCT lr.keterangan, lr.resource FROM lahan_resources lr JOIN lahans l JOIN sewa_lahans sl on sl.id_lahan = l.id WHERE lr.id_resources = 3 AND sl.status ='Acc'");

        $task = Task::select('*')->orderBy('sortorder')->where('id_sewa', $id)->get();

        $jadwal = Jadwal::select('*')->where('id_sewa', $id)->get();
        $jadwal2 = Jadwal::select('*')->where('id_sewa', $id)->get();
        $boq_aktual = Task::where('id_sewa', $id)->with('children')->get();
        $boq_history = Task_histori::where('id_sewa', $id)->with('children')->get();

        // Scurve
        $aktual = Task::where('id_sewa', $id)->with('children')->get();
        $tanggalAll = [];
        $data_kegiatan = [];
        $total_aktual = [];
        foreach ($aktual as $key => $parent) {
            if ($parent->parent == 0) {
             $total_aktual[Carbon::parse($parent->start_date)->format('d-m-Y')] = $parent->totalHarga;
             // $data_kegiatan[Carbon::parse($parent->start_date)->format('d-m-Y')][] = $parent->totalHarga;
             if (!in_array(Carbon::parse($parent->start_date)->format('d-m-Y'), $tanggalAll)) {
                 $tanggalAll[] = Carbon::parse($parent->start_date)->format('d-m-Y');
             }
            }
         }
         
         $total_history = [];
         $date_history = [];
         $history = Task_histori::where('id_sewa', $id)->with('children')->get();
         foreach ($history as $key => $parent) {
             if ($parent->parent == 0) {
              $total_history[Carbon::parse($parent->start_date)->format('d-m-Y')] = $parent->totalHarga;
             $data_kegiatan[Carbon::parse($parent->start_date)->format('d-m-Y')][] = $parent->text;
              if (!in_array(Carbon::parse($parent->start_date)->format('d-m-Y'), $tanggalAll)) {
                 $tanggalAll[] = Carbon::parse($parent->start_date)->format('d-m-Y');
              }
             }
         }
 
         usort($tanggalAll, function ($a, $b) {
             return strtotime($a) - strtotime($b);
         });
 
         $start = Carbon::parse($tanggalAll[0]);
         $end = Carbon::parse($tanggalAll[count($tanggalAll)-1]);
         $period = \Carbon\CarbonPeriod::create($start, $end);
         // Convert the period to an array of dates
         $dates = [];
         // Iterate over the period
         $stop = 0;
         foreach ($period as $date) {
             $temp = $date->format('d-m-Y');
             $dates[] = $temp;
             if (array_key_exists($temp, $total_history)) {
                 // print_r(array_key_exists($temp, $total_history));
             }else{
                 $total_history[$temp] = false;
             }
             if (array_key_exists($temp, $total_aktual)) {
                 // print_r(array_key_exists($temp, $total_aktual));
                 if ($total_aktual[$temp] > 0) {
                     # code...
                 }else{
                     $total_aktual[$temp] = 'NaN';
                     $stop = 'stop';
                 }
             }else{
                 $total_aktual[$temp] = $stop;
             }
         }
        
        $dataScurve = [
            'tanggal' => $dates,
            'total_aktual' => $total_aktual,
            'total_history' => $total_history,
            'data_kegiatan' => $data_kegiatan,
        ];

        // scurve

        return view('projek_user',compact('task','sewa','jadwal2','orang','material','alat','risk','daily','struk','jadwal','boq_aktual','boq_history','dataScurve','surat'));  
    }

    public function dokumentasi($id, $penyewa_id)
    {
        $sewa =DB::select("SELECT l.gambar, l.deskripsi,l.ukuran,l.category_lahan_id, cl.nama,sl.progres, sl.status,sl.id_sewa FROM lahans l JOIN category_lahans cl on cl.id =l.category_lahan_id  JOIN sewa_lahans sl on l.id =sl.id_lahan  WHERE sl.status='Acc' And id_sewa = $id AND id_penyewa = $penyewa_id ");
        $orang = DB::select("SELECT DISTINCT lr.keterangan, lr.resource FROM lahan_resources lr JOIN lahans l JOIN sewa_lahans sl on sl.id_lahan = l.id WHERE lr.id_resources = 1 AND sl.status ='Acc'");
        $material = DB::select("SELECT DISTINCT lr.keterangan, lr.resource FROM lahan_resources lr JOIN lahans l JOIN sewa_lahans sl on sl.id_lahan = l.id WHERE lr.id_resources = 2 AND sl.status ='Acc'");
        $alat = DB::select("SELECT DISTINCT lr.keterangan, lr.resource FROM lahan_resources lr JOIN lahans l JOIN sewa_lahans sl on sl.id_lahan = l.id WHERE lr.id_resources = 3 AND sl.status ='Acc'");
        $risk=DB::select("SELECT r.id_sewa,r.penyebab,r.dampak,r.strategi,r.biaya,r.probabilitas,r.impact,r.levelRisk,r.updated_at,s.id_lahan, r.id_risk FROM risks r JOIN sewa_lahans s ON r.id_sewa= s.id_sewa where r.id_sewa = $id ");
        $daily = DB::select("SELECT d.id_sewa,d.gambar,d.keterangan,d.date,d.updated_at,s.id_lahan, d.id_daily FROM dailies d JOIN sewa_lahans s ON d.id_sewa= s.id_sewa where d.id_sewa = $id");
        $struk = DB::select("SELECT d.keterangan,d.gambar,d.tanggal,d.updated_at,s.id_lahan, d.id_struk FROM struks d JOIN sewa_lahans s ON d.id_sewa= s.id_sewa where d.id_sewa = $id");
        
        // Scurve
        $boq_aktual = Task::where('id_sewa', $id)->with('children')->get();
        $boq_history = Task_histori::where('id_sewa', $id)->with('children')->get();
        $aktual = Task::where('id_sewa', $id)->with('children')->get();
        $tanggalAll = [];
        $data_kegiatan = [];
        $total_aktual = [];
        foreach ($aktual as $key => $parent) {
            if ($parent->parent == 0) {
             $total_aktual[Carbon::parse($parent->start_date)->format('d-m-Y')] = $parent->totalHarga;
             // $data_kegiatan[Carbon::parse($parent->start_date)->format('d-m-Y')][] = $parent->totalHarga;
             if (!in_array(Carbon::parse($parent->start_date)->format('d-m-Y'), $tanggalAll)) {
                 $tanggalAll[] = Carbon::parse($parent->start_date)->format('d-m-Y');
             }
            }
         }
         
         $total_history = [];
         $date_history = [];
         $history = Task_histori::where('id_sewa', $id)->with('children')->get();
         foreach ($history as $key => $parent) {
             if ($parent->parent == 0) {
              $total_history[Carbon::parse($parent->start_date)->format('d-m-Y')] = $parent->totalHarga;
             $data_kegiatan[Carbon::parse($parent->start_date)->format('d-m-Y')][] = $parent->text;
              if (!in_array(Carbon::parse($parent->start_date)->format('d-m-Y'), $tanggalAll)) {
                 $tanggalAll[] = Carbon::parse($parent->start_date)->format('d-m-Y');
              }
             }
         }
 
         usort($tanggalAll, function ($a, $b) {
             return strtotime($a) - strtotime($b);
         });
 
         $start = Carbon::parse($tanggalAll[0]);
         $end = Carbon::parse($tanggalAll[count($tanggalAll)-1]);
         $period = \Carbon\CarbonPeriod::create($start, $end);
         // Convert the period to an array of dates
         $dates = [];
         // Iterate over the period
         $stop = 0;
         foreach ($period as $date) {
             $temp = $date->format('d-m-Y');
             $dates[] = $temp;
             if (array_key_exists($temp, $total_history)) {
                 // print_r(array_key_exists($temp, $total_history));
             }else{
                 $total_history[$temp] = false;
             }
             if (array_key_exists($temp, $total_aktual)) {
                 // print_r(array_key_exists($temp, $total_aktual));
                 if ($total_aktual[$temp] > 0) {
                     # code...
                 }else{
                     $total_aktual[$temp] = 'NaN';
                     $stop = 'stop';
                 }
             }else{
                 $total_aktual[$temp] = $stop;
             }
         }
         
         $dataScurve = [
             'tanggal' => $dates,
             'total_aktual' => $total_aktual,
             'total_history' => $total_history,
             'data_kegiatan' => $data_kegiatan,
         ];
        
        // scurve
        // dd($risk);
        return view('projek_dokumentasi', compact('sewa','orang','material','alat','risk','daily','struk','boq_aktual','boq_history','dataScurve'));
    }
   

    public function ubahSewa($id){
        $pengguna = Pengguna::select('*')->where('id_pengguna', Auth::user()->pengguna->id_pengguna)->get();
        $lahan = lahan::select('*')->where('id', $id)->get();
        return view('ubahSewa', compact('pengguna','lahan'));  
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
            'progres'        => "-",
            'updated_at'     => date("Y-m-d H:i:s")
        ]);

        return redirect('lahan/pembayaran-sewa');
    }

    public function pembayaranSewa()
    {
        return view('pembayaran-sewa');
    }
    public function request($id){
        session_start();
        $_SESSION['id_lahan'] = $id;
        $sewa = DB::select("SELECT username,nama,alamat,s.id_sewa,s.id_lahan, nik, foto_ktp, id_penyewa, s.status,p.foto_profil, s.progres FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa WHERE id_pengguna = ANY (SELECT s.id_penyewa FROM lahans l join sewa_lahans s on l.id = s.id_lahan) and s.id_lahan = $id");

        $gambarnya = DB::select("SELECT gambar, deskripsi, ukuran from lahans Join sewa_lahans on lahans.id = sewa_lahans.id_lahan where sewa_lahans.id_lahan = $id limit 1");

        // $sewa= DB::table('pengguna')->join('sewa_lahanssa','pengguna.id_pengguna','=','sewa_lahans.id_penyewa')->select('username','nama','alamat','sewa_lahans.id_sewa','sewa_lahans.id_lahan', 'nik', 'foto_ktp', 'id_penyewa', 'sewa_lahans.status', 'sewa_lahans.progres')->where('id_pengguna',"ANY",function($query){
        //     $query->select('sewa_lahans.id_penyewa')->from('lahans')->join('sewa_lahans','lahans.id','=','sewa_lahans.id_lahan');
        // })->where('sewa_lahans.id_lahan',$id)->paginate(3);


        // $sewa= DB::table('pengguna')->join('sewa_lahans','pengguna.id_pengguna','=','sewa_lahans.id_penyewa')->select('username','nama','alamat','sewa_lahans.id_sewa','sewa_lahans.id_lahan', 'nik', 'foto_ktp', 'id_penyewa', 'sewa_lahans.status', 'sewa_lahans.progres')->where('id_pengguna','any(SELECT sewa_lahans.id_penyewa FROM lahans join sewa_lahans on lahans.id = sewa_lahans.id_lahan)') ->paginate(3);
        
        return view('request', compact('sewa','gambarnya'));

    }

    public function accRequest($id){
        session_start();
        $lahan= Lahan::where('id', $_SESSION['id_lahan'])->update([
            'statusLahan' => "Not Ready",
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        $sewa= Sewa_lahan::where('id_penyewa', $id)->where('id_lahan',$_SESSION['id_lahan'])->update([
            'status' => "Acc" ,
            'progres' => "Proses",
            'updated_at' => date("Y-m-d H:i:s")

        ]);

        $sewa= Sewa_lahan::where('status', 'Belum Acc')->where('id_lahan',$_SESSION['id_lahan'])->update([
            'status' => "Tolak" ,
            'progres' => "-",
            'updated_at' => date("Y-m-d H:i:s")

        ]);
        //return redirect('lahan/kelola_lahan');
       
        $sewa = DB::select("SELECT username,nama,alamat,s.id_sewa, nik, foto_ktp,s.id_lahan, id_penyewa, s.status, s.progres FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa WHERE id_pengguna = ANY (SELECT s.id_penyewa FROM lahans l join sewa_lahans s on l.id = s.id_lahan) and s.id_lahan = $id");
        //return view('request', compact('sewa'));
        return redirect()->route('request',$_SESSION['id_lahan']);
    }
    public function tolakRequest($id){
        session_start();
        $lahan= Lahan::where('id',$_SESSION['id_lahan'])->update([
            'statusLahan' => "Ready",
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        $sewa= Sewa_lahan::where('id_penyewa', $id)->where('id_lahan',$_SESSION['id_lahan'])->update([
            'status' => "Tolak" ,
            'progres' => "Gagal",
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        //return redirect('lahan/kelola_lahan');
        
        $sewa = DB::select("SELECT username,nama,alamat,s.id_sewa, nik, foto_ktp,s.id_lahan, id_penyewa,s.id_sewa, s.status, s.progres FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa WHERE id_pengguna = ANY (SELECT s.id_penyewa FROM lahans l join sewa_lahans s on l.id = s.id_lahan) and s.id_lahan = $id ");
        //return view('request', compact('sewa'));
        return redirect()->route('request',$_SESSION['id_lahan']);
    }
    public function doneRequest($id){
        session_start();
        $lahan= Lahan::where('id', $_SESSION['id_lahan'])->update([
            'statusLahan' => "Ready",
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        $sewa= Sewa_lahan::where('id_sewa', $id)->update([
            'progres' => "Done",
            'updated_at' => date("Y-m-d H:i:s")

        ]);
        //return redirect('lahan/kelola_lahan');
       
        $sewa = DB::select("SELECT uasername,nama,alamat,s.id_sewa, nik, foto_ktp, id_penyewa, s.status, s.progres FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa WHERE id_pengguna = ANY (SELECT s.id_penyewa FROM lahans l join sewa_lahans s on l.id = s.id_lahan) and s.id_lahan = $id");
        //return view('request', compact('sewa'));
        return redirect()->route('request',$_SESSION['id_lahan']);
    }
    public function wbs(Request $request,$id){
        session_start();
        //$wbs = DB::select("SELECT w.harga, w.qty, w.satuan, w.totalHarga, text, duration,start_date, parent, t.id FROM tasks t JOIN lahans l on t.id_lahan =l.id JOIN wbs w on t.id = w.id_kegiatan");

        $wbs = DB::select("SELECT a.id_sewa, format(a.harga,0, 'id_ID') as hargaNenek, a.satuan as satuanNenek, format(a.totalHarga,0, 'id_ID') as thNenek, a.qty as qtyNenek, a.start_date as tanggalNenek ,format(b.harga,0, 'id_ID') as hargaIbu, b.satuan as satuanIbu, format(b.totalHarga,0, 'id_ID') as thIbu, b.qty as qtyIbu,b.start_date as tanggalIbu,c.start_date as tanggalCucu, a.id as Id_Nenek,a.text as Nenek,a.parent as Parent_Nenek,b.id as Id_Ibu, b.text as Ibu,b.parent as Parent_Ibu,c.id as Id_Cucu,format(c.harga,0, 'id_ID') as hargaCucu, c.satuan as satuanCucu, format(c.totalHarga,0, 'id_ID') as thCucu, c.qty as qtyCucu, c.text as Cucu,c.parent as Parent_Cucu from tasks a left join tasks b on a.id = b.parent LEFT JOIN tasks c on b.id = c.parent JOIN sewa_lahans l on a.id_sewa =l.id_sewa WHERE a.id_sewa = $id AND a.parent =0 ORDER BY a.id asc,a.parent asc,b.id asc, b.parent asc,c.id asc, c.parent asc;");

        $wbs2 = Task::select('*')->where('id_sewa', $id)->limit(1)->get();

       $history = Task_histori::where('id_sewa', $id)->first();
        
        return view('create_wbs', compact('wbs','wbs2', 'history'));
    }
    public function wbs_user($id){
        
        $wbs = DB::select("SELECT w.harga, w.qty, w.totalHarga, text, duration,start_date, parent, t.id FROM tasks t JOIN lahans l on t.id_lahan =l.id JOIN wbs w on t.id = w.id_kegiatan");
        return view('wbs_user', compact('wbs'));
    
    }
    public function simpan_wbs(Request $request){
        session_start();
        $total = $request->qty * $request->harga;
        $parent = (int)$request->parent;
        $child = (int)$request->id;
        $dump_total = $total;

        if ((int)$request->parent !== 0){

            do {
                $tasks = Task::where('parent', $parent)->get();
                $harga_total = 0;
                foreach ($tasks as $key => $value) {
                    if ($value->id !== $child){
                        $harga_total += $value->totalHarga;
                    }
                }
                $harga_total = $harga_total + $dump_total;
                Task::where('id', $parent)->update([
                    'qty' => 0,
                    'satuan' => "",
                    'harga' => 0,
                    'totalHarga' => $harga_total,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $task = Task::where('id', $parent)->first();
                $parent = $task->parent;
                $child = $task->id;
                $dump_total = $harga_total;
            } while ((int)$task->parent > 0);
            
        }
        $wbs= Task::where('id', $request->id)->update([
            'qty' => $request->qty,
            'satuan' => $request->satuan,
            'harga' => $request->harga,
            'totalHarga' => $total,
            'updated_at' => date("Y-m-d H:i:s")
        ]);

       return redirect()->route('wbs', $_SESSION['id_sewa']);
    }

    public function update_wbs($id){
        $wbs = Task::where('id', $id)->first();
        
        return view('updateWbs', compact('wbs'));
        

    }

    public function scurve(Request $request,$id){
        $total_notif = $this->total_notif();
        $list_notif_display = $this->list_notif_display();
        $notif_pesan = $this->notif_pesan();
        $notif_group = $this->notif_group();
        
        $aktual = Task::where('id_sewa', $id)->with('children')->get();
        $tanggalAll = [];
        $data_kegiatan = [];
        $total_aktual = [];
        foreach ($aktual as $key => $parent) {
           if ($parent->parent == 0) {
            $total_aktual[Carbon::parse($parent->start_date)->format('d-m-Y')] = $parent->totalHarga;
            // $data_kegiatan[Carbon::parse($parent->start_date)->format('d-m-Y')][] = $parent->totalHarga;
            if (!in_array(Carbon::parse($parent->start_date)->format('d-m-Y'), $tanggalAll)) {
                $tanggalAll[] = Carbon::parse($parent->start_date)->format('d-m-Y');
            }
            // foreach ($parent->children as $child) {
            //     if($child->totalHarga > 0){
            //         if (in_array(Carbon::parse($child->start_date)->format('d-m-Y'), $tanggal)) {
            //             $total_aktual[Carbon::parse($child->start_date)->format('d-m-Y')] = $total_aktual[Carbon::parse($child->start_date)->format('d-m-Y')] + $child->totalHarga;
            //         }else{
            //             $tanggalAll[] = Carbon::parse($child->start_date)->format('d-m-Y');
            //             $total_aktual[Carbon::parse($child->start_date)->format('d-m-Y')] = $child->totalHarga;
            //         }
            //         $data_kegiatan[Carbon::parse($child->start_date)->format('d-m-Y')][] = $child->text;
            //     }
            // }
           }
        }
        
        $total_history = [];
        $date_history = [];
        $history = Task_histori::where('id_sewa', $id)->with('children')->get();
        foreach ($history as $key => $parent) {
            if ($parent->parent == 0) {
             $total_history[Carbon::parse($parent->start_date)->format('d-m-Y')] = $parent->totalHarga;
            $data_kegiatan[Carbon::parse($parent->start_date)->format('d-m-Y')][] = $parent->text;
             if (!in_array(Carbon::parse($parent->start_date)->format('d-m-Y'), $tanggalAll)) {
                $tanggalAll[] = Carbon::parse($parent->start_date)->format('d-m-Y');
             }
            //  foreach ($parent->children as $child) {
            //      if($child->totalHarga > 0){
            //          if (in_array(Carbon::parse($child->start_date)->format('d-m-Y'), $tanggal)) {
            //              $total_history[Carbon::parse($child->start_date)->format('d-m-Y')] = $total_history[Carbon::parse($child->start_date)->format('d-m-Y')] + $child->totalHarga;
            //          }else{
            //             if (!in_array(Carbon::parse($child->start_date)->format('d-m-Y'), $tanggalAll)) {
            //                 $tanggalAll[] = Carbon::parse($child->start_date)->format('d-m-Y');
            //              }
            //              $total_history[Carbon::parse($child->start_date)->format('d-m-Y')] = $child->totalHarga;
            //          }
            //      }
            //  }
            }
        }

        usort($tanggalAll, function ($a, $b) {
            return strtotime($a) - strtotime($b);
        });

        $start = Carbon::parse($tanggalAll[0]);
        $end = Carbon::parse($tanggalAll[count($tanggalAll)-1]);
        $period = \Carbon\CarbonPeriod::create($start, $end);
        // Convert the period to an array of dates
        $dates = [];
        // Iterate over the period
        $stop = 0;
        foreach ($period as $date) {
            $temp = $date->format('d-m-Y');
            $dates[] = $temp;
            if (array_key_exists($temp, $total_history)) {
                // print_r(array_key_exists($temp, $total_history));
            }else{
                $total_history[$temp] = false;
            }
            if (array_key_exists($temp, $total_aktual)) {
                // print_r(array_key_exists($temp, $total_aktual));
                if ($total_aktual[$temp] > 0) {
                    # code...
                }else{
                    $total_aktual[$temp] = 'NaN';
                    $stop = 'stop';
                }
            }else{
                $total_aktual[$temp] = $stop;
            }
        }
        
        $dataScurve = [
            'tanggal' => $dates,
            'total_aktual' => $total_aktual,
            'total_history' => $total_history,
            'data_kegiatan' => $data_kegiatan,
        ];
        // dd($data);
        return view('scurve_wbs', compact('dataScurve', 'total_notif', 'list_notif_display', 'notif_pesan', 'notif_group'));
    }

    public function boq_wbs($id)
    {
        $history = Task_histori::where('id_sewa', $id)->with('children')->get();
        return view('boq_wbs', compact('history'));
    }

    // public function formWbs($id){
    //     $wbs = Boq::select('*')->where('id_task', $id)->limit(1)->get();
        
    //     return view('formWbs', compact('wbs','wbs1'));  
    // }
    // public function kebutuhanWbs(Request $request){
    //     $total = $request->qty * $request->harga;
    //     DB::table('wbs')->insert([
            
    //         'id_kegiatan'     => $request->id_kegiatan,
    //         'qty'             => $request->qty,
    //         'satuan'          => $request->satuan,
    //         'harga'           => $request->harga,
    //         'totalHarga'      => $total,
    //         'updated_at'      => date("Y-m-d H:i:s")
    //     ]);
    //     return view('wbs', compact('wbs'));
        
    ///

    public function createRisk($id){

        $risk = Sewa_lahan::select('*')->where('id_sewa', $id)->get();
        return view('create_risk',compact('risk'));
    }

    public function simpan_risk(Request $request){
        // menyimpan data file yang diupload ke variabel $file
        if($request->probabilitas * $request->impact <= 2){
            $level = "Rendah";
        }elseif($request->probabilitas * $request->impact == 3 or $request->probabilitas * $request->impact == 4 ){
            $level = "Sedang";
        }else{
            $level = "Tinggi";
        }
        
        DB::table('risks')->insert([
            'id_sewa'       => $request->id_sewa,
            'penyebab'      => $request->penyebab,
            'dampak'        => $request->dampak,
            'strategi'      => $request->strategi,
            'biaya'         => $request->biaya,
            'probabilitas'  => $request->probabilitas,
            'impact'        => $request->impact,
            'levelRisk'     => $level,
            'updated_at'    => date("Y-m-d H:i:s")
        ]);
        return redirect()->route('kelola_risk',$request->id_sewa);


        }

        public function risk($id){
            $risk2 = DB::select("SELECT DISTINCT nama, nik FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa  where s.id_sewa = $id");
            $risk3 = DB::select("SELECT id_sewa FROM sewa_lahans WHERE id_sewa = $id");

            $risk4 = DB::select("SELECT id_sewa FROM sewa_lahans WHERE id_sewa = $id");
            
            $risk= DB::table('pengguna')->join('sewa_lahans','pengguna.id_pengguna','=','sewa_lahans.id_penyewa')->join('risks','risks.id_sewa','=','sewa_lahans.id_sewa')->join('probabilitas','risks.probabilitas','=','probabilitas.id_probabilitas')->join('impacts','risks.impact','=','impacts.id_impact')->select('nama','sewa_lahans.id_sewa','probabilitas.ket','impacts.ket_impact','risks.id_risk','sewa_lahans.id_lahan','nik', 'id_penyewa', 'risks.levelRisk', 'risks.penyebab', 'risks.strategi', 'risks.dampak', 'risks.biaya', 'risks.probabilitas', 'risks.impact','risks.levelRisk')->where('sewa_lahans.id_sewa',$id)->orwhere('pengguna.id_pengguna',Auth::user()->pengguna->id_pengguna)->paginate(3);



        return view('kelola_risk', compact('risk','risk2', 'risk3','risk4'));
        }

        public function ubahRisk($id){
            //$risk = Risk::select('*')->where('id_risk',$id)->get();
            $risk = DB::select("SELECT r.id_risk, r.id_sewa, r.penyebab, r.dampak, r.strategi, r.biaya, r.probabilitas, r.impact, i.ket_impact, p.ket FROM `risks` r JOIN probabilitas p ON r.probabilitas=p.id_probabilitas JOIN impacts i ON r.impact = i.id_impact WHERE id_risk = $id");
            $probabilitas = Probabilitas::all();
            $impact = Impact::all();
            return view('ubahRisk', compact('risk','probabilitas','impact'));  
        }
    
        public function updateRisk(Request $request){
            if($request->probabilitas * $request->impact <= 2){
                $level = "Rendah";
            }elseif($request->probabilitas * $request->impact == 3 or $request->probabilitas * $request->impact == 4 ){
                $level = "Sedang";
            }else{
                $level = "Tinggi";
            }
            
            $risk = Risk::where('id_risk',$request->id_risk)->update([
                'penyebab' => $request->penyebab,
                'dampak' => $request->dampak,
                'strategi' => $request->strategi,
                'biaya' => $request->biaya,
                'probabilitas' => $request->probabilitas,
                'impact' => $request->impact,
                'levelRisk' => $level,
                'updated_at' => date("Y-m-d H:i:s")
                
            ]);
            // $risk = DB::select("SELECT nama,s.id_sewa,ps.ket,i.ket_impact,r.id_risk,s.id_lahan, nik, id_penyewa, r.levelRisk, r.penyebab, r.strategi, r.dampak, r.biaya, r.probabilitas, r.impact,r.levelRisk FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa JOIN risks r on r.id_sewa = s.id_sewa JOIN probabilitas ps ON r.probabilitas=ps.id_probabilitas JOIN impacts i ON r.impact = i.id_impact WHERE s.id_sewa = $request->id_sewa  or p.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");

            return redirect()->route('kelola_risk',$request->id_sewa);
        }

        public function createBoq(Request $request, $id){


            $boq = DB::select("SELECT b.harga,s.id, b.qty,b.satuan, b.totalHarga, t.text, s.created_at, t.duration,s.start_date,t.text as induk, s.text as anak, s.parent FROM tasks t LEFT JOIN tasks s ON t.Id = s.parent JOIN lahans l on t.id_lahan =l.id JOIN boqs b on t.id = b.id_task WHERE t.id_lahan = $request->id AND s.text is NOT null ORDER by s.parent ASC, s.created_at ASC");

            $boq1 = DB::select("SELECT s.id_boq, s.harga,t.id, s.qty,s.satuan, s.totalHarga, k.text as nenek,t.text as induk,k.start_date, s.kegiatan as anak, s.parent, k.id FROM tasks k LEFT join tasks t on k.id= t.parent JOIN lahans l on t.id_lahan =l.id JOIN boqs b on t.id = b.id_task LEFT JOIN boqs s ON b.id_boq = s.parent WHERE t.id_lahan = $request->id AND b.id_boq IS NOT null ORDER by k.id asc, b.id_task ASC ");


        
            return view('create_boq', compact('boq'));

             }

        public function createDaily($id){
            $daily = Sewa_lahan::select('*')->where('id_sewa', $id)->get();
            return view('create_daily',compact('daily'));
        }

    public function simpan_daily(Request $request){
        $file = $request->file('gambar');
        
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'gambar_daily';
        $file->move($tujuan_upload,$file->getClientOriginalName());
        // menyimpan data file yang diupload ke variabel $file        
        DB::table('dailies')->insert([
            'id_sewa'       => $request->id_sewa,
            'gambar'        => $file->getClientOriginalName(),
            'keterangan'    => $request->keterangan,
            'date'          => $request->date,
            'updated_at'     => date("Y-m-d H:i:s")
        ]);
            return redirect()->route('kelola_daily',$request->id_sewa);

    }


    public function daily(Request $request, $id){
        
        // $daily = DB::select("SELECT nama,s.id_sewa,s.id_lahan, nik, id_penyewa, d.id_daily, d.gambar,d.keterangan, d.date, d.updated_at FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa JOIN dailies d on d.id_sewa = s.id_sewa WHERE s.id_sewa = $id  or p.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        $daily2 = DB::select("SELECT DISTINCT nama, nik FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa  where s.id_sewa = $id");
        $daily3 = Sewa_lahan::where('id_sewa', $id)->first();
        $daily4 = DB::select("SELECT id_sewa FROM sewa_lahans WHERE id_sewa = $id");
        $query = DB::table('dailies')->join('sewa_lahans','dailies.id_sewa','=','sewa_lahans.id_sewa')->select('dailies.id_sewa','dailies.gambar','dailies.keterangan','dailies.date','dailies.updated_at','sewa_lahans.id_lahan', 'dailies.id_daily')->where('dailies.id_sewa',$id);
        if($request->get('start') && $request->get('end')){
            $from = date('2018-01-01');
            $to = date('2018-05-02');
            $query->whereBetween('dailies.date', [$request->get('start'), $request->get('end')]);
        }
        $daily= $query->paginate(3);
        return view('kelola_daily', compact('daily','daily2','daily3','daily4'));
    }

    public function ubahDaily($id){
        //$daily = Daily::select('*')->where('id_daily',$id)->get();
        $daily = DB::select("SELECT id_sewa, gambar, keterangan, date, updated_at, id_daily FROM dailies  where id_daily = $id");
        return view('ubahDaily', compact('daily'));  
    }

    public function updateDaily(Request $request){
        $file = $request->file('gambar');
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'gambar_daily';
        $file->move($tujuan_upload,$file->getClientOriginalName());
                
        $daily = Daily::where('id_daily',$request->id_daily)->update([
            'gambar' => $file->getClientOriginalName(),
            'keterangan' => $request->keterangan,
            'date' => $request->date,
            'updated_at' => date("Y-m-d H:i:s")
            
        ]);
        return redirect()->route('kelola_daily',$request->id_sewa);
    }


    public function orang($id){
        $sdm = Lahan::select('*')->where('id', $id)->get();
        $orang = Pengguna::all();
        return view('orang',compact('sdm','orang'));
    }
    public function material($id){
        $sdm = Lahan::select('*')->where('id', $id)->get();
        return view('material',compact('sdm'));
    }
    public function alat($id){
        $sdm = Lahan::select('*')->where('id', $id)->get();
        return view('alat',compact('sdm'));
    }

    public function Kelola_resource($id){
        session_start();
        $_SESSION['id_lahan'] = $id;
        // $resource = DB::select("SELECT lr.id_lahan_resources, lr.resource, lr.keterangan, lr.id_resources, l.id, r.keterangan as role FROM lahan_resources lr JOIN lahans l ON lr.id_lahan = l.id JOIN resources r ON lr.id_resources = r.id_resources WHERE l.id = $id ORDER BY r.keterangan;");

        $resource= DB::table('lahan_resources')->join('lahans','lahan_resources.id_lahan','=','lahans.id')->join('resources','lahan_resources.id_resources','=','resources.id_resources')->join('pengguna', 'lahans.id_user','=','pengguna.id_pengguna')->select('pengguna.username','lahan_resources.id_lahan_resources', 'lahan_resources.resource', 'lahan_resources.keterangan', 'lahan_resources.id_resources', 'lahans.id', 'resources.keterangan as role')->where('lahans.id',$id)->orderby('resources.keterangan')->paginate(3);
        
        return view('kelola_resource', compact('resource'));
    }

    public function simpan_material(Request $request, $id){   
        DB::table('lahan_resources')->insert([
            'resource'        => $request->resource,
            'id_lahan'        => $request->id_lahan,
            'keterangan'      => $request->keterangan,
            'id_resources'    => 2,
            'updated_at'      => date("Y-m-d H:i:s")
        ]);
        
            
        return redirect()->route('sdm',$request->id_lahan);
    }

    public function simpan_orang(Request $request, $id){   
        DB::table('lahan_resources')->insert([
            'resource'        => $request->resource,
            'id_lahan'        => $request->id_lahan,
            'keterangan'      => $request->keterangan,
            'id_resources'    => 1,
            'updated_at'      => date("Y-m-d H:i:s")
        ]);
        
            
        return redirect()->route('sdm',$request->id_lahan);
    }
    public function simpan_alat(Request $request, $id){   
        DB::table('lahan_resources')->insert([
            'resource'        => $request->resource,
            'id_lahan'        => $request->id_lahan,
            'keterangan'      => $request->keterangan,
            'id_resources'    => 3,
            'updated_at'      => date("Y-m-d H:i:s")
        ]);
        
            
        return redirect()->route('sdm',$request->id_lahan);
    }     
    
    public function strukPembayaran($id){
        $sewa = Sewa_lahan::select('*')->where('id_sewa', $id)->get();
        return view('struk', compact('sewa'));
    }

    public function simpan_struk(Request $request){      
        session_start();  
        $file = $request->file('gambar');
        $tujuan_upload = 'gambar_struk';
        $file->move($tujuan_upload,$file->getClientOriginalName());

        DB::table('struks')->insert([
            'keterangan'        => $request->keterangan,
            'tanggal'           => $request->tanggal,
            'id_sewa'           => $request->id_sewa,
            'gambar'            => $file->getClientOriginalName(),
            'updated_at'        => date("Y-m-d H:i:s")
        ]);
        
        //$struk = Struk::select('*')->where('id_sewa', $request->id_sewa )->get();
        // $struk2 = DB::select("SELECT DISTINCT nama, nik FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa  where s.id_sewa = $request->id_sewa");
        // $struk4 = DB::select("SELECT id_sewa FROM sewa_lahans WHERE id_sewa = $request->id_sewa");

        // $struk= DB::table('struks')->join('sewa_lahans','struks.id_sewa','=','sewa_lahans.id_sewa')->select('id_struk','keterangan','gambar','tanggal','struks.updated_at','struks.id_sewa')->where('struks.id_sewa',$request->id_sewa)->paginate(3);
        
        // return view('Kelola_struk', compact('struk','struk2','struk4'));
        return redirect()->route('kelolaStruk',$request->id_sewa);
            
            //return view('kelola_risk', compact('risk'));
        }
    public function kelolaStruk($id){
        session_start();
        $_SESSION['id_sewa']=$id;
            // $struk = Struk::select('*')->where('id_sewa', $id)->get();
            $struk2 = DB::select("SELECT DISTINCT nama, nik FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa  where s.id_sewa = $id");
            $struk4 = DB::select("SELECT id_sewa FROM sewa_lahans WHERE id_sewa = $id");

            $struk= DB::table('struks')->join('sewa_lahans','struks.id_sewa','=','sewa_lahans.id_sewa')->select('id_struk','keterangan','gambar','tanggal','struks.updated_at','struks.id_sewa')->where('struks.id_sewa',$id)->paginate(3);
            return view('kelola_struk', compact('struk','struk2','struk4'));
    }
    public function ubahStruk($id){
        $struk = Struk::select('*')->where('id_struk',$id)->get();
        return view('ubahStruk', compact('struk'));  
    }

    public function updateStruk(Request $request){
    
        $file = $request->file('gambar');
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'gambar_struk';
        $file->move($tujuan_upload,$file->getClientOriginalName());
        
        $struk = Struk::where('id_struk',$request->id_struk)->update([
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
            'updated_at' => date("Y-m-d H:i:s"),
            'gambar' => $file->getClientOriginalName()
        ]);
                                    
        return redirect()->route('kelolaStruk',$request->id_sewa);
    }
    public function hapusStruk($id){
        session_start();
        DB::table('struks')->where('id_struk',$id)->delete();
        return redirect()->route('kelolaStruk',$_SESSION['id_sewa']);
    }

    public function simpan_history($id){   

        DB::insert("Insert Into task_historis(id_task, text, duration, progress, start_date, parent, sortorder, created_at, updated_at, id_sewa, qty, satuan, harga, totalHarga) SELECT id, text, duration, progress, start_date, parent, sortorder, created_at, updated_at, id_sewa, qty, satuan, harga, totalHarga From tasks WHERE id_sewa = $id");
        Task::where("id_sewa", $id)->update(['harga' => 0, 'totalHarga' => 0, 'qty' => 0]);
        return redirect()->back();
    }

    public function ubahSDM($id){
        $resource = Lahan_resources::select('*')->where('id_lahan_resources',$id)->get();
        return view('ubahSDM', compact('resource'));  
    }

    public function updateSDM(Request $request){
        
        $resource = Lahan_resources::where('id_lahan_resources',$request->id_lahan_resources)->update([
            'resource' => $request->resource,
            'keterangan' => $request->keterangan,
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        // $resource = DB::select("SELECT lr.id_lahan_resources, lr.resource, lr.keterangan, lr.id_resources, l.id, r.keterangan as role FROM lahan_resources lr JOIN lahans l ON lr.id_lahan = l.id JOIN resources r ON lr.id_resources = r.id_resources WHERE l.id = $request->id_lahan ORDER BY r.keterangan;");

        $resource= DB::table('lahan_resources')->join('lahans','lahan_resources.id_lahan','=','lahans.id')->join('resources','lahan_resources.id_resources','=','resources.id_resources')->select('lahan_resources.id_lahan_resources', 'lahan_resources.resource', 'lahan_resources.keterangan', 'lahan_resources.id_resources', 'lahans.id', 'resources.keterangan as role')->where('lahans.id',$request->id_lahan)->orderby('resources.keterangan')->paginate(3);
        return view('kelola_resource', compact('resource'));
        
    }
    public function hapusSDM($id){
        session_start();
        DB::table('lahan_resources')->where('id_lahan_resources',$id)->delete();
        $resource = DB::select("SELECT lr.id_lahan_resources, lr.resource, lr.keterangan, lr.id_resources, l.id, r.keterangan as role FROM lahan_resources lr JOIN lahans l ON lr.id_lahan = l.id JOIN resources r ON lr.id_resources = r.id_resources WHERE l.id = '".$_SESSION['id_lahan']."' Order by r.keterangan");
        return view('kelola_resource', compact('resource'));
    }

    public function kelola_jadwal($id){
        // $jadwal = Jadwal::select('*')->where('id_sewa', $id)->get();
        $jadwal2 = DB::select("SELECT DISTINCT nama, nik FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa  where s.id_sewa = $id");
        $jadwal3 = DB::select("SELECT id_sewa FROM sewa_lahans WHERE id_sewa = $id ");
        $jadwal4 = DB::select("SELECT id_sewa FROM sewa_lahans WHERE id_sewa = $id");
        
        $jadwal= DB::table('jadwals')->select('id_jadwal','agenda','date','keterangan','id_sewa','linkMeet','updated_at')->where('id_sewa',$id)->paginate(3);

        return view('kelola_jadwal',compact('jadwal','jadwal2','jadwal3','jadwal4'));
    }

    public function lihat_kalender($id){
        $jadwal = Jadwal::select('*')->where('id_sewa', $id)->get();
        
        return view('lihat_kalender',compact('jadwal'));
    }

    public function createJadwal($id){
        session_start();
        $_SESSION['id_sewa']=$id;
        $jadwal = Sewa_lahan::select('*')->where('id_sewa', $id)->get();
        return view('create_jadwal',compact('jadwal'));
    }
    public function simpan_jadwal(Request $request,$id){
          
        DB::table('jadwals')->insert([
            'id_sewa'       => $request->id_sewa,
            'date'          => $request->date,
            'agenda'        => $request->agenda,
            'keterangan'    => '',
            'linkMeet'      => $request->linkMeet,
            'updated_at'    => date("Y-m-d H:i:s")
        ]);
        return redirect()->route('kelola_jadwal',$request->id_sewa);
        }

        public function ubahJadwal($id){
            
            $jadwal = DB::select("SELECT id_sewa, date, keterangan, agenda,linkMeet, updated_at, id_jadwal FROM jadwals  where id_jadwal = $id");
            return view('ubahJadwal', compact('jadwal'));  
        }
    
        public function updateJadwal(Request $request){
                 
            $jadwal = Jadwal::where('id_jadwal',$request->id_jadwal)->update([
                'agenda'=>$request->agenda,
                'keterangan' => $request->keterangan,
                'date' => $request->date,
                'linkMeet' => $request->linkMeet,
                'updated_at' => date("Y-m-d H:i:s")
                
            ]);
            //$jadwal = Jadwal::select('*')->where('id_sewa', $request->id_sewa)->get();
            return redirect()->route('kelola_jadwal',$request->id_sewa);
         
        }


        public function createManual(){
            return view('create_manual');
        }
    
        public function simpan_manual(Request $request){
            $file = $request->file('gambar');
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'gambar_manual';
            $file->move($tujuan_upload,$file->getClientOriginalName());
            // menyimpan data file yang diupload ke variabel $file
          
            DB::table('manual_books')->insert([
                'id_categoryLahan'     => $request->id_categoryLahan,
                'gambar'               => $file->getClientOriginalName(),
                'jenis_lahan'        => $request->jenis_lahan,
                'deskripsi'      => $request->deskripsi,
                'sumber'         => $request->sumber,
                'updated_at'    => date("Y-m-d H:i:s")
            ]);
                
                // $manual = DB::select("SELECT c.nama,m.gambar, m.jenis_lahan, m.id_categoryLahan, m.deskripsi, m.sumber, m.id_manual FROM manual_books m JOIN category_lahans c on m.id_categoryLahan = c.id");
                return redirect()->route('manualBook');

                // $manual= DB::table('manual_books')->join('category_lahans','manual_books.id_categoryLahan','=','category_lahans.id')->select('category_lahans.nama', 'manual_books.gambar', 'manual_books.jenis_lahan', 'manual_books.id_categoryLahan', 'manual_books.deskripsi', 'manual_books.sumber', 'manual_books.id_manual')->paginate(2);
                // return view('kelola_manual', compact('manual'));
            }
    
            public function manualBook(){
            
                // $manual = DB::select("SELECT c.nama, m.gambar, m.jenis_lahan, m.id_categoryLahan, m.deskripsi, m.sumber, m.id_manual FROM manual_books m JOIN category_lahans c on m.id_categoryLahan = c.id");

                $manual= DB::table('manual_books')->join('category_lahans','manual_books.id_categoryLahan','=','category_lahans.id')->select('category_lahans.nama', 'manual_books.gambar', 'manual_books.jenis_lahan', 'manual_books.id_categoryLahan', 'manual_books.deskripsi', 'manual_books.sumber', 'manual_books.id_manual')->paginate(2);
                return view('kelola_manual', compact('manual'));
            }
            public function lihatManual($id){
                $manual = Manual_book::where('id_manual', $id)->with('category')->first();
                return view('lihatManual', compact('manual'));  
            }
            
            public function ubahManual($id){
                //$risk = Risk::select('*')->where('id_risk',$id)->get();
                $manual = DB::select("SELECT c.nama, m.gambar, m.jenis_lahan, m.id_categoryLahan, m.deskripsi, m.sumber, m.id_manual FROM manual_books m JOIN category_lahans c on m.id_categoryLahan = c.id WHERE m.id_manual = $id");
                $category = CategoryLahan::all();
                return view('ubahManual', compact('manual','category'));  
            }
        
            public function updateManual(Request $request){
                $file = $request->file('gambar');
                // isi dengan nama folder tempat kemana file diupload
                $tujuan_upload = 'gambar_manual';
                $file->move($tujuan_upload,$file->getClientOriginalName());
             
                $manual = Manual_book::where('id_manual',$request->id_manual)->update([
                    'id_categoryLahan'      => $request->id_categoryLahan,
                    'gambar'                =>$file->getClientOriginalName(),
                    'jenis_lahan'           => $request->jenis_lahan,
                    'deskripsi'             => $request->deskripsi,
                    'sumber'                => $request->sumber,
                    'updated_at'            => date("Y-m-d H:i:s")
                    
                ]);
                // $manual = DB::select("SELECT c.nama,m.gambar, m.jenis_lahan, m.id_categoryLahan, m.deskripsi, m.sumber, m.id_manual FROM manual_books m JOIN category_lahans c on m.id_categoryLahan = c.id");

                return redirect()->route('manualBook');
            }
            public function hapusManual($id){
                DB::table('manual_books')->where('id_manual',$id)->delete();
                // $manual = DB::select("SELECT c.nama,m.gambar, m.jenis_lahan, m.id_categoryLahan, m.deskripsi, m.sumber, m.id_manual FROM manual_books m JOIN category_lahans c on m.id_categoryLahan = c.id");

                return redirect()->route('manualBook');
            }

            public function detailManual($id){
                //DB::table('manual_books')->where('id_manual',$id)->delete();
                $manual = DB::select("SELECT c.nama,m.gambar, m.jenis_lahan, m.id_categoryLahan, m.deskripsi, m.sumber, m.id_manual FROM manual_books m JOIN category_lahans c on m.id_categoryLahan = c.id where id_categoryLahan = $id");
                return view('halmanual', compact('manual'));
            }
            public function halamanAwal(){
                return view('halamanAwal');
            }

            public function pilihPorto($id){
                $datas = DB::select("SELECT sw.id_sewa, sw.id_lahan, p.nama as pemilik,l.statusLahan,l.id_user, l.id,l.category_lahan_id,l.ukuran,l.deskripsi,l.gambar, cl.nama FROM pengguna p JOIN lahans l ON p.id_pengguna = l.id_user JOIN category_lahans cl ON l.category_lahan_id = cl.id JOIN sewa_lahans sw ON l.id = sw.id_lahan WHERE l.id = $id");
                return view('halPortofolio', compact('datas'));
            }

            public function lihatPortofolio(Request $request){
                // Scurve
                $boq_aktual = Task::where('id_sewa', $request->id_sewa)->with('children')->get();
                $boq_history = Task_histori::where('id_sewa', $request->id_sewa)->with('children')->get();
                $aktual = Task::where('id_sewa', $request->id_sewa)->with('children')->get();
                $tanggalAll = [];
                $data_kegiatan = [];
                $total_aktual = [];
                foreach ($aktual as $key => $parent) {
                    if ($parent->parent == 0) {
                     $total_aktual[Carbon::parse($parent->start_date)->format('d-m-Y')] = $parent->totalHarga;
                     // $data_kegiatan[Carbon::parse($parent->start_date)->format('d-m-Y')][] = $parent->totalHarga;
                     if (!in_array(Carbon::parse($parent->start_date)->format('d-m-Y'), $tanggalAll)) {
                         $tanggalAll[] = Carbon::parse($parent->start_date)->format('d-m-Y');
                     }
                    }
                 }
                 
                 $total_history = [];
                 $date_history = [];
                 $history = Task_histori::where('id_sewa', $request->id_sewa)->with('children')->get();
                 foreach ($history as $key => $parent) {
                     if ($parent->parent == 0) {
                      $total_history[Carbon::parse($parent->start_date)->format('d-m-Y')] = $parent->totalHarga;
                     $data_kegiatan[Carbon::parse($parent->start_date)->format('d-m-Y')][] = $parent->text;
                      if (!in_array(Carbon::parse($parent->start_date)->format('d-m-Y'), $tanggalAll)) {
                         $tanggalAll[] = Carbon::parse($parent->start_date)->format('d-m-Y');
                      }
                     }
                 }
         
                 usort($tanggalAll, function ($a, $b) {
                     return strtotime($a) - strtotime($b);
                 });
         
                 $start = Carbon::parse($tanggalAll[0]);
                 $end = Carbon::parse($tanggalAll[count($tanggalAll)-1]);
                 $period = \Carbon\CarbonPeriod::create($start, $end);
                 // Convert the period to an array of dates
                 $dates = [];
                 // Iterate over the period
                 $stop = 0;
                 foreach ($period as $date) {
                     $temp = $date->format('d-m-Y');
                     $dates[] = $temp;
                     if (array_key_exists($temp, $total_history)) {
                         // print_r(array_key_exists($temp, $total_history));
                     }else{
                         $total_history[$temp] = false;
                     }
                     if (array_key_exists($temp, $total_aktual)) {
                         // print_r(array_key_exists($temp, $total_aktual));
                         if ($total_aktual[$temp] > 0) {
                             # code...
                         }else{
                             $total_aktual[$temp] = 'NaN';
                             $stop = 'stop';
                         }
                     }else{
                         $total_aktual[$temp] = $stop;
                     }
                 }
                
                $dataScurve = [
                    'tanggal' => $dates,
                    'total_aktual' => $total_aktual,
                    'total_history' => $total_history,
                    'data_kegiatan' => $data_kegiatan,
                ];
                    return view('halPortofolioo', compact('boq_aktual','boq_history','dataScurve'));
                    }

            
                    public function kelolaReq($id){
                        session_start();
                        $_SESSION['id_sewa'] = $id;
                        $sewa =DB::select("SELECT l.gambar, l.deskripsi,l.ukuran,l.category_lahan_id, cl.nama,sl.progres, sl.status,sl.id_sewa,sl.id_lahan,sl.id_penyewa FROM lahans l JOIN category_lahans cl on cl.id =l.category_lahan_id  JOIN sewa_lahans sl on l.id =sl.id_lahan  WHERE sl.status='Acc' And id_sewa = $id AND id_penyewa ='".Auth::user()->pengguna->id_pengguna."'");
                
                        $daily = DB::select("SELECT d.id_sewa,d.gambar,d.keterangan,d.date,d.updated_at,s.id_lahan, d.id_daily FROM dailies d JOIN sewa_lahans s ON d.id_sewa= s.id_sewa where d.id_sewa = $id");
                
                        $struk = DB::select("SELECT d.keterangan,d.gambar,d.tanggal,d.updated_at,s.id_lahan, d.id_struk FROM struks d JOIN sewa_lahans s ON d.id_sewa= s.id_sewa where d.id_sewa = $id");
                
                        $risk3 = DB::select("SELECT id_sewa FROM sewa_lahans WHERE id_sewa = $id");

            
                        $risk= DB::table('pengguna')->join('sewa_lahans','pengguna.id_pengguna','=','sewa_lahans.id_penyewa')->join('risks','risks.id_sewa','=','sewa_lahans.id_sewa')->join('probabilitas','risks.probabilitas','=','probabilitas.id_probabilitas')->join('impacts','risks.impact','=','impacts.id_impact')->select('nama','sewa_lahans.id_sewa','probabilitas.ket','impacts.ket_impact','risks.id_risk','sewa_lahans.id_lahan','nik', 'id_penyewa', 'risks.levelRisk', 'risks.penyebab', 'risks.strategi', 'risks.dampak', 'risks.biaya', 'risks.probabilitas', 'risks.impact','risks.levelRisk')->where('sewa_lahans.id_sewa',$id)->orwhere('pengguna.id_pengguna',Auth::user()->pengguna->id_pengguna)->paginate(1);
                       
                        $orang = DB::select("SELECT DISTINCT lr.keterangan, lr.resource FROM lahan_resources lr JOIN lahans l JOIN sewa_lahans sl on sl.id_lahan = l.id WHERE lr.id_resources = 1 AND sl.status ='Acc'");
                        $material = DB::select("SELECT DISTINCT lr.keterangan, lr.resource FROM lahan_resources lr JOIN lahans l JOIN sewa_lahans sl on sl.id_lahan = l.id WHERE lr.id_resources = 2 AND sl.status ='Acc'");
                        $alat = DB::select("SELECT DISTINCT lr.keterangan, lr.resource FROM lahan_resources lr JOIN lahans l JOIN sewa_lahans sl on sl.id_lahan = l.id WHERE lr.id_resources = 3 AND sl.status ='Acc'");
                
                        $task = Task::select('*')->orderBy('sortorder')->where('id_sewa', $id)->get();
                
                        $jadwal = Jadwal::select('*')->where('id_sewa', $id)->get();
                        $jadwal2 = Jadwal::select('*')->where('id_sewa', $id)->get();
                        $boq_aktual = Task::where('id_sewa', $id)->with('children')->get();
                        $boq_history = Task_histori::where('id_sewa', $id)->with('children')->get();
                
                        // Scurve
                        $aktual = Task::where('id_sewa', $id)->with('children')->get();
                        $tanggalAll = [];
                        $data_kegiatan = [];
                        $total_aktual = [];
                        foreach ($aktual as $key => $parent) {
                            if ($parent->parent == 0) {
                             $total_aktual[Carbon::parse($parent->start_date)->format('d-m-Y')] = $parent->totalHarga;
                             $data_kegiatan[Carbon::parse($parent->start_date)->format('d-m-Y')][] = $parent->text;
                             // $data_kegiatan[Carbon::parse($parent->start_date)->format('d-m-Y')][] = $parent->totalHarga;
                             if (!in_array(Carbon::parse($parent->start_date)->format('d-m-Y'), $tanggalAll)) {
                                 $tanggalAll[] = Carbon::parse($parent->start_date)->format('d-m-Y');
                             }
                            }
                         }
                         
                         $total_history = [];
                         $date_history = [];
                         $history = Task_histori::where('id_sewa', $id)->with('children')->get();
                         foreach ($history as $key => $parent) {
                             if ($parent->parent == 0) {
                              $total_history[Carbon::parse($parent->start_date)->format('d-m-Y')] = $parent->totalHarga;
                              if (!in_array(Carbon::parse($parent->start_date)->format('d-m-Y'), $tanggalAll)) {
                                 $tanggalAll[] = Carbon::parse($parent->start_date)->format('d-m-Y');
                              }
                             }
                         }
                 
                         usort($tanggalAll, function ($a, $b) {
                             return strtotime($a) - strtotime($b);
                         });
                 
                         $start = Carbon::parse($tanggalAll[0]);
                         $end = Carbon::parse($tanggalAll[count($tanggalAll)-1]);
                         $period = \Carbon\CarbonPeriod::create($start, $end);
                         // Convert the period to an array of dates
                         $dates = [];
                         // Iterate over the period
                         $stop = 0;
                         foreach ($period as $date) {
                             $temp = $date->format('d-m-Y');
                             $dates[] = $temp;
                             if (array_key_exists($temp, $total_history)) {
                                 // print_r(array_key_exists($temp, $total_history));
                             }else{
                                 $total_history[$temp] = false;
                             }
                             if (array_key_exists($temp, $total_aktual)) {
                                 // print_r(array_key_exists($temp, $total_aktual));
                                 if ($total_aktual[$temp] > 0) {
                                     # code...
                                 }else{
                                     $total_aktual[$temp] = 'NaN';
                                     $stop = 'stop';
                                 }
                             }else{
                                 $total_aktual[$temp] = $stop;
                             }
                         }
                         
                         $dataScurve = [
                             'tanggal' => $dates,
                             'total_aktual' => $total_aktual,
                             'total_history' => $total_history,
                             'data_kegiatan' => $data_kegiatan,
                         ];
                
                        // scurve
                
                        return view('kelolaReq',compact('task','sewa','jadwal2','orang','material','alat','risk','risk3','daily','struk','jadwal','boq_aktual','boq_history','dataScurve'));  
                    }

                    public function Surat(){
                        $url = 'Surat.pdf';

                        return response()->file($url); // <-- display file directly in browser

                        

                    }

                    public function Surat_pemilik($id){
                        session_start();
                        $surat = DB::Select("Select surat_perjanjian, id_sewa FROM surats Where id_sewa='".$_SESSION['id_sewa']."' ORDER BY updated_at DESC LIMIT 1");
                        return view('surat',compact('surat'));
                    }

                    public function Surat_perjanjian(Request $request){
                        session_start();
                        $file = $request->file('surat_perjanjian');
                        // isi dengan nama folder tempat kemana file diupload
                        $tujuan_upload = 'surat_perjanjian';
                        $file->move($tujuan_upload,$file->getClientOriginalName());
                        
                        DB::table('surats')->insert([
                            'id_sewa' => $_SESSION['id_sewa'],
                            'surat_perjanjian' => $file->getClientOriginalName(),
                            'updated_at'    => date("Y-m-d H:i:s")
                        ]);
                        $surat = DB::Select("Select surat_perjanjian, id_sewa FROM surats Where id_sewa='".$_SESSION['id_sewa']."' ORDER BY updated_at DESC LIMIT 1");
                        return view('surat',compact('surat'));
                    }
    
                    
}