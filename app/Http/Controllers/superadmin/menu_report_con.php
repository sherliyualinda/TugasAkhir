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

class menu_report_con extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

    function get_report(){
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
        $get_hs = DB::select("SELECT reports.id AS id_reports, reports.kategori_report AS kategori, 
                            reports.created_at AS  tgl_report, reports.id_konten_reported AS id_konten, reports.id_comment_reported AS id_comment, reports.alasan_report alasan, reported_konten.username AS username_reported_konten, reported_comment.username AS username_reported_comment, reporter.username AS reporter, konten.foto_video_konten AS foto_video_konten, konten.caption AS caption, konten.created_at AS tgl, konten.slug AS slug, comment.isi_komentar AS komentar FROM reports 
                            LEFT JOIN pengguna reporter ON reports.account_reporter=reporter.id_pengguna
                            LEFT JOIN konten ON reports.id_konten_reported=konten.id_konten
                            LEFT JOIN pengguna reported_konten ON konten.id_pengguna=reported_konten.id_pengguna
                            LEFT JOIN comment ON reports.id_comment_reported=comment.id
                            LEFT JOIN konten k ON comment.id_konten = k.id_konten
                            LEFT JOIN pengguna reported_comment ON comment.id_pengguna=reported_comment.id_pengguna
                            WHERE reports.is_active != 1 AND (konten.id_group = 0 OR k.id_group = 0)
                        ");
        return view('super-admin/list_report', compact('get', 'get_hs'));
    }

    function get_report_list(Request $request){
        $draw = $request->post('draw', 1);
        $param = $request->post('param', []);
        $start = $request->post('start', 0);
        $length = $request->post('length', 10);
        if(isset($param['tipe']) && (!empty($param['tipe'])) && $param['tipe'] == 'histori'){
            $model_filter = DB::table('reports')
                        ->leftjoin('pengguna AS reporter', 'reports.account_reporter', '=', 'reporter.id_pengguna')
                        ->leftjoin('konten', 'reports.id_konten_reported', '=', 'konten.id_konten')
                        ->leftjoin('pengguna AS reported_konten', 'konten.id_pengguna', '=', 'reported_konten.id_pengguna')
                        ->leftjoin('comment', 'reports.id_comment_reported', '=', 'comment.id')
                        ->leftjoin('konten AS konten_cmt', 'comment.id_konten', '=', 'konten_cmt.id_konten')
                        ->leftjoin('pengguna AS reported_comment', 'comment.id_pengguna', '=', 'reported_comment.id_pengguna')
                        ->where('reports.is_active', '<>', '1')
                        ->where(function($query) {
                                $query->where('konten.id_group', '0')
                                ->orWhere('konten_cmt.id_group', '0');
                            });
            $data_total = DB::table('reports')
                        ->leftjoin('konten', 'reports.id_konten_reported', '=', 'konten.id_konten')
                        ->leftjoin('comment', 'reports.id_comment_reported', '=', 'comment.id')
                        ->leftjoin('konten AS konten_cmt', 'comment.id_konten', '=', 'konten_cmt.id_konten')
                        ->where('reports.is_active', '<>', '1')
                        ->where(function($query) {
                                $query->where('konten.id_group', '0')
                                ->orWhere('konten_cmt.id_group', '0');
                            })
                        ->count();
            $model = DB::table('reports')
                        ->select('reports.created_at', 'reports.is_active', 'reports.kategori_report', 'reported_konten.username AS username_reported', 'reported_comment.username AS username_cmt_reported', 'reports.alasan_report', 'reporter.username AS username_reporter', 'reports.id AS id_rep', 'konten.id_konten', 'konten.slug', 'comment.id')
                        ->leftjoin('pengguna AS reporter', 'reports.account_reporter', '=', 'reporter.id_pengguna')
                        ->leftjoin('konten', 'reports.id_konten_reported', '=', 'konten.id_konten')
                        ->leftjoin('pengguna AS reported_konten', 'konten.id_pengguna', '=', 'reported_konten.id_pengguna')
                        ->leftjoin('comment', 'reports.id_comment_reported', '=', 'comment.id')
                        ->leftjoin('konten AS konten_cmt', 'comment.id_konten', '=', 'konten_cmt.id_konten')
                        ->leftjoin('pengguna AS reported_comment', 'comment.id_pengguna', '=', 'reported_comment.id_pengguna')
                        ->where('reports.is_active', '<>', '1')
                        ->where(function($query) {
                                $query->where('konten.id_group', '0')
                                ->orWhere('konten_cmt.id_group', '0');
                            })
                        ->orderby('reports.created_at', 'DESC');
            if(isset($request->search['value']) && !empty($request->search['value'])){
                $keyword = $request->search['value'];
                $model_filter->where(function($query) use($keyword) {
                    $query->where(DB::raw('lower(reported_comment.username)'), 'LIKE', '%' . strtolower($keyword) . '%')
                    ->orWhere(DB::raw('lower(reported_konten.username)'), 'LIKE', '%' . strtolower($keyword) . '%')
                    ->orWhere(DB::raw('lower(reports.alasan_report)'), 'LIKE', '%' . strtolower($keyword) . '%');
                });
                $model->where(function($query) use($keyword) {
                    $query->where(DB::raw('lower(reported_comment.username)'), 'LIKE', '%' . strtolower($keyword) . '%')
                    ->orWhere(DB::raw('lower(reported_konten.username)'), 'LIKE', '%' . strtolower($keyword) . '%')
                    ->orWhere(DB::raw('lower(reports.alasan_report)'), 'LIKE', '%' . strtolower($keyword) . '%');
                });
            }
            $record_filter = $model_filter->count();
            $data = $model->limit($length)->offset($start)->get();
        }else{
            $model_filter = DB::table('reports')
                        ->leftjoin('pengguna AS reporter', 'reports.account_reporter', '=', 'reporter.id_pengguna')
                        ->leftjoin('konten', 'reports.id_konten_reported', '=', 'konten.id_konten')
                        ->leftjoin('pengguna AS reported_konten', 'konten.id_pengguna', '=', 'reported_konten.id_pengguna')
                        ->leftjoin('comment', 'reports.id_comment_reported', '=', 'comment.id')
                        ->leftjoin('konten AS konten_cmt', 'comment.id_konten', '=', 'konten_cmt.id_konten')
                        ->leftjoin('pengguna AS reported_comment', 'comment.id_pengguna', '=', 'reported_comment.id_pengguna')
                        ->where('reports.is_active', '1')
                        ->where(function($query) {
                                $query->where('konten.id_group', '0')
                                ->orWhere('konten_cmt.id_group', '0');
                            });
            $data_total = DB::table('reports')
                        ->leftjoin('konten', 'reports.id_konten_reported', '=', 'konten.id_konten')
                        ->leftjoin('comment', 'reports.id_comment_reported', '=', 'comment.id')
                        ->leftjoin('konten AS konten_cmt', 'comment.id_konten', '=', 'konten_cmt.id_konten')
                        ->where('reports.is_active', '1')
                        ->where(function($query) {
                                $query->where('konten.id_group', '0')
                                ->orWhere('konten_cmt.id_group', '0');
                            })
                        ->count();
            $model = DB::table('reports')
                        ->select('reports.created_at', 'reports.is_active', 'reports.kategori_report', 'reported_konten.username AS username_reported', 'reported_comment.username AS username_cmt_reported', 'reports.alasan_report', 'reporter.username AS username_reporter', 'reports.id AS id_rep', 'konten.id_konten', 'konten.slug', 'comment.id')
                        ->leftjoin('pengguna AS reporter', 'reports.account_reporter', '=', 'reporter.id_pengguna')
                        ->leftjoin('konten', 'reports.id_konten_reported', '=', 'konten.id_konten')
                        ->leftjoin('pengguna AS reported_konten', 'konten.id_pengguna', '=', 'reported_konten.id_pengguna')
                        ->leftjoin('comment', 'reports.id_comment_reported', '=', 'comment.id')
                        ->leftjoin('konten AS konten_cmt', 'comment.id_konten', '=', 'konten_cmt.id_konten')
                        ->leftjoin('pengguna AS reported_comment', 'comment.id_pengguna', '=', 'reported_comment.id_pengguna')
                        ->where('reports.is_active', '1')
                        ->where(function($query) {
                                $query->where('konten.id_group', '0')
                                ->orWhere('konten_cmt.id_group', '0');
                            })
                        ->orderby('reports.created_at', 'DESC');
            if(isset($request->search['value']) && !empty($request->search['value'])){
                $keyword = $request->search['value'];
                $model_filter->where(function($query) use($keyword) {
                    $query->where(DB::raw('lower(reported_comment.username)'), 'LIKE', '%' . strtolower($keyword) . '%')
                    ->orWhere(DB::raw('lower(reported_konten.username)'), 'LIKE', '%' . strtolower($keyword) . '%')
                    ->orWhere(DB::raw('lower(reports.alasan_report)'), 'LIKE', '%' . strtolower($keyword) . '%');
                });
                $model->where(function($query) use($keyword) {
                    $query->where(DB::raw('lower(reported_comment.username)'), 'LIKE', '%' . strtolower($keyword) . '%')
                    ->orWhere(DB::raw('lower(reported_konten.username)'), 'LIKE', '%' . strtolower($keyword) . '%')
                    ->orWhere(DB::raw('lower(reports.alasan_report)'), 'LIKE', '%' . strtolower($keyword) . '%');
                });
            }
            $record_filter = $model_filter->count();
            $data = $model->limit($length)->offset($start)->get();
        }
        $json = array(
                "draw" => $draw,
                "recordsTotal" => $data_total,
                "recordsFiltered" => $record_filter,
                "data" => $data,
                "data_cari"  => $request->search['value']
            );

        return response()->json($json);
    }

    function get_content_of_comment($id_comment){
        $row = DB::table('comment')->where('id', $id_comment)->select('id_konten')->first();
        $data = DB::table('konten')->where('id_konten', $row->id_konten)->select('slug')->get();
        // dd($data);
        return response()->json($data);
    }

    function delete_reported_content($id_konten){
        $data = DB::table('comment')->where('id_konten', $id_konten)->get();
        foreach($data as $row){
            $id_comment = $row->id;
            DB::table('notif')->where('id_comment', $id_comment)->update(['is_active'=>0]);
        }
        $data = DB::table('likes')->where('id_konten', $id_konten)->get();
        foreach($data as $row){
            $id_likes = $row->id;
            DB::table('notif')->where('id_likes', $id_likes)->update(['is_active'=>0]);
        }
        DB::table('comment')->where('id_konten', $id_konten)->update(['is_active'=>0]);
        DB::table('likes')->where('id_konten', $id_konten)->update(['is_active'=>0]);
        File_Gambar::where('id_konten', $id_konten)->update(['is_active'=>0]);
        DB::table('reports')->where('id_konten_reported', $id_konten)->update(['is_active'=>0]);
    }

    function delete_reported_comment($id_comment){
        $data = DB::table('comment')->where('id', $id_comment)->get();
        foreach($data as $row){
            $id_comment = $row->id;
            DB::table('notif')->where('id_comment', $id_comment)->update(['is_active'=>0]);
        }
        DB::table('comment')->where('id', $id_comment)
                            ->orWhere('id_balas_komen', $id_comment)->update(['is_active'=>0]);
        DB::table('reports')->where('id_comment_reported', $id_comment)->update(['is_active'=>0]);
    }

    function decline_reports($id_reports){
        $tmp = DB::table('reports')->where('id', $id_reports)->get();
        if(!empty($tmp)){
            if($tmp[0]->kategori_report == 'Konten'){
                $id = $tmp[0]->id_konten_reported;
                $data = DB::table('likes')->where('id_konten', $id)->get();
                foreach($data as $row){
                    $id_likes = $row->id;
                    DB::table('notif')->where('id_likes', $id_likes)->update(['is_active'=>1]);
                }
                $data = DB::table('comment')->where('id_konten', $id)->get();
                foreach($data as $row){
                    $id_comment = $row->id;
                    DB::table('notif')->where('id_comment', $id_comment)->update(['is_active'=>1]);
                }
                DB::table('comment')->where('id_konten', $id)->update(['is_active'=>1]);
                DB::table('likes')->where('id_konten', $id)->update(['is_active'=>1]);
                File_Gambar::where('id_konten', $id)->update(['is_active'=>1]);
            }else{
                $id = $tmp[0]->id_comment_reported;
                DB::table('notif')->where('id_comment', $id)->update(['is_active'=>1]);
                DB::table('comment')->where('id', $id)
                            ->orWhere('id_balas_komen', $id)->update(['is_active'=>1]);
            }
            DB::table('reports')->where('id', $id_reports)->update(['is_active'=>2]);
        }
    }
}
