<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\ModelUser;
use Carbon\Carbon;
use App\Report;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\File_Gambar;
use File;
use Auth;

class menu_dashboard_con extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    
    function get_jml_akun(){
        $jml = ModelUser::all()->count();
        $week = Carbon::now()->subDays(7);
        $jml_weekly = ModelUser::where('tgl_join', '>', $week)->get()->count();
        $get = DB::select("SELECT reports.id AS id_reports, reports.kategori_report AS kategori, 
                            reports.created_at AS  tgl_report, reports.id_konten_reported AS id_konten, reports.id_comment_reported AS id_comment, reports.alasan_report alasan, reported_konten.username AS username_reported_konten, reported_comment.username AS username_reported_comment, reporter.username AS reporter, konten.foto_video_konten AS foto_video_konten, konten.caption AS caption, konten.created_at AS tgl, konten.slug AS slug, comment.isi_komentar AS komentar FROM reports 
                            LEFT JOIN pengguna reporter ON reports.account_reporter=reporter.id_pengguna
                            LEFT JOIN konten ON reports.id_konten_reported=konten.id_konten
                            LEFT JOIN pengguna reported_konten ON konten.id_pengguna=reported_konten.id_pengguna
                            LEFT JOIN comment ON reports.id_comment_reported=comment.id
                            LEFT JOIN konten k ON comment.id_konten = k.id_konten
                            LEFT JOIN pengguna reported_comment ON comment.id_pengguna=reported_comment.id_pengguna
                            WHERE reports.is_active = 1 AND (konten.id_group = 0 OR k.id_group = 0)
                        ");
        $akun = DB::select("SELECT jenis_akun, COUNT(*) AS jml FROM pengguna GROUP BY jenis_akun");
        $total_akun = DB::select("SELECT COUNT(*) AS total FROM pengguna");
        $device = DB::select("SELECT device, COUNT(*) AS jml FROM aktifitas_login GROUP BY device");
        $total_device = DB::select("SELECT COUNT(*) AS total FROM aktifitas_login");

        //Get List 5 Bulan Terakhir
        date_default_timezone_set("Asia/Jakarta");
        $monthAndYear = [];
        $total_pengguna = [];
        $date = new \DateTime();
        for($index = 0; $index < 5; $index++) {
            if ($index > 0) {
                $date->modify("-1 months");
                array_push($monthAndYear, $date->format('F Y'));		
            } else {
                array_push($monthAndYear, $date->format('F Y'));
            }
            
            //Bikin Query Berdasarkan Bulan Tersebut
            $total_pengguna[] = DB::table('pengguna')->whereRaw("CONCAT(MONTHNAME(tgl_join), " . '" "' . ", YEAR(tgl_join)) = " . '"' . $date->format('F Y') . '"')->count();
        }

        $total_pengguna = json_encode($total_pengguna);
        $monthAndYear = json_encode($monthAndYear);

        //Get List 5 Tahun Terakhir
        $year = [];
        $total_pengguna_year = [];
        for($index_y = 0; $index_y < 5; $index_y++) {
            if ($index_y > 0) {
                $date->modify("-1 years");
                array_push($year, $date->format('Y'));		
            } else {
                array_push($year, $date->format('Y'));
            }
            
            //Bikin Query Berdasarkan Tahun Tersebut
            $total_pengguna_year[] = DB::table('pengguna')->whereRaw("YEAR(tgl_join) = " . '"' . $date->format('Y') . '"')->count();
        }

        $total_pengguna_year = json_encode($total_pengguna_year);
        $year = json_encode($year);
        
        //Kirim Data ke View

        return view('super-admin/dashboard_admin', compact('jml', 'jml_weekly', 'get', 'akun', 'total_akun', 'device', 'total_device', 'monthAndYear', 'total_pengguna', 'year', 'total_pengguna_year'));
    }
}
