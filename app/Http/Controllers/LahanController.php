<?php

namespace App\Http\Controllers;

use App\Boq;
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
use App\Risk;
use App\Traits\NavbarTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use mysqli;

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
        $lahan = Lahan::paginate(9);
        $lahan = DB::select("SELECT p.nama as pemilik,l.statusLahan, l.id,l.category_lahan_id,l.ukuran,l.deskripsi,l.gambar, cl.nama, l.id_user, p.username FROM pengguna p JOIN lahans l ON p.id_pengguna = l.id_user JOIN category_lahans cl ON l.category_lahan_id = cl.id WHERE p.id_pengguna != '".Auth::user()->pengguna->id_pengguna."'");
        $total_notif = $this->total_notif();
        $list_notif_display = $this->list_notif_display();
        $notif_pesan = $this->notif_pesan();
        $notif_group = $this->notif_group();
        return view('lahan', compact('lahan', 'total_notif', 'list_notif_display', 'notif_pesan', 'notif_group'));
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
       
        $lahan = DB::select("SELECT p.nama as pemilik,l.statusLahan,l.id_user, l.id,l.category_lahan_id,l.ukuran,l.deskripsi,l.gambar, cl.nama FROM pengguna p JOIN lahans l ON p.id_pengguna = l.id_user JOIN category_lahans cl ON l.category_lahan_id = cl.id WHERE l.id = $id");
        $orang = DB::select("SELECT DISTINCT lr.keterangan, lr.resource FROM lahan_resources lr JOIN lahans s WHERE lr.id_resources = 1 AND lr.id_lahan = $id");
        $material = DB::select("SELECT DISTINCT lr.keterangan, lr.resource FROM lahan_resources lr JOIN lahans s WHERE lr.id_resources = 2 AND lr.id_lahan = $id");
        $alat = DB::select("SELECT DISTINCT lr.keterangan, lr.resource FROM lahan_resources lr JOIN lahans s WHERE lr.id_resources = 3 AND lr.id_lahan = $id");
        return view('detail_lahan',compact('lahan','orang','material','alat'));  
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
        $_SESSION['id_lahan'] = $id;
        $sewa = DB::select("SELECT nama,alamat,s.id_sewa,s.id_lahan, nik, foto_ktp, id_penyewa, s.status, s.progres FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa WHERE id_pengguna = ANY (SELECT s.id_penyewa FROM lahans l join sewa_lahans s on l.id = s.id_lahan) and s.id_lahan = $id  or p.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        return view('request', compact('sewa'));
    }

    public function accRequest($id){
        session_start();
        $lahan= Lahan::where('id', $_SESSION['id_lahan'])->update([
            'statusLahan' => "Not Ready",
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        $sewa= Sewa_lahan::where('id_penyewa', $id)->update([
            'status' => "Acc" ,
            'progres' => "Proses",
            'updated_at' => date("Y-m-d H:i:s")

        ]);
        //return redirect('lahan/kelola_lahan');
       
        $sewa = DB::select("SELECT nama,alamat,s.id_sewa, nik, foto_ktp,s.id_lahan, id_penyewa, s.status, s.progres FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa WHERE id_pengguna = ANY (SELECT s.id_penyewa FROM lahans l join sewa_lahans s on l.id = s.id_lahan) and s.id_lahan = $id or p.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
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
        
        $sewa = DB::select("SELECT nama,alamat,s.id_sewa, nik, foto_ktp,s.id_lahan, id_penyewa,s.id_sewa, s.status, s.progres FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa WHERE id_pengguna = ANY (SELECT s.id_penyewa FROM lahans l join sewa_lahans s on l.id = s.id_lahan) and s.id_lahan = $id or p.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        return view('request', compact('sewa'));
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
       
        $sewa = DB::select("SELECT nama,alamat,s.id_sewa, nik, foto_ktp, id_penyewa, s.status, s.progres FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa WHERE id_pengguna = ANY (SELECT s.id_penyewa FROM lahans l join sewa_lahans s on l.id = s.id_lahan) and s.id_lahan = $id or p.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        return view('request', compact('sewa'));
    }
    public function wbs(Request $request,$id){
        
        //$wbs = DB::select("SELECT w.harga, w.qty, w.satuan, w.totalHarga, text, duration,start_date, parent, t.id FROM tasks t JOIN lahans l on t.id_lahan =l.id JOIN wbs w on t.id = w.id_kegiatan");

        // $wbs1 = DB::select("SELECT w.harga,t.id as idNenek,s.id as idInduk, k.id as idAnak,w.qty,w.satuan, w.totalHarga, t.text, s.created_at, t.duration,s.start_date,t.text as nenek, s.text as induk, k.text as anak, k.parent FROM tasks t LEFT JOIN tasks s ON t.Id = s.parent LEFT JOIN tasks k on s.id = k.parent JOIN lahans l on t.id_lahan =l.id JOIN wbs w on t.id = w.id_kegiatan WHERE t.id_lahan = $request->id AND s.text is NOT null ORDER by s.parent ASC, s.created_at ASC");

        $wbs = DB::select("SELECT a.harga as hargaNenek, a.satuan as satuanNenek, a.totalHarga as thNenek, a.qty as qtyNenek, a.start_date as tanggalNenek ,b.harga as hargaIbu, b.satuan as satuanIbu, b.totalHarga as thIbu, b.qty as qtyIbu,b.start_date as tanggalIbu,c.start_date as tanggalCucu, a.id as Id_Nenek,a.text as Nenek,a.parent as Parent_Nenek,b.id as Id_Ibu, b.text as Ibu,b.parent as parent_Ibu,c.id as Id_Cucu,c.harga as hargaCucu, c.satuan as satuanCucu, c.totalHarga as thCucu, c.qty as qtyCucu, c.text as Cucu,c.parent as Parent_Cucu from tasks a left join tasks b on a.id = b.parent LEFT JOIN tasks c on b.id = c.parent JOIN lahans l on a.id_lahan =l.id WHERE a.id_lahan = $request->id AND a.parent =0 ORDER BY a.id asc,a.parent asc,b.id asc, b.parent asc,c.id asc, c.parent asc");

        
        return view('create_wbs', compact('wbs'));
    }
    public function wbs_user($id){
        
        $wbs = DB::select("SELECT w.harga, w.qty, w.totalHarga, text, duration,start_date, parent, t.id FROM tasks t JOIN lahans l on t.id_lahan =l.id JOIN wbs w on t.id = w.id_kegiatan");
        return view('wbs_user', compact('wbs'));
    
    }
    public function simpan_wbs(Request $request){
        session_start();
        $total = $request->qty * $request->harga;
        $wbs= Task::where('id', $request->id)->update([
            'qty' => $request->qty,
            'satuan' => $request->satuan,
            'harga' => $request->harga,
            'totalHarga' => $total,
            'updated_at' => date("Y-m-d H:i:s")
        ]);
       // $wbs = DB::select("SELECT w.harga, w.qty, w.totalHarga, text, duration,start_date, parent, t.id FROM tasks t JOIN lahans l on t.id_lahan =l.id JOIN wbs w on t.id = w.id_kegiatan");
        $wbs = DB::select("SELECT a.harga as hargaNenek, a.satuan as satuanNenek, a.totalHarga as thNenek, a.qty as qtyNenek, a.start_date as tanggalNenek ,b.harga as hargaIbu, b.satuan as satuanIbu, b.totalHarga as thIbu, b.qty as qtyIbu,b.start_date as tanggalIbu,c.start_date as tanggalCucu, a.id as Id_Nenek,a.text as Nenek,a.parent as Parent_Nenek,b.id as Id_Ibu, b.text as Ibu,b.parent as parent_Ibu,c.id as Id_Cucu,c.harga as hargaCucu, c.satuan as satuanCucu, c.totalHarga as thCucu, c.qty as qtyCucu, c.text as Cucu,c.parent as Parent_Cucu from tasks a left join tasks b on a.id = b.parent LEFT JOIN tasks c on b.id = c.parent JOIN lahans l on a.id_lahan =l.id WHERE a.id_lahan = '".$_SESSION['id_lahan']."' AND a.parent =0 ORDER BY a.id asc,a.parent asc,b.id asc, b.parent asc,c.id asc, c.parent asc");
        
       return view('create_wbs', compact('wbs'));
       
    }

    public function update_wbs($id){
        $wbs = Task::select('*')->where('id', $id)->get();
        $wbs1 = Task::select('*')->where('id', $id)->get();
        
        return view('updateWbs', compact('wbs','wbs1'));
        //return view('kelola_lahan', compact('lahan'));

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
        
    // }
    public function createRisk($id){
        $risk = Sewa_lahan::select('*')->where('id_sewa', $id)->get();
        return view('create_risk',compact('risk'));
    }

    public function simpan_risk(Request $request){
        // menyimpan data file yang diupload ke variabel $file
        if($request->probabilitas * $request->impact <= 2){
            $level = "Low";
        }elseif($request->probabilitas * $request->impact == 3 or $request->probabilitas * $request->impact == 4 ){
            $level = "Medium";
        }else{
            $level = "High";
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
            'status'        => '-',
            'updated_at'    => date("Y-m-d H:i:s")
        ]);
            $risk = DB::select("SELECT r.id_sewa,r.penyebab,r.dampak,r.strategi,r.biaya,r.probabilitas,r.impact,r.levelRisk,r.status,r.updated_at,s.id_lahan FROM risks r JOIN sewa_lahans s ON r.id_sewa= s.id_sewa where r.id_sewa = $request->id_sewa");
            $risk2 = DB::select("SELECT DISTINCT nama, nik FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa JOIN risks r on r.id_sewa = s.id_sewa where s.id_sewa = $request->id_sewa");
            $risk3 = DB::select("SELECT id_sewa FROM sewa_lahans where id_sewa = $request->id_sewa");
            return view('kelola_risk', compact('risk','risk2','risk3'));
        }

        public function risk($id){
        
            $risk = DB::select("SELECT nama,s.id_sewa,s.id_lahan, nik, id_penyewa, r.levelRisk,r.status, r.penyebab, r.strategi, r.dampak, r.biaya, r.probabilitas, r.impact,r.levelRisk, r.status FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa JOIN risks r on r.id_sewa = s.id_sewa WHERE s.id_sewa = $id  or p.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
            $risk2 = DB::select("SELECT DISTINCT nama, nik FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa JOIN risks r on r.id_sewa = s.id_sewa where s.id_sewa = $id");
            $risk3 = DB::select("SELECT id_sewa FROM sewa_lahans WHERE id_sewa = $id");
        return view('kelola_risk', compact('risk','risk2', 'risk3'));
        }
        public function createBoq(Request $request, $id){


            $boq = DB::select("SELECT b.harga,s.id, b.qty,b.satuan, b.totalHarga, t.text, s.created_at, t.duration,s.start_date,t.text as induk, s.text as anak, s.parent FROM tasks t LEFT JOIN tasks s ON t.Id = s.parent JOIN lahans l on t.id_lahan =l.id JOIN boqs b on t.id = b.id_task WHERE t.id_lahan = $request->id AND s.text is NOT null ORDER by s.parent ASC, s.created_at ASC");

            $boq1 = DB::select("SELECT s.id_boq, s.harga,t.id, s.qty,s.satuan, s.totalHarga, k.text as nenek,t.text as induk,k.start_date, s.kegiatan as anak, s.parent, k.id FROM tasks k LEFT join tasks t on k.id= t.parent JOIN lahans l on t.id_lahan =l.id JOIN boqs b on t.id = b.id_task LEFT JOIN boqs s ON b.id_boq = s.parent WHERE t.id_lahan = $request->id AND b.id_boq IS NOT null ORDER by k.id asc, b.id_task ASC ");


        
            return view('create_boq', compact('boq'));

             }


        
        public function simpan_Boq(Request $request){
            // menyimpan data file yang diupload ke variabel $file            
            DB::table('rab')->insert([
                'id_sewa'       => $request->id_sewa,
                'penyebab'      => $request->penyebab,
                'dampak'        => $request->dampak,
                'strategi'      => $request->strategi,
                'biaya'         => $request->biaya,
                'probabilitas'  => $request->probabilitas,
                'impact'        => $request->impact,
                'levelRisk'     => $level,
                'status'        => '-',
                'updated_at'    => date("Y-m-d H:i:s")

            ]);
            $boq = DB::select("SELECT r.id_sewa,r.penyebab,r.dampak,r.strategi,r.biaya,r.probabilitas,r.impact,r.levelRisk,r.status,r.updated_at,s.id_lahan FROM risks r JOIN sewa_lahans s ON r.id_sewa= s.id_sewa");
            return view('kelola_risk', compact('risk'));
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
        DB::table('dailys')->insert([
            'id_sewa'       => $request->id_sewa,
            'gambar'        => $file->getClientOriginalName(),
            'keterangan'    => $request->keterangan,
            'date'          => $request->date,
            'updated_at'     => date("Y-m-d H:i:s")
        ]);
            $daily = DB::select("SELECT d.id_sewa,d.gambar,d.keterangan,d.date,d.updated_at,s.id_lahan FROM dailys d JOIN sewa_lahans s ON d.id_sewa= s.id_sewa where d.id_sewa = $request->id_sewa");
            $daily2 = DB::select("SELECT DISTINCT nama, nik FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa JOIN dailys d on d.id_sewa = s.id_sewa where s.id_sewa = $request->id_sewa");
            $daily3 = DB::select("SELECT id_sewa FROM sewa_lahans where id_sewa = $request->id_sewa");
           
            return view('kelola_daily', compact('daily','daily2','daily3'));
        }

    
        public function daily($id){
           
                $daily = DB::select("SELECT nama,s.id_sewa,s.id_lahan, nik, id_penyewa, d.id_daily, d.gambar,d.keterangan, d.date, d.updated_at FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa JOIN dailys d on d.id_sewa = s.id_sewa WHERE s.id_sewa = $id  or p.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
                $daily2 = DB::select("SELECT DISTINCT nama, nik FROM pengguna p join sewa_lahans s on p.id_pengguna = s.id_penyewa JOIN dailys d on d.id_sewa = s.id_sewa where s.id_sewa = $id");
                $daily3 = DB::select("SELECT id_sewa FROM sewa_lahans WHERE id_sewa = $id ");
            return view('kelola_daily', compact('daily','daily2','daily3'));
        }

        public function orang($id){
            $sdm = Lahan::select('*')->where('id', $id)->get();
            return view('orang',compact('sdm'));
        }
        public function material($id){
            $sdm = Lahan::select('*')->where('id', $id)->get();
            return view('material',compact('sdm'));
        }
        public function alat($id){
            $sdm = Lahan::select('*')->where('id', $id)->get();
            return view('alat',compact('sdm'));
        }

        public function simpan_material(Request $request, $id){   
            DB::table('lahan_resources')->insert([
                'resource'        => $request->resource,
                'id_lahan'        => $request->id_lahan,
                'keterangan'      => $request->keterangan,
                'id_resources'    => 2,
                'updated_at'      => date("Y-m-d H:i:s")
            ]);
            
               
                //return view('kelola_risk', compact('risk'));
            }
        
            public function simpan_orang(Request $request, $id){   
                DB::table('lahan_resources')->insert([
                    'resource'        => $request->resource,
                    'id_lahan'        => $request->id_lahan,
                    'keterangan'      => $request->keterangan,
                    'id_resources'    => 1,
                    'updated_at'      => date("Y-m-d H:i:s")
                ]);
                
                   
                    //return view('kelola_risk', compact('risk'));
                }
                public function simpan_alat(Request $request, $id){   
                    DB::table('lahan_resources')->insert([
                        'resource'        => $request->resource,
                        'id_lahan'        => $request->id_lahan,
                        'keterangan'      => $request->keterangan,
                        'id_resources'    => 3,
                        'updated_at'      => date("Y-m-d H:i:s")
                    ]);
                    
                       
                        //return view('kelola_risk', compact('risk'));
                    }       
}