<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\ModelUser;
use App\Report;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\File_Gambar;
use File;
use Auth;

class menu_pengguna_con extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    
    function get_all_akun(){
        $akun_desa = ModelUser::where('jenis_akun', 'desa')->orderby('tgl_join', 'DESC')->get();
        $akun_pribadi = ModelUser::where('jenis_akun', 'pribadi')->orderby('tgl_join', 'DESC')->get();
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
        return view('super-admin/list_pengguna', compact('akun_desa', 'akun_pribadi', 'get'));
    }
}
