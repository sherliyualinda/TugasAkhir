<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\File_Gambar;
use App\Models\VideoView;
use App\Models\Video;
use App\Pengguna;
use File;
use Auth;

class Sosmed_Con extends Controller{
    public function __construct(){
        $this->middleware('auth')->except(['konten_detail_by_slug', 'konten_group_detail_by_slug', 'lihat_profil']);
    }

    public function total_notif(){
        $data_notif = DB::select("SELECT * FROM pengaturan WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        foreach ($data_notif as $row) {
            $pilihan_notif_menyukai = $row->notifikasi_menyukai;
            $pilihan_notif_komentar = $row->notifikasi_komentar;
            $pilihan_notif_pesan    = $row->notifikasi_pesan;
        }

        $kondisi = array();

        if($pilihan_notif_menyukai == 'dari orang yang saya ikuti'){
            $kondisi[] = "likes.id_konten IN (SELECT id_konten FROM konten WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND likes.id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND likes.id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna='".Auth::user()->pengguna->id_pengguna."')";
        }else if($pilihan_notif_menyukai == 'dari semua orang'){
            $kondisi[] = "likes.id_konten IN (SELECT id_konten FROM konten WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND likes.id_pengguna != '".Auth::user()->pengguna->id_pengguna."'";
        }

        if($pilihan_notif_komentar == 'dari orang yang saya ikuti'){
            $kondisi[] = "comment.id_konten IN (SELECT id_konten FROM konten WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND comment.id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND (comment.id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna='".Auth::user()->pengguna->id_pengguna."') OR comment.isi_komentar LIKE '%".Auth::user()->pengguna->username."%') AND comment.status = 'Belum Dibaca'";
        }else if($pilihan_notif_komentar == 'dari semua orang'){
            $kondisi[] = "comment.id_konten IN (SELECT id_konten FROM konten WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND comment.id_pengguna != '".Auth::user()->pengguna->id_pengguna."' OR comment.isi_komentar LIKE '%".Auth::user()->pengguna->username."%' AND comment.status = 'Belum Dibaca'";
        }

        $kondisi[] = "anggota_grup.id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND konten_group.id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND notif.id_anggota IN (SELECT id_anggota FROM anggota_grup WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."')";

        $kondisi[] = "undangan_grup.status = 'Menunggu' AND undangan_grup.id_pengguna_penerima = '".Auth::user()->pengguna->id_pengguna."'";

        $kondisi[] = "admin_grup.id_admin = '".Auth::user()->pengguna->id_pengguna."'";

        $kondisi[] = "followers.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'";

        $kondisi[] = "follow_request.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'";
        
        $kondisi[] = "video_subscribes.id_user = '".Auth::user()->id."'";

        $all_kondisi = ' WHERE '.implode(" OR ", $kondisi);
        $list_notif = DB::select("SELECT DISTINCT notif.jenis_notif jenis_notif, pengguna_likes.username username_likers, likes.tanggal_like tanggal_like, konten_likes.foto_video_konten foto_video_konten, pengguna_likes.foto_profil foto_profil_likers, pengguna_comment.foto_profil foto_profil_commentor, pengguna_comment.username username_commentor, comment.isi_komentar isi_komentar, comment.tanggal_komen tanggal_komen, konten_comment.foto_video_konten foto_video_konten_komen, pengguna_grup.foto_profil foto_profil_post, pengguna_grup.username username_post, grup.nama_group nama_group, konten_group.created_at created_at, pengundang.foto_profil foto_pengirim, pengundang.username username_pengirim, grup_undangan.nama_group nama_group_undangan, undangan_grup.tanggal_undangan tanggal_undangan, undangan_grup.id id, pengguna_followers.foto_profil foto_profil_followers, pengguna_followers.username username_followers, notif.created_at tanggal_follow, pengguna_requester.foto_profil foto_requester, pengguna_requester.username username_requester, grup_adm.nama_group nama_group_adm, admin_penambah.foto_profil foto_admin_penambah, admin_penambah.username username_admin_penambah, notif.created_at tanggal_admin FROM notif 
            LEFT JOIN likes ON notif.id_likes = likes.id AND notif.jenis_notif = 'Menyukai' AND notif.status = 'Belum Dibaca'
            LEFT JOIN konten konten_likes ON likes.id_konten = konten_likes.id_konten 
            LEFT JOIN pengguna pengguna_likes ON likes.id_pengguna = pengguna_likes.id_pengguna 
            LEFT JOIN comment ON notif.id_comment = comment.id AND notif.jenis_notif = 'Komentar' AND notif.status = 'Belum Dibaca'
            LEFT JOIN konten konten_comment ON comment.id_konten = konten_comment.id_konten 
            LEFT JOIN pengguna pengguna_comment ON comment.id_pengguna = pengguna_comment.id_pengguna
            LEFT JOIN konten konten_group ON notif.id_konten = konten_group.id_konten AND notif.jenis_notif = 'Post Grup' AND notif.status = 'Belum Dibaca'
            LEFT JOIN pengguna pengguna_grup ON konten_group.id_pengguna = pengguna_grup.id_pengguna
            LEFT JOIN grup ON konten_group.id_group = grup.id_group
            LEFT JOIN anggota_grup ON grup.id_group = anggota_grup.id_group
            LEFT JOIN undangan_grup ON notif.id_undangan = undangan_grup.id AND notif.jenis_notif = 'Undangan Grup' AND notif.status = 'Belum Dibaca'
            LEFT JOIN grup grup_undangan ON undangan_grup.id_group = grup_undangan.id_group
            LEFT JOIN pengguna pengundang ON undangan_grup.id_pengguna_pengirim = pengundang.id_pengguna 
            LEFT JOIN admin_grup ON notif.id_undangan = admin_grup.id AND notif.jenis_notif = 'Admin Grup' AND notif.status = 'Belum Dibaca' 
            LEFT JOIN grup grup_adm ON admin_grup.id_group = grup_adm.id_group 
            LEFT JOIN pengguna admin ON admin_grup.id_admin = admin.id_pengguna 
            LEFT JOIN pengguna admin_penambah ON admin_grup.id_admin_penambah = admin_penambah.id_pengguna
            LEFT JOIN followers ON notif.id_followers = followers.id AND notif.jenis_notif = 'Followers' AND notif.status = 'Belum Dibaca'
            LEFT JOIN pengguna pengguna_followers ON followers.id_followers = pengguna_followers.id_pengguna 
            LEFT JOIN follow_request ON notif.id_followers = follow_request.id AND notif.jenis_notif = 'Followers' AND notif.status = 'Belum Dibaca'
            LEFT JOIN videos ON notif.id_video = videos.id AND notif.jenis_notif = 'Subscriber' AND notif.status = 'Belum Dibaca'
            LEFT JOIN video_subscribes ON notif.id_video = videos.id
            LEFT JOIN pengguna pengguna_requester ON follow_request.id_requester = pengguna_requester.id_pengguna $all_kondisi ORDER BY notif.created_at DESC");
    
        return $total_notif = sizeof($list_notif);
    }

    public function list_notif_display(){
        $data_notif = DB::select("SELECT * FROM pengaturan WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        foreach ($data_notif as $row) {
            $pilihan_notif_menyukai = $row->notifikasi_menyukai;
            $pilihan_notif_komentar = $row->notifikasi_komentar;
            $pilihan_notif_pesan    = $row->notifikasi_pesan;
        }

        $kondisi = array();

        if($pilihan_notif_menyukai == 'dari orang yang saya ikuti'){
            $kondisi[] = "likes.id_konten IN (SELECT id_konten FROM konten WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND likes.id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND likes.id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna='".Auth::user()->pengguna->id_pengguna."')";
        }else if($pilihan_notif_menyukai == 'dari semua orang'){
            $kondisi[] = "likes.id_konten IN (SELECT id_konten FROM konten WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND likes.id_pengguna != '".Auth::user()->pengguna->id_pengguna."'";
        }

        if($pilihan_notif_komentar == 'dari orang yang saya ikuti'){
            $kondisi[] = "comment.id_konten IN (SELECT id_konten FROM konten WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND comment.id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND comment.id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna='".Auth::user()->pengguna->id_pengguna."') OR comment.isi_komentar LIKE '%".Auth::user()->pengguna->username."%'";
        }else if($pilihan_notif_komentar == 'dari semua orang'){
            $kondisi[] = "comment.id_konten IN (SELECT id_konten FROM konten WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND comment.id_pengguna != '".Auth::user()->pengguna->id_pengguna."' OR comment.isi_komentar LIKE '%".Auth::user()->pengguna->username."%'";
        }

        $kondisi[] = "anggota_grup.id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND konten_group.id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND notif.id_anggota IN (SELECT id_anggota FROM anggota_grup WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."')";

        $kondisi[] = "undangan_grup.status = 'Menunggu' AND undangan_grup.id_pengguna_penerima = '".Auth::user()->pengguna->id_pengguna."'";

        $kondisi[] = "admin_grup.id_admin = '".Auth::user()->pengguna->id_pengguna."'";

        $kondisi[] = "followers.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'";

        $kondisi[] = "follow_request.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'";

        $kondisi[] = "video_subscribes.id_user = '".Auth::user()->id."'";

        $all_kondisi = ' WHERE '.implode(" OR ", $kondisi);
        return $list_notif_display = DB::select("SELECT DISTINCT notif.id_notif id_notification, notif.isi_notif isi_notif, notif.jenis_notif jenis_notif,  pengguna_konten.username username_konten, pengguna_likes.username username_likers, likes.tanggal_like tanggal_like, konten_likes.id_konten id_konten_likes, konten_likes.created_at tgl_konten, konten_likes.foto_video_konten foto_video_konten, konten_likes.slug slugg, pengguna_likes.foto_profil foto_profil_likers, pengguna_konten_2.username username_konten_2, pengguna_comment.foto_profil foto_profil_commentor, pengguna_comment.username username_commentor, comment.isi_komentar isi_komentar, comment.tanggal_komen tanggal_komen, konten_comment.created_at tgl_konten_2, konten_comment.id_konten id_konten_komen, konten_comment.foto_video_konten foto_video_konten_komen, konten_comment.slug slug, pengguna_grup.foto_profil foto_profil_post, pengguna_grup.username username_post, grup.nama_group nama_group, grup.id_group id_group, konten_group.created_at created_at, pengundang.foto_profil foto_pengirim, pengundang.username username_pengirim, grup_undangan.nama_group nama_group_undangan, undangan_grup.tanggal_undangan tanggal_undangan, undangan_grup.id id, pengguna_followers.foto_profil foto_profil_followers, pengguna_followers.username username_followers, pengguna_requester.foto_profil foto_requester, pengguna_requester.username username_requester, follow_request.id id_request, follow_request.status status_request, notif.created_at tanggal_follow, grup_adm.nama_group nama_group_adm, grup_adm.id_group id_group_adm, admin_penambah.foto_profil foto_admin_penambah, admin_penambah.username username_admin_penambah, notif.created_at tanggal_admin, videos.title judul_video, videos.thumbnail video_thumbnail, videos.id id_video FROM notif 
            LEFT JOIN likes ON notif.id_likes = likes.id AND notif.jenis_notif = 'Menyukai' 
            LEFT JOIN konten konten_likes ON likes.id_konten = konten_likes.id_konten 
            LEFT JOIN pengguna pengguna_konten ON konten_likes.id_pengguna = pengguna_konten.id_pengguna
            LEFT JOIN pengguna pengguna_likes ON likes.id_pengguna = pengguna_likes.id_pengguna 
            LEFT JOIN comment ON notif.id_comment = comment.id AND notif.jenis_notif = 'Komentar' 
            LEFT JOIN konten konten_comment ON comment.id_konten = konten_comment.id_konten 
            LEFT JOIN pengguna pengguna_konten_2 ON konten_comment.id_pengguna = pengguna_konten_2.id_pengguna
            LEFT JOIN pengguna pengguna_comment ON comment.id_pengguna = pengguna_comment.id_pengguna
            LEFT JOIN konten konten_group ON notif.id_konten = konten_group.id_konten AND notif.jenis_notif = 'Post Grup' 
            LEFT JOIN pengguna pengguna_grup ON konten_group.id_pengguna = pengguna_grup.id_pengguna
            LEFT JOIN grup ON konten_group.id_group = grup.id_group
            LEFT JOIN anggota_grup ON grup.id_group = anggota_grup.id_group
            LEFT JOIN undangan_grup ON notif.id_undangan = undangan_grup.id AND notif.jenis_notif = 'Undangan Grup' 
            LEFT JOIN grup grup_undangan ON undangan_grup.id_group = grup_undangan.id_group
            LEFT JOIN pengguna pengundang ON undangan_grup.id_pengguna_pengirim = pengundang.id_pengguna 
            LEFT JOIN admin_grup ON notif.id_undangan = admin_grup.id AND notif.jenis_notif = 'Admin Grup'
            LEFT JOIN grup grup_adm ON admin_grup.id_group = grup_adm.id_group 
            LEFT JOIN pengguna admin ON admin_grup.id_admin = admin.id_pengguna 
            LEFT JOIN pengguna admin_penambah ON admin_grup.id_admin_penambah = admin_penambah.id_pengguna 
            LEFT JOIN followers ON notif.id_followers = followers.id AND notif.jenis_notif = 'Followers' 
            LEFT JOIN pengguna pengguna_followers ON followers.id_followers = pengguna_followers.id_pengguna
            LEFT JOIN follow_request ON notif.id_followers = follow_request.id AND notif.jenis_notif = 'Followers' 
            LEFT JOIN videos ON notif.id_video = videos.id AND notif.jenis_notif = 'Subscriber' AND notif.status = 'Belum Dibaca'
            LEFT JOIN video_subscribes ON notif.id_video = videos.id
            LEFT JOIN pengguna pengguna_requester ON follow_request.id_requester = pengguna_requester.id_pengguna $all_kondisi ORDER BY notif.created_at DESC");
    }

    public function notif_pesan(){
        $data_notif = DB::select("SELECT * FROM pengaturan WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        foreach ($data_notif as $row) {
            $pilihan_notif_pesan    = $row->notifikasi_pesan;
        }

        if($pilihan_notif_pesan == 'dari semua orang'){
            return $notif_pesan = DB::select("SELECT COUNT(id_chat) AS jml FROM chat WHERE id_penerima = '".Auth::user()->pengguna->id_pengguna."' AND status = 'Belum Dibaca'");
        }
        // return $notif_pesan = DB::select("SELECT COUNT(id_chat) AS jml FROM chat WHERE id_penerima = '".Auth::user()->pengguna->id_pengguna."' AND status = 'Belum Dibaca'");
    }

    public function list_id(){
        $data_notif = DB::select("SELECT * FROM pengaturan WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        foreach ($data_notif as $row) {
            $pilihan_notif_menyukai = $row->notifikasi_menyukai;
            $pilihan_notif_komentar = $row->notifikasi_komentar;
            $pilihan_notif_pesan    = $row->notifikasi_pesan;
        }

        $kondisi = array();

        if($pilihan_notif_menyukai == 'dari orang yang saya ikuti'){
            $kondisi[] = "likes.id_konten IN (SELECT id_konten FROM konten WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND likes.id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND likes.id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna='".Auth::user()->pengguna->id_pengguna."')";
        }else if($pilihan_notif_menyukai == 'dari semua orang'){
            $kondisi[] = "likes.id_konten IN (SELECT id_konten FROM konten WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND likes.id_pengguna != '".Auth::user()->pengguna->id_pengguna."'";
        }

        if($pilihan_notif_komentar == 'dari orang yang saya ikuti'){
            $kondisi[] = "comment.id_konten IN (SELECT id_konten FROM konten WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND comment.id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND comment.id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna='".Auth::user()->pengguna->id_pengguna."') OR comment.isi_komentar LIKE '%".Auth::user()->pengguna->username."%' AND comment.status = 'Belum Dibaca'";
        }else if($pilihan_notif_komentar == 'dari semua orang'){
            $kondisi[] = "comment.id_konten IN (SELECT id_konten FROM konten WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND comment.id_pengguna != '".Auth::user()->pengguna->id_pengguna."' OR comment.isi_komentar LIKE '%".Auth::user()->pengguna->username."%' AND comment.status = 'Belum Dibaca'";
        }

        $kondisi[] = "anggota_grup.id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND konten_group.id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND notif.id_anggota IN (SELECT id_anggota FROM anggota_grup WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."')";

        $kondisi[] = "undangan_grup.status = 'Menunggu' AND undangan_grup.id_pengguna_penerima = '".Auth::user()->pengguna->id_pengguna."'";

        $kondisi[] = "admin_grup.id_admin = '".Auth::user()->pengguna->id_pengguna."'";

        $kondisi[] = "followers.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'";

        $kondisi[] = "follow_request.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'";

        $all_kondisi = ' WHERE '.implode(" OR ", $kondisi);
        return $list_id = DB::select("SELECT notif.id_notif id_notif FROM notif 
            LEFT JOIN likes ON notif.id_likes = likes.id AND notif.jenis_notif = 'Menyukai' AND notif.status = 'Belum Dibaca'
            LEFT JOIN konten konten_likes ON likes.id_konten = konten_likes.id_konten 
            LEFT JOIN pengguna pengguna_likes ON likes.id_pengguna = pengguna_likes.id_pengguna 
            LEFT JOIN comment ON notif.id_comment = comment.id AND notif.jenis_notif = 'Komentar' AND notif.status = 'Belum Dibaca'
            LEFT JOIN konten konten_comment ON comment.id_konten = konten_comment.id_konten 
            LEFT JOIN pengguna pengguna_comment ON comment.id_pengguna = pengguna_comment.id_pengguna
            LEFT JOIN konten konten_group ON notif.id_konten = konten_group.id_konten AND notif.jenis_notif = 'Post Grup' AND notif.status = 'Belum Dibaca'
            LEFT JOIN pengguna pengguna_grup ON konten_group.id_pengguna = pengguna_grup.id_pengguna
            LEFT JOIN grup ON konten_group.id_group = grup.id_group
            LEFT JOIN anggota_grup ON grup.id_group = anggota_grup.id_group
            LEFT JOIN undangan_grup ON notif.id_undangan = undangan_grup.id AND notif.jenis_notif = 'Undangan Grup' AND notif.status = 'Belum Dibaca'
            LEFT JOIN grup grup_undangan ON undangan_grup.id_group = grup_undangan.id_group
            LEFT JOIN pengguna pengundang ON undangan_grup.id_pengguna_pengirim = pengundang.id_pengguna 
             LEFT JOIN admin_grup ON notif.id_undangan = admin_grup.id AND notif.jenis_notif = 'Admin Grup' AND notif.status = 'Belum Dibaca' 
            LEFT JOIN grup grup_adm ON admin_grup.id_group = grup_adm.id_group 
            LEFT JOIN pengguna admin ON admin_grup.id_admin = admin.id_pengguna 
            LEFT JOIN followers ON notif.id_followers = followers.id AND notif.jenis_notif = 'Followers' AND notif.status = 'Belum Dibaca'
            LEFT JOIN pengguna pengguna_followers ON followers.id_followers = pengguna_followers.id_pengguna 
            LEFT JOIN follow_request ON notif.id_followers = follow_request.id AND notif.jenis_notif = 'Followers'
            LEFT JOIN pengguna pengguna_requester ON follow_request.id_requester = pengguna_requester.id_pengguna $all_kondisi ORDER BY notif.created_at DESC");
    }

    public function notif_group(){
        return $notif_group = DB::select("SELECT grup.id_group, COUNT(konten.id_konten) AS jml FROM konten JOIN grup ON konten.id_group = grup.id_group JOIN anggota_grup ON grup.id_group = anggota_grup.id_group JOIN notif ON konten.id_konten = notif.id_konten WHERE anggota_grup.id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND konten.id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND notif.id_anggota IN (SELECT id_anggota FROM anggota_grup WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND notif.status = 'Belum Dibaca' GROUP BY grup.id_group");
    }

    public function beranda(){
        $jml_konten = DB::select("SELECT COUNT(id_pengguna) AS jml_konten FROM konten WHERE is_active = 1 AND id_group = 0 AND id_pengguna = (SELECT id_pengguna FROM pengguna WHERE username = '".Auth::user()->pengguna->username."')");
        $teman = DB::select("SELECT * FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna='".Auth::user()->pengguna->id_pengguna."')");
        $list_all_group = DB::select("SELECT * FROM grup");
        if ($teman == null) {
            $rekomendasi = DB::select("SELECT * FROM pengguna WHERE id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND jenis_akun = 'desa' ORDER BY RAND() LIMIT 2");
            $rekomendasi_teman = DB::select("SELECT * FROM pengguna WHERE id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND jenis_akun = 'pribadi' ORDER BY RAND() LIMIT 2");
        } else {
            $rekomendasi = DB::select("SELECT * FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."')) AND id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND id_pengguna NOT IN (SELECT id_pengguna FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."')) AND jenis_akun = 'desa' ORDER BY RAND() LIMIT 2");
            if($rekomendasi == null){
                $rekomendasi = DB::select("SELECT * FROM pengguna WHERE id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND id_pengguna NOT IN (SELECT id_pengguna FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."')) AND jenis_akun = 'desa' ORDER BY RAND() LIMIT 2");
            }
            $rekomendasi_teman = DB::select("SELECT * FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."')) AND id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND id_pengguna NOT IN (SELECT id_pengguna FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."')) AND jenis_akun = 'pribadi' ORDER BY RAND() LIMIT 2");
            if($rekomendasi_teman == null){
                $rekomendasi_teman = DB::select("SELECT * FROM pengguna WHERE id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND id_pengguna NOT IN (SELECT id_following FROM following WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND jenis_akun = 'pribadi' ORDER BY RAND() LIMIT 2");
            }
        }
        $konten = DB::select("SELECT *, (SELECT IF(COUNT(*) > 0, true, false) FROM likes WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND likes.id_konten = konten.id_konten) AS is_like FROM konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna WHERE konten.is_active = 1 AND konten.id_group = 0 AND (konten.id_pengguna IN (SELECT id_pengguna FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna='".Auth::user()->pengguna->id_pengguna."'))) ORDER BY konten.created_at DESC");
        $komentar = DB::select("SELECT comment.*, comment.id AS id_cmt, p.* FROM konten JOIN comment ON konten.id_konten=comment.id_konten JOIN pengguna p2 ON konten.id_pengguna=p2.id_pengguna JOIN pengguna p ON comment.id_pengguna = p.id_pengguna WHERE konten.is_active = 1 AND konten.id_group = 0 AND konten.id_pengguna IN (SELECT id_pengguna FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna='".Auth::user()->pengguna->id_pengguna."'))");
        // $jml_komentar = DB::select("SELECT COUNT(comment.id) AS jumlah, comment.id_konten FROM konten JOIN comment ON konten.id_konten=comment.id_konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna WHERE konten.id_group = 0 AND konten.id_pengguna IN (SELECT id_pengguna FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna='".Auth::user()->pengguna->id_pengguna."')) GROUP BY comment.id_konten");
        $balas_komentar = DB::select("SELECT comment.*, comment.id AS id_cmt, comment.id AS id_cmt, pengguna.* FROM konten JOIN comment ON konten.id_konten=comment.id_konten JOIN pengguna ON comment.id_pengguna=pengguna.id_pengguna WHERE konten.is_active = 1 AND konten.id_group = 0  AND konten.id_pengguna IN (SELECT id_pengguna FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna='".Auth::user()->pengguna->id_pengguna."'))");
        $konten_desa = DB::select("SELECT *, (SELECT IF(COUNT(*) > 0, true, false) FROM likes WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND likes.id_konten = konten.id_konten) AS is_like FROM konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna WHERE konten.is_active = 1 AND konten.id_group = 0 AND konten.id_pengguna IN (SELECT id_pengguna FROM pengguna WHERE jenis_akun = 'desa') ORDER BY konten.created_at DESC");
        $komentar_desa = DB::select("SELECT comment.*, comment.id AS id_cmt, p.* FROM konten JOIN comment ON konten.id_konten=comment.id_konten JOIN pengguna p2 ON konten.id_pengguna=p2.id_pengguna JOIN pengguna p ON comment.id_pengguna = p.id_pengguna WHERE konten.is_active = 1 AND konten.id_group = 0 AND konten.id_pengguna IN (SELECT id_pengguna FROM pengguna WHERE jenis_akun = 'desa')");
        // $jml_komentar_desa = DB::select("SELECT COUNT(comment.id) AS jumlah, comment.id_konten FROM konten JOIN comment ON konten.id_konten=comment.id_konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna WHERE konten.id_group = 0 AND konten.id_pengguna IN (SELECT id_pengguna FROM pengguna WHERE jenis_akun = 'desa') GROUP BY comment.id_konten");
        $balas_komentar_desa = DB::select("SELECT comment.*, comment.id AS id_cmt, pengguna.* FROM konten JOIN comment ON konten.id_konten=comment.id_konten JOIN pengguna ON comment.id_pengguna=pengguna.id_pengguna WHERE konten.is_active = 1 AND konten.id_group = 0 AND konten.id_pengguna IN (SELECT id_pengguna FROM pengguna WHERE jenis_akun = 'desa')");
        $total_notif = $this->total_notif();
        $list_notif_display = $this->list_notif_display();
        $notif_pesan = $this->notif_pesan();
        $notif_group = $this->notif_group();
        $likes = DB::select("SELECT * FROM likes JOIN pengguna ON likes.id_pengguna = pengguna.id_pengguna WHERE id_konten IN (SELECT id_konten FROM konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna WHERE konten.is_active = 1 AND konten.id_group = 0 AND (konten.id_pengguna = '".Auth::user()->pengguna->id_pengguna."' OR konten.id_pengguna IN (SELECT id_pengguna FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."'))) ORDER BY konten.created_at DESC)");
        $likes_all = DB::select("SELECT * FROM likes JOIN pengguna ON likes.id_pengguna = pengguna.id_pengguna WHERE id_konten IN (SELECT id_konten FROM konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna WHERE konten.is_active = 1 AND konten.id_group = 0 AND (konten.id_pengguna = '".Auth::user()->pengguna->id_pengguna."' OR konten.id_pengguna IN (SELECT id_pengguna FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."'))) ORDER BY konten.created_at DESC)");
        // $likes_me = DB::select("SELECT * FROM likes WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND id_konten IN (SELECT id_konten FROM konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna WHERE konten.id_group = 0 AND (konten.id_pengguna = '".Auth::user()->pengguna->id_pengguna."' OR konten.id_pengguna IN (SELECT id_pengguna FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."'))) ORDER BY konten.created_at DESC)");
        $data_likes_total = DB::select("SELECT COUNT(likes.id) AS jml_likes FROM likes WHERE id_konten IN (SELECT id_konten FROM konten WHERE is_active = 1 AND id_pengguna = '".Auth::user()->pengguna->id_pengguna."')"); 
        $data_likes_week = DB::select("SELECT COUNT(likes.id) AS jml_likes FROM likes WHERE id_konten IN (SELECT id_konten FROM konten WHERE is_active = 1 AND id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND tanggal_like > (now() - INTERVAL 7 day)");
        $data_followers_total = DB::select("SELECT COUNT(followers.id) AS jml FROM followers WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."'"); 
        $data_followers_week = DB::select("SELECT COUNT(followers.id) AS jml FROM followers JOIN notif ON followers.id = notif.id_followers WHERE followers.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'  AND notif.created_at > (now() - INTERVAL 7 day)");
        $likes_desa = DB::select("SELECT * FROM likes JOIN pengguna ON likes.id_pengguna = pengguna.id_pengguna WHERE id_konten IN (SELECT id_konten FROM konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna WHERE konten.is_active = 1 AND konten.id_group = 0 AND konten.id_pengguna IN (SELECT id_pengguna FROM pengguna WHERE jenis_akun = 'desa') ORDER BY konten.created_at DESC)");
        $likes_all_desa = DB::select("SELECT * FROM likes JOIN pengguna ON likes.id_pengguna = pengguna.id_pengguna WHERE id_konten IN (SELECT id_konten FROM konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna WHERE konten.is_active = 1 AND konten.id_group = 0 AND konten.id_pengguna IN (SELECT id_pengguna FROM pengguna WHERE jenis_akun = 'desa') ORDER BY konten.created_at DESC)");
        $video_news = Video::orderBy('created_at', 'desc')->with('user')->limit(3)->get();
        return view('beranda', compact('jml_konten', 'video_news', 'teman', 'rekomendasi', 'konten', 'komentar', 'balas_komentar', 'notif_pesan', 'likes', 'likes_all', 'notif_group', 'total_notif', 'list_notif_display', 'list_all_group', 'rekomendasi_teman', 'data_likes_total', 'data_likes_week', 'data_followers_total', 'data_followers_week', 'konten_desa', 'komentar_desa', 'balas_komentar_desa', 'likes_desa', 'likes_all_desa'));
    }

    public function menyukai_proses($id_konten){
        $tgl = date("Y-m-d H:i:s");
        $id = DB::table('likes')->insertGetId([
            'id_pengguna'       => Auth::user()->pengguna->id_pengguna,
            'tanggal_like'          => $tgl,
            'id_konten'             => $id_konten
        ]);

        DB::table('notif')->insert([
                'jenis_notif'   => 'Menyukai',
                'isi_notif'     => Auth::user()->pengguna->username.' menyukai postingan anda',
                'created_at'    => $tgl,
                'id_likes'      => $id,
                'status'        => 'Belum Dibaca'
            ]);        
    }

    public function batal_menyukai_proses($id){
        $tmp = DB::table('likes')->where('id_konten',$id)->first();
        DB::table('likes')->where('id_konten', $id)->where('id_pengguna', Auth::user()->pengguna->id_pengguna)->delete();
        DB::table('notif')->where('id_likes', $tmp->id)->where('jenis_notif', 'menyukai')->delete();
    }

    public function update_notif(){
        DB::update("UPDATE comment SET status = 'Sudah Dibaca' WHERE id_konten IN (SELECT id_konten FROM konten WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND comment.id_pengguna != '".Auth::user()->pengguna->id_pengguna."' OR comment.isi_komentar LIKE '%".Auth::user()->pengguna->username."%'");
        $list_id = $this->list_id();
        foreach ($list_id as $row) {
            DB::update("UPDATE notif SET status = 'Sudah Dibaca' WHERE id_notif = '".$row->id_notif."'");
        }
    }

    public function update_notif_group(){
        DB::update("UPDATE comment SET status = 'Sudah Dibaca' WHERE id_konten IN (SELECT id_konten FROM konten WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND comment.id_pengguna != '".Auth::user()->pengguna->id_pengguna."' OR comment.isi_komentar LIKE '%".Auth::user()->pengguna->username."%'");
        $list_id = $this->list_id();
        foreach ($list_id as $row) {
            DB::update("UPDATE notif SET status = 'Sudah Dibaca' WHERE id_notif = '".$row->id_notif."'");
        }
    }

    public function cari_pengguna_proses(Request $request){
        $search = $request->search;
        // $data_hapus = DB::table('hapus_akun')->select('id_pengguna')->get();

        // if($search == ''){
        //     $penggunaa = ModelUser::orderby('nama','asc')->select('username', 'nama', 'foto_profil')->limit(5)->get();
        // }else{
            $penggunaa = DB::select("SELECT * FROM pengguna WHERE nama LIKE '%".$search."%' OR username LIKE '%".$search."%' ORDER BY nama ASC LIMIT 5");
        // }
        
        $response = array();
        foreach($penggunaa as $pengguna){
            if($pengguna->foto_profil != null){
                $foto = url('/data_file/'.$pengguna->username.'/foto_profil/'.$pengguna->foto_profil);
            }else{
                $foto = asset('user.jpg');
            }
            $response[] = array(
                            "value"   =>$pengguna->username,
                            "label"   =>$pengguna->nama,
                            "icon"    =>$foto
                            );
        }
        return response()->json($response);
    }

    public function tambah_teman($username){
        $tgl = date("Y-m-d H:i:s");
        $data = ModelUser::where('username',$username)->get();
        foreach ($data as $row){
            $id = $row->id_pengguna;
        }
        $pengaturan = DB::select("SELECT * FROM pengaturan WHERE id_pengguna = '".$id."'");
        foreach ($pengaturan as $data) {
            $privat = $data->akun_privat;
        }
        if($privat == 'iya'){
            $req = DB::table('follow_request')->insertGetId([
                    'id_requester'  => Auth::user()->pengguna->id_pengguna,
                    'id_pengguna'   => $id,
                    'status'        => 'Menunggu'
                ]); 

            // $tgl = date("Y-m-d H:i:s");
            DB::table('notif')->insert([
                    'jenis_notif'   => 'Followers',
                    'isi_notif'     => Auth::user()->pengguna->username.' mengirim permintaan mengikuti',
                    'created_at'    => $tgl,
                    'id_followers'  => $req,
                    'status'        => 'Belum Dibaca'
                ]);
            return redirect()->back()->with('success','Permintaan mengikuti berhasil dikirim!'); 
        }else{
            $data = ModelUser::where('username',$username)->first();
            // $tambah_teman = DB::insert("INSERT into following (id_following, id_pengguna) VALUES ('".$id."', '".Auth::user()->pengguna->id_pengguna."')");
            DB::table('following')->insert([
                'id_following'  => $data->id_pengguna,
                'id_pengguna'   => Auth::user()->pengguna->id_pengguna
            ]);

            // $data = ModelUser::where('username',$username)->first();
            $id_followers = DB::table('followers')->insertGetId([
                    'id_followers'  => Auth::user()->pengguna->id_pengguna,
                    'id_pengguna'   => $data->id_pengguna
                ]);

            // $tgl = date("Y-m-d H:i:s");
            DB::table('notif')->insert([
                    'jenis_notif'   => 'Followers',
                    'isi_notif'     => Auth::user()->pengguna->username.' mulai mengikuti Anda',
                    'created_at'    => $tgl,
                    'id_followers'  => $id_followers,
                    'status'        => 'Belum Dibaca'
                ]); 
            return redirect()->back()->with('success','Berhasil menambahkan teman!');
        }
    }

    public function tambah_teman2($username){
        // $username = $this->uri->segment(3);
        $data = ModelUser::where('username',$username)->get();
        foreach ($data as $row){
            $id = $row->id_pengguna;
        }
        $pengaturan = DB::select("SELECT * FROM pengaturan WHERE id_pengguna = '".$id."'");
        foreach ($pengaturan as $data) {
            $privat = $data->akun_privat;
        }
        if($privat == 'iya'){
            $req = DB::table('follow_request')->insertGetId([
                    'id_requester'  => Auth::user()->pengguna->id_pengguna,
                    'id_pengguna'   => $id,
                    'status'        => 'Menunggu'
                ]); 

            $tgl = date("Y-m-d H:i:s");
            DB::table('notif')->insert([
                    'jenis_notif'   => 'Followers',
                    'isi_notif'     => Auth::user()->pengguna->username.' mengirim permintaan mengikuti',
                    'created_at'    => $tgl,
                    'id_followers'  => $req,
                    'status'        => 'Belum Dibaca'
                ]); 
        }else{
            $tambah_teman = DB::insert("INSERT into following (id_following, id_pengguna) VALUES ('".$id."', '".Auth::user()->pengguna->id_pengguna."')");

            $data = ModelUser::where('username',$username)->first();
            // $id_followers = DB::insertGetId("INSERT into followers (id_followers, id_pengguna) VALUES ('".Auth::user()->pengguna->id_pengguna."', $data->id_pengguna)");
            $id_followers = DB::table('followers')->insertGetId([
                    'id_followers'  => Auth::user()->pengguna->id_pengguna,
                    'id_pengguna'   => $data->id_pengguna
                ]);

            $tgl = date("Y-m-d H:i:s");
            DB::table('notif')->insert([
                    'jenis_notif'   => 'Followers',
                    'isi_notif'     => Auth::user()->pengguna->username.' mulai mengikuti Anda',
                    'created_at'    => $tgl,
                    'id_followers'  => $id_followers,
                    'status'        => 'Belum Dibaca'
                ]); 
        }
        return redirect()->back();
    }

    public function terima_request($id){
        $tgl = date("Y-m-d H:i:s");
        DB::table('follow_request')->where('id', $id)->update([
                'status'    => 'Diterima'
            ]);
        // $data = ModelUser::where('username',$username)->first();
        $data = DB::select("SELECT * FROM follow_request WHERE id = '".$id."'");
        foreach($data as $d){
            $id_pengguna = $d->id_requester;
        }
        $tambah_teman = DB::insert("INSERT into following (id_following, id_pengguna) VALUES ('".Auth::user()->pengguna->id_pengguna."', '".$id_pengguna."')");

        $id_followers = DB::insert("INSERT into followers (id_followers, id_pengguna) VALUES ('".$id_pengguna."', '".Auth::user()->pengguna->id_pengguna."')");

        return redirect()->back();
    }

    public function tolak_request($id){
        $tgl = date("Y-m-d H:i:s");
        $kueri = DB::table('follow_request')->where('id', $id)->update([
                    'status'        => 'Ditolak'
            ]);
        DB::table('follow_request')->where('id', $id)
                                ->delete();
        DB::table('notif')->where('id_followers', $id)
                                ->delete();
        return redirect()->back();
    }

    public function batal_request($id){
        DB::table('follow_request')->where('id', $id)
                                ->delete();
        DB::table('notif')->where('id_followers', $id)
                                ->delete();
        return redirect()->back();
    }

    public function hapus_following($username){
        $data = ModelUser::where('username',$username)->first();
        $data_id = DB::select("SELECT * FROM followers WHERE id_pengguna = '".$data->id_pengguna."' AND id_followers = '".Auth::user()->pengguna->id_pengguna."'");
        foreach ($data_id as $dt) {
            $id = $dt->id;
            DB::table('notif')->where('id_followers', $id)
                                ->delete();
        }
        DB::table('following')->where('id_following', $data->id_pengguna)
                                ->where('id_pengguna', Auth::user()->pengguna->id_pengguna)
                                ->delete();
        // $data = ModelUser::where('username',$username)->first();
        DB::table('followers')->where('id_followers', Auth::user()->pengguna->id_pengguna)
                                ->where('id_pengguna', $data->id_pengguna)
                                ->delete();
        return redirect()->back();
    }

    public function hapus_followers($username){
        $data = ModelUser::where('username',$username)->first();
        $data_id = DB::select("SELECT * FROM followers WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND id_followers = '".$data->id_pengguna."'");
        foreach ($data_id as $dt) {
            $id = $dt->id;
            DB::table('notif')->where('id_followers', $id)
                                ->delete();
        }
        DB::table('followers')->where('id_followers', $data->id_pengguna)
                                ->where('id_pengguna', Auth::user()->pengguna->id_pengguna)
                                ->delete();
        // $data = ModelUser::where('username',$username)->first();
        DB::table('following')->where('id_following', Auth::user()->pengguna->id_pengguna)
                                ->where('id_pengguna', $data->id_pengguna)
                                ->delete();
        return redirect()->back();
    }

    public function post(Request $request){
        $this->validate($request, [
            'file' => 'mimes:jpeg,png,jpg,mp4'
        ]);
        
        $slug = str_slug((Auth::user()->pengguna->id_pengguna.' '.str_random(10)), '-');
        if($request->hasFile('file_foto')) {
            $arr_foto = array();
            foreach ($request->file('file_foto') as  $image) {
                // $file = $request->file('file_foto');
                $nama_file = $image->getClientOriginalName();
                $nama_folder = 'data_file/'.Auth::user()->pengguna->username.'/foto_konten/'.date("d-m-Y");
                // $tujuan_upload_profil = $nama_folder.'/foto_profil';
                // $file_profil->move($tujuan_upload_profil,$nama_file_profil);

                $tujuan_upload = $nama_folder.'/'.$slug;
                $image->move($tujuan_upload,$nama_file);

                $arr_foto[] = $nama_file;
            }
            $data_foto = implode(", ", $arr_foto);
            File_Gambar::create([
                // 'foto_video_konten' =>  $nama_file,
                'foto_video_konten' =>  $data_foto,
                'caption'           =>  $request->caption,
                'slug'              =>  $slug,
                'tempat'            =>  $request->tempat,
                'longitude_tempat'  =>  $request->longitude_tempat,
                'latitude_tempat'   =>  $request->latitude_tempat,
                'id_pengguna'       =>  Auth::user()->pengguna->id_pengguna,
                'id_group'          =>  '0'
            ]);
        }else{
            File_Gambar::create([
                'foto_video_konten' =>  '',
                'caption'           =>  $request->caption,
                'tagging'           =>  '',
                'tempat'            =>  $request->tempat,
                'longitude_tempat'  =>  $request->longitude_tempat,
                'latitude_tempat'   =>  $request->latitude_tempat,
                'id_pengguna'       =>  Auth::user()->pengguna->id_pengguna,
                'id_group'          =>  '0'
            ]);
        }
    	return redirect('/sosial-media/beranda')->with('success','Konten Berhasil Diposting!');
    }

    public function post_komen(Request $request){
        $tgl = date("Y-m-d H:i:s");
        $data = ModelUser::where('username',Auth::user()->pengguna->username)->first();
        if(isset($request->id_balas_komen)){
            $uname = str_replace('@'.$request->username, '<a href="/sosial-media/profil/"'.$request->username.'" style="color:blue;">@'.$request->username.'</a></h5>', $request->isi_komentar);
            $id_komentar = DB::table('comment')->insertGetId([
                    'id_pengguna'           => Auth::user()->pengguna->id_pengguna,
                    'id_balas_komen'        => $request->id_balas_komen,
                    'isi_komentar'          => $uname,
                    'tanggal_komen'         => $tgl,
                    'status'                => 'Belum Dibaca',
                    'id_konten'             => $request->id_konten
                ]);
        }else{
            $id_komentar = DB::table('comment')->insertGetId([
                'id_pengguna'           => Auth::user()->pengguna->id_pengguna,
                'id_balas_komen'        => '0',
                'isi_komentar'          => $request->isi_komentar,
                'tanggal_komen'         => $tgl,
                'status'                => 'Belum Dibaca',
                'id_konten'             => $request->id_konten
            ]);
        }

        DB::table('notif')->insert([
                'jenis_notif'   => 'Komentar',
                'isi_notif'     => Auth::user()->pengguna->username.' mengomentari postingan Anda',
                'created_at'    => $tgl,
                'id_comment'    => $id_komentar,
                'status'        => 'Belum Dibaca'
            ]); 
        
        $data = DB::table('comment')
                        ->join('pengguna', 'comment.id_pengguna', '=', 'pengguna.id_pengguna')->where('comment.id', $id_komentar)
                        ->select('comment.*', 'comment.id AS id_cmt', 'pengguna.*')
                        ->get();
        return response()->json($data);
        // return redirect('/sosial-media/beranda')->with('success', 'Berhasil Mengirimkan Komentar!');
    }

    public function post_komen_dari_profil(Request $request){
        $tgl = date("Y-m-d H:i:s");
        $data = ModelUser::where('username',Auth::user()->pengguna->username)->first();
        if(isset($request->id_balas_komen)){
            $uname = str_replace('@'.$request->username, '<a href="/sosial-media/profil/"'.$request->username.'" style="color:blue;">@'.$request->username.'</a></h5>', $request->isi_komentar);
            $id_komentar = DB::table('comment')->insertGetId([
                    'id_pengguna'           => Auth::user()->pengguna->id_pengguna,
                    'id_balas_komen'        => $request->id_balas_komen,
                    'isi_komentar'          => $uname,
                    'tanggal_komen'         => $tgl,
                    'status'                => 'Belum Dibaca',
                    'id_konten'             => $request->id_konten
                ]);
        }else{
            $id_komentar = DB::table('comment')->insertGetId([
                'id_pengguna'           => Auth::user()->pengguna->id_pengguna,
                'id_balas_komen'        => '0',
                'isi_komentar'          => $request->isi_komentar,
                'tanggal_komen'         => $tgl,
                'status'                => 'Belum Dibaca',
                'id_konten'             => $request->id_konten
            ]);
        }

         DB::table('notif')->insert([
                'jenis_notif'   => 'Komentar',
                'isi_notif'     => Auth::user()->pengguna->username.' mengomentari postingan Anda',
                'created_at'    => $tgl,
                'id_comment'    => $id_komentar,
                'status'        => 'Belum Dibaca'
            ]); 
        $data = DB::table('comment')
                        ->join('pengguna', 'comment.id_pengguna', '=', 'pengguna.id_pengguna')->where('comment.id', $id_komentar)
                        ->select('comment.*', 'comment.id AS id_cmt', 'pengguna.*')
                        ->get();
        return response()->json($data);
        // return redirect()->back();
    }

    public function halaman_group(){
        $total_notif = $this->total_notif();
        $list_notif_display = $this->list_notif_display();
        $notif_pesan = $this->notif_pesan();
        $notif_group = $this->notif_group();
        // $regency = DB::select("SELECT DISTINCT regencies.id, regencies.name FROM regencies JOIN provinces ON regencies.province_id = provinces.id WHERE provinces.id = 32");
        $province = DB::select("SELECT provinces.id, provinces.name FROM provinces");
        $cek = DB::select("SELECT id_group FROM anggota_grup WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        if($cek){
            $list_all_group = DB::select("SELECT DISTINCT grup.*, villages.id AS id_desa, villages.name AS nm_desa,
                                districts.id AS id_kec, districts.name AS nm_kec, regencies.id AS id_kab, 
                                regencies.name AS nm_kab, p2.id AS id_provK, p2.name AS nm_provK, provinces.id AS id_prov, provinces.name AS nm_prov,
                                d.id AS id_kec_2, d.name AS nm_kec_2, r.id AS id_kab_2, 
                                r.name AS nm_kab_2, p.id AS id_prov_2, p.name AS nm_prov_2
                                FROM grup 
                                LEFT JOIN villages ON grup.id_lokasi = villages.id
                                LEFT JOIN districts d ON villages.district_id = d.id 
                                LEFT JOIN districts ON grup.id_lokasi = districts.id
                                LEFT JOIN regencies r ON d.regency_id = r.id
                                LEFT JOIN regencies ON grup.id_lokasi = regencies.id
                                LEFT JOIN provinces p2 ON regencies.province_id = p2.id
                                LEFT JOIN provinces p ON r.province_id = p.id
                                LEFT JOIN provinces ON grup.id_lokasi = provinces.id
                                WHERE id_group NOT IN 
                                    (SELECT id_group FROM anggota_grup WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."')
                                ");
            $data_anggota_all_group = DB::select("SELECT id_group, COUNT(id_anggota) AS jml_anggota FROM anggota_grup WHERE anggota_grup.id_pengguna != '".Auth::user()->pengguna->id_pengguna."' GROUP BY id_group");
        }else{
            $list_all_group = DB::select("SELECT DISTINCT grup.*, villages.id AS id_desa, villages.name AS nm_desa,
                                districts.id AS id_kec, districts.name AS nm_kec, regencies.id AS id_kab, 
                                regencies.name AS nm_kab, p2.id AS id_provK, p2.name AS nm_provK, provinces.id AS id_prov, provinces.name AS nm_prov,
                                d.id AS id_kec_2, d.name AS nm_kec_2, r.id AS id_kab_2, 
                                r.name AS nm_kab_2, p.id AS id_prov_2, p.name AS nm_prov_2
                                FROM grup 
                                LEFT JOIN villages ON grup.id_lokasi = villages.id
                                LEFT JOIN districts d ON villages.district_id = d.id 
                                LEFT JOIN districts ON grup.id_lokasi = districts.id
                                LEFT JOIN regencies r ON d.regency_id = r.id
                                LEFT JOIN regencies ON grup.id_lokasi = regencies.id
                                LEFT JOIN provinces p2 ON regencies.province_id = p2.id
                                LEFT JOIN provinces p ON r.province_id = p.id
                                LEFT JOIN provinces ON grup.id_lokasi = provinces.id");
            $data_anggota_all_group = DB::select("SELECT id_group, COUNT(id_anggota) AS jml_anggota FROM anggota_grup GROUP BY id_group");
        }
        $list_group = DB::select("SELECT * FROM grup JOIN anggota_grup ON grup.id_group = anggota_grup.id_group WHERE anggota_grup.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        $data_anggota = null;
        if($list_group){
            $arr = array();
            foreach($list_group as $row){
                $arr[] = $row->id_group;
                // $data_anggota = DB::select("SELECT id_group, COUNT(id_anggota) AS jml_anggota FROM anggota_grup WHERE anggota_grup.id_group IN ('".$id_group."') GROUP BY id_group");
            }
            $id_group = implode(",", $arr);
            $data_anggota = DB::select("SELECT id_group, COUNT(id_anggota) AS jml_anggota FROM anggota_grup WHERE anggota_grup.id_group IN ($id_group) GROUP BY id_group");
        }
        $jml_notif_group = DB::select("SELECT COUNT(konten.id_konten) AS jml FROM pengguna JOIN konten ON pengguna.id_pengguna=konten.id_pengguna JOIN grup ON konten.id_group = grup.id_group JOIN anggota_grup ON grup.id_group = anggota_grup.id_group WHERE anggota_grup.id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND konten.id_pengguna != '".Auth::user()->pengguna->id_pengguna."'");
        $isi_notif_group = DB::select("SELECT nama_group, konten.*, pengguna.username AS username_post, pengguna.foto_profil AS foto_profil_post FROM pengguna JOIN konten ON pengguna.id_pengguna=konten.id_pengguna JOIN grup ON konten.id_group = grup.id_group JOIN anggota_grup ON grup.id_group = anggota_grup.id_group WHERE anggota_grup.id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND konten.id_pengguna != '".Auth::user()->pengguna->id_pengguna."'");
        return view('halaman_group', compact('list_notif_display', 'total_notif', 'notif_pesan', 'list_all_group', 'data_anggota_all_group', 'list_group', 'data_anggota', 'notif_group', 'isi_notif_group', 'jml_notif_group', 'province'));
    }

    public function get_regency($id_province){
        $data = DB::select("SELECT DISTINCT regencies.id, regencies.name FROM regencies WHERE province_id = '".$id_province."'");
        return response()->json($data);
    }

    public function get_district($id_regency){
        $data = DB::select("SELECT DISTINCT districts.id, districts.name FROM districts WHERE regency_id = '".$id_regency."'");
        return response()->json($data);
    }

    public function get_village($id_district){
        $data = DB::select("SELECT DISTINCT villages.id, villages.name FROM villages WHERE district_id = '".$id_district."'");
        return response()->json($data);
    }

    public function buat_group_proses(Request $request){
        if($request->nama_des){
            $datalokasi = explode("+++", $request->nama_des);
            $lokasi = $datalokasi[1];
        }else if($request->nama_kab){
            $datalokasi = explode("+++", $request->nama_kab);
            $lokasi = $datalokasi[1];
        }else{
            $datalokasi = explode("+++", $request->nama_prov);
            $lokasi = $datalokasi[1];
        }

        $file_sampul = $request->file('foto_sampul');
        $nama_file_sampul = $file_sampul->getClientOriginalName();
        $nama_folder = 'data_file/group/'.$request->nama_group;
        $tujuan_upload_sampul = $nama_folder.'/foto_sampul';
        $file_sampul->move($tujuan_upload_sampul,$nama_file_sampul);
        
        $kueri = DB::table('grup')->insert([
                    'foto_profil_group'   => '',
                    'foto_sampul_group'   => $nama_file_sampul,
                    'nama_group'          => $request->nama_group,
                    'deskripsi_group'     => $request->deskripsi_group,
                    'id_lokasi'           => $lokasi,
                    'admin'               => Auth::user()->pengguna->id_pengguna
                ]);
        $list_group = DB::select("SELECT id_group FROM grup ORDER BY id_group DESC LIMIT 1");
        foreach ($list_group as $row) {
            $id = $row->id_group;
        }
        $kueri2 = DB::table('anggota_grup')->insert([
                    'id_pengguna'    => Auth::user()->pengguna->id_pengguna,
                    'id_group'       => $id
            ]);

        $kueri2 = DB::table('admin_grup')->insert([
                    'id_admin'  => Auth::user()->pengguna->id_pengguna,
                    'id_group'  => $id
            ]);
        return redirect()->back()->with('success', 'Group Berhasil Dibuat!');
    }

    public function update_deskripsi(Request $request){
        DB::table('grup')
                ->where('id_group', $request->id_group)
                ->update(['deskripsi_group' => $request->deskripsi_group]);
        $data_updated = DB::table('grup')
                                ->where('id_group', $request->id_group)->select()->get();
        return response()->json($data_updated);
    }

    public function update_nama_group(Request $request){
        $data_before = DB::table('grup')
                    ->where('id_group', $request->id_group)->select()->first();
        DB::table('grup')
                    ->where('id_group', $request->id_group)
                    ->update(['nama_group' => $request->nama_group]);
        File::move('data_file/group/'.$data_before->nama_group, 'data_file/group/'.$request->nama_group);
        $data_updated = DB::table('grup')
                    ->where('id_group', $request->id_group)->select()->get();
        return response()->json($data_updated);
    }

    public function undangan_grup_proses(Request $request){
        $tgl = date("Y-m-d H:i:s");
        foreach ($request->pilih_teman as $data) {
            $kueri2 = DB::table('undangan_grup')->insertGetId([
                    'tanggal_undangan'      => $tgl,
                    'id_pengguna_pengirim'  => Auth::user()->pengguna->id_pengguna,
                    'id_pengguna_penerima'  => $data,
                    'id_group'              => $request->id_group,
                    'status'                => 'Menunggu',
                    'tanggal_aksi'          => $tgl,
            ]);

            DB::table('notif')->insert([
                'jenis_notif'   => 'Undangan Grup',
                'isi_notif'     => Auth::user()->pengguna->username.' mengundang Anda ke dalam grup',
                'created_at'    => $tgl,
                'id_undangan'   => $kueri2,
                'status'        => 'Belum Dibaca'
            ]); 
        }

        return redirect()->back()->with('success', 'Undangan Group Berhasil di Kirim!');
    }

    public function share_post(Request $request){
        $id_konten = $request->id_konten;
        $tgl = date("Y-m-d H:i:s");
        // $row = DB::select("SELECT * FROM konten JOIN pengguna ON konten.id_pengguna = pengguna.id_pengguna WHERE konten.id_konten = '".$id_konten."'")->first();
        // $row = File_Gambar::where('id_konten', $id_konten)->first();
        $row = DB::select("SELECT * FROM konten WHERE id_konten = '".$id_konten."'");
        foreach ($row as $rw){
            $slug = $rw->slug;
        }
        if($rw->id_group != 0){
            $isi_chat = '<a href="https://desaku-desafeed.masuk.id/sosial-media/group/p/'.$slug.'"> https://desaku-desafeed.masuk.id/sosial-media/group/p/'.$slug.' </a>';
        }else{
            $isi_chat = '<a href="https://desaku-desafeed.masuk.id/sosial-media/p/'.$slug.'"> https://desaku-desafeed.masuk.id/sosial-media/p/'.$slug.' </a>';
        }
        foreach ($request->pilih_teman as $data) {
            $data_chat = DB::select("SELECT * FROM chat JOIN pengguna p ON chat.id_penerima = p.id_pengguna JOIN pengguna p2 ON chat.id_pengirim = p2.id_pengguna WHERE chat.id_pengirim = '".$data."' OR chat.id_penerima = '".$data."' ORDER BY tanggal_chat ASC");
            foreach($data_chat as $ch){
                $id_room_chat = $ch->id_room_chat;
            }
            if($data_chat){
                $data_chat = DB::table('chat')->insert([
                        'id_room_chat'          => $id_room_chat,
                        'tanggal_chat'          => $tgl,
                        'isi_chat'              => $isi_chat,
                        'id_pengirim'           => Auth::user()->pengguna->id_pengguna,
                        'id_penerima'           => $data,
                        'status'                => 'Belum Dibaca'
                    ]);
            }else{
                $kueri = DB::select("SELECT MAX(id_room_chat) AS id_room_chat FROM chat");
                foreach($kueri as $row) {
                    $id =  $row->id_room_chat;
                }
                if($id == null){
                    $i = 0;
                }else{
                    $i = $id;
                }
                $id_room_chat = $i+1;
                $data_chat = DB::table('chat')->insert([
                        'id_room_chat'          => $id_room_chat,
                        'tanggal_chat'          => $tgl,
                        'isi_chat'              => $isi_chat,
                        'id_pengirim'           => Auth::user()->pengguna->id_pengguna,
                        'id_penerima'           => $data,
                        'status'                => 'Belum Dibaca'
                    ]);
            }
        }
        return redirect()->back();
    }

    public function halaman_group_detail($id_group){
        $province = DB::select("SELECT provinces.id, provinces.name FROM provinces");
        DB::update("UPDATE comment SET status = 'Sudah Dibaca' WHERE id_konten IN (SELECT id_konten FROM konten WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND comment.id_pengguna != '".Auth::user()->pengguna->id_pengguna."' OR comment.isi_komentar LIKE '%".Auth::user()->pengguna->username."%'");
        $list_id = DB::select("SELECT notif.id_notif, grup.id_group FROM konten JOIN grup ON konten.id_group = grup.id_group JOIN anggota_grup ON grup.id_group = anggota_grup.id_group JOIN notif ON konten.id_konten = notif.id_konten WHERE grup.id_group = '".$id_group."' AND notif.status = 'Belum Dibaca'");
        foreach ($list_id as $row) {
            DB::update("UPDATE notif SET status = 'Sudah Dibaca' WHERE id_notif = '".$row->id_notif."' AND id_anggota = (SELECT id_anggota FROM anggota_grup WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."')");
        }
        $teman = DB::select("SELECT * FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna=(SELECT id_pengguna FROM pengguna WHERE username = '".Auth::user()->pengguna->username."'))");
        // $list_chat = DB::select("SELECT c.*, p.username AS username_pengirim, p.foto_profil AS foto_pengirim, p2.username AS username_penerima, p2.foto_profil AS foto_penerima FROM chat c JOIN pengguna p ON c.id_pengirim=p.id_pengguna JOIN pengguna p2 ON c.id_penerima=p2.id_pengguna WHERE id_chat IN ( SELECT MAX(id_chat) FROM chat WHERE id_pengirim = '".Auth::user()->pengguna->id_pengguna."' OR id_penerima = '".Auth::user()->pengguna->id_pengguna."' GROUP BY id_room_chat ) ORDER BY id_chat DESC");
        // $jumlah = DB::select("SELECT id_room_chat,  COUNT(id_chat) AS jml FROM chat WHERE id_penerima = '".Auth::user()->pengguna->id_pengguna."' AND status = 'Belum Dibaca' GROUP BY id_room_chat");
        $total_notif = $this->total_notif();
        $list_notif_display = $this->list_notif_display();
        $notif_pesan = $this->notif_pesan();
        $notif_group = $this->notif_group();

        $list_group = DB::select("SELECT *, p2.nama AS nama_admin, p.nama as nama_anggota FROM pengguna p2 JOIN grup g ON p2.id_pengguna = g.admin JOIN anggota_grup gp ON g.id_group = gp.id_group JOIN pengguna p ON gp.id_pengguna = p.id_pengguna WHERE gp.id_group = '".$id_group."'");
        $list_group_user = DB::select("SELECT * FROM grup JOIN anggota_grup ON grup.id_group = anggota_grup.id_group WHERE anggota_grup.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        foreach($list_group as $row){
            $id_group = $row->id_group;
        }
        $data_anggota = DB::select("SELECT id_group, COUNT(id_anggota) AS jml_anggota FROM anggota_grup WHERE anggota_grup.id_group IN ('".$id_group."') GROUP BY id_group");
        $jml_anggota = null;
        if($list_group_user){
            $arr = array();
            foreach($list_group_user as $row){
                $arr[] = $row->id_group;
            }
            $id_group_user = implode(",", $arr);
            // dd($id_group_user);
            $jml_anggota = DB::select("SELECT id_group, COUNT(id_anggota) AS jml_anggota FROM anggota_grup WHERE anggota_grup.id_group IN ($id_group_user) GROUP BY id_group");
        }
        $kueri = DB::select("SELECT * FROM grup WHERE id_group = '".$id_group."'");
        $list_admin = DB::select("SELECT * FROM grup JOIN admin_grup ON admin_grup.id_group = grup.id_group JOIN pengguna ON admin_grup.id_admin = pengguna.id_pengguna WHERE admin_grup.id_group = '".$id_group."'");
        $konten = DB::select("SELECT *, (SELECT IF(COUNT(*) > 0, true, false) FROM likes WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND likes.id_konten = konten.id_konten) AS is_like FROM konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna WHERE konten.is_active = 1 AND konten.id_group = '".$id_group."' ORDER BY konten.created_at DESC");
        $komentar = DB::select("SELECT comment.*, comment.id AS id_cmt, p.* FROM konten JOIN comment ON konten.id_konten=comment.id_konten JOIN pengguna p2 ON konten.id_pengguna=p2.id_pengguna JOIN pengguna p ON comment.id_pengguna = p.id_pengguna WHERE konten.is_active = 1 AND konten.id_group = '".$id_group."'");
        $balas_komentar = DB::select("SELECT comment.*, comment.id AS id_cmt, pengguna.* FROM konten JOIN comment ON konten.id_konten=comment.id_konten JOIN pengguna ON comment.id_pengguna=pengguna.id_pengguna WHERE konten.is_active = 1 AND konten.id_group = 0 AND konten.id_pengguna = '".Auth::user()->pengguna->id_pengguna."' OR konten.id_pengguna IN (SELECT id_pengguna FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna='".Auth::user()->pengguna->id_pengguna."'))");
        $likes = DB::select("SELECT * FROM likes JOIN pengguna ON likes.id_pengguna = pengguna.id_pengguna WHERE id_konten IN (SELECT id_konten FROM konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna WHERE konten.is_active = 1 AND konten.id_group = '".$id_group."' ORDER BY konten.created_at DESC)");
        $likes_all = DB::select("SELECT * FROM likes JOIN pengguna ON likes.id_pengguna = pengguna.id_pengguna WHERE id_konten IN (SELECT id_konten FROM konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna WHERE konten.is_active = 1 AND konten.id_group = '".$id_group."' ORDER BY konten.created_at DESC)");
        // $regency = DB::select("SELECT regencies.id, regencies.name FROM regencies JOIN provinces ON regencies.province_id = provinces.id WHERE provinces.id = 32");
        $data_rp = DB::select("SELECT reports.id AS id_reports, reports.kategori_report AS kategori, 
                            reports.created_at AS  tgl_report, reports.id_konten_reported AS id_konten, reports.id_comment_reported AS id_comment, reports.alasan_report alasan, reported_konten.username AS username_reported_konten, reported_comment.username AS username_reported_comment, reporter.username AS reporter, konten.foto_video_konten AS foto_video_konten, konten.caption AS caption, konten.created_at AS tgl, konten.slug AS slug, comment.isi_komentar AS komentar FROM reports 
                            LEFT JOIN pengguna reporter ON reports.account_reporter=reporter.id_pengguna
                            LEFT JOIN konten ON reports.id_konten_reported=konten.id_konten
                            LEFT JOIN pengguna reported_konten ON konten.id_pengguna=reported_konten.id_pengguna
                            LEFT JOIN comment ON reports.id_comment_reported=comment.id
                            LEFT JOIN konten k ON comment.id_konten = k.id_konten
                            LEFT JOIN pengguna reported_comment ON comment.id_pengguna=reported_comment.id_pengguna
                            WHERE reports.is_active = 1 AND (konten.id_group = '".$id_group."' OR k.id_group = '".$id_group."')");
        return view('halaman_group_detail', compact('teman', 'list_notif_display', 'total_notif', 'notif_pesan', 'list_group', 'data_anggota', 'kueri', 'konten', 'komentar', 'list_group_user', 'jml_anggota', 'likes', 'likes_all', 'notif_group', 'balas_komentar', 'list_admin', 'province', 'data_rp'));
    }

    function get_group_report_list(Request $request){
        $draw = $request->post('draw', 1);
        $param = $request->post('param', []);
        $id_group = $param['id_group'];
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
                        ->where(function($query) use($id_group) {
                                $query->where('konten.id_group', $id_group)
                                ->orWhere('konten_cmt.id_group', $id_group);
                            });
            $data_total = DB::table('reports')
                        ->leftjoin('konten', 'reports.id_konten_reported', '=', 'konten.id_konten')
                        ->leftjoin('comment', 'reports.id_comment_reported', '=', 'comment.id')
                        ->leftjoin('konten AS konten_cmt', 'comment.id_konten', '=', 'konten_cmt.id_konten')
                        ->where('reports.is_active', '<>', '1')
                        ->where(function($query) use($id_group) {
                                $query->where('konten.id_group', $id_group)
                                ->orWhere('konten_cmt.id_group', $id_group);
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
                        ->where(function($query) use($id_group) {
                                $query->where('konten.id_group', $id_group)
                                ->orWhere('konten_cmt.id_group', $id_group);
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
                        ->where(function($query) use($id_group) {
                                $query->where('konten.id_group', $id_group)
                                ->orWhere('konten_cmt.id_group', $id_group);
                            });
            $data_total = DB::table('reports')
                        ->leftjoin('konten', 'reports.id_konten_reported', '=', 'konten.id_konten')
                        ->leftjoin('comment', 'reports.id_comment_reported', '=', 'comment.id')
                        ->leftjoin('konten AS konten_cmt', 'comment.id_konten', '=', 'konten_cmt.id_konten')
                        ->where('reports.is_active', '1')
                        ->where(function($query) use($id_group) {
                                $query->where('konten.id_group', $id_group)
                                ->orWhere('konten_cmt.id_group', $id_group);
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
                        ->where(function($query) use($id_group) {
                                $query->where('konten.id_group', $id_group)
                                ->orWhere('konten_cmt.id_group', $id_group);
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
            );

        return response()->json($json);
    }

    public function data_report_group($id_group){
        $province = DB::select("SELECT provinces.id, provinces.name FROM provinces");
        DB::update("UPDATE comment SET status = 'Sudah Dibaca' WHERE id_konten IN (SELECT id_konten FROM konten WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND comment.id_pengguna != '".Auth::user()->pengguna->id_pengguna."' OR comment.isi_komentar LIKE '%".Auth::user()->pengguna->username."%'");
        $list_id = DB::select("SELECT notif.id_notif, grup.id_group FROM konten JOIN grup ON konten.id_group = grup.id_group JOIN anggota_grup ON grup.id_group = anggota_grup.id_group JOIN notif ON konten.id_konten = notif.id_konten WHERE grup.id_group = '".$id_group."' AND notif.status = 'Belum Dibaca'");
        foreach ($list_id as $row) {
             DB::update("UPDATE notif SET status = 'Sudah Dibaca' WHERE id_notif = '".$row->id_notif."' AND id_anggota = (SELECT id_anggota FROM anggota_grup WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."')");
        }
        $teman = DB::select("SELECT * FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna=(SELECT id_pengguna FROM pengguna WHERE username = '".Auth::user()->pengguna->username."'))");
        $total_notif = $this->total_notif();
        $list_notif_display = $this->list_notif_display();
        $notif_pesan = $this->notif_pesan();
        $notif_group = $this->notif_group();

        $list_group = DB::select("SELECT *, p2.nama AS nama_admin, p.nama as nama_anggota FROM pengguna p2 JOIN grup g ON p2.id_pengguna = g.admin JOIN anggota_grup gp ON g.id_group = gp.id_group JOIN pengguna p ON gp.id_pengguna = p.id_pengguna WHERE gp.id_group = '".$id_group."'");
        $list_group_user = DB::select("SELECT * FROM grup JOIN anggota_grup ON grup.id_group = anggota_grup.id_group WHERE anggota_grup.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        foreach($list_group as $row){
            $id_group = $row->id_group;
        }
        $data_anggota = DB::select("SELECT id_group, COUNT(id_anggota) AS jml_anggota FROM anggota_grup WHERE anggota_grup.id_group IN ('".$id_group."') GROUP BY id_group");
        if($list_group_user){
            $arr = array();
            foreach($list_group_user as $row){
                $arr[] = $row->id_group;
            }
            $id_group_user = implode(",", $arr);
            // dd($id_group_user);
            $jml_anggota = DB::select("SELECT id_group, COUNT(id_anggota) AS jml_anggota FROM anggota_grup WHERE anggota_grup.id_group IN ($id_group_user) GROUP BY id_group");
        }
        $kueri = DB::select("SELECT * FROM grup WHERE id_group = '".$id_group."'");
        $regency = DB::select("SELECT regencies.id, regencies.name FROM regencies JOIN provinces ON regencies.province_id = provinces.id WHERE provinces.id = 32");
        $list_admin = DB::select("SELECT * FROM grup JOIN admin_grup ON admin_grup.id_group = grup.id_group JOIN pengguna ON admin_grup.id_admin = pengguna.id_pengguna WHERE admin_grup.id_group = '".$id_group."'");
        return view('halaman_group_report', compact('teman', 'list_notif_display', 'total_notif', 'notif_pesan', 'list_group', 'data_anggota', 'kueri', 'list_group_user', 'jml_anggota', 'notif_group', 'province', 'list_admin'));
    }

    public function post_konten_grup(Request $request){
        $this->validate($request, [
            'file' => 'mimes:jpeg,png,jpg,mp4'
        ]);
        
        $slug = str_slug((Auth::user()->pengguna->id_pengguna.' '.$request->id_group.' '.str_random(10)), '-');
        if($request->hasFile('file_foto')) {
            $arr_foto = array();
            foreach ($request->file('file_foto') as  $image) {
                // $file = $request->file('file_foto');
                $nama_file = $image->getClientOriginalName();

                // $tujuan_upload = 'data_file';
                $nama_folder = 'data_file/group/'.$request->nama_group.'/foto_konten/';
                $tujuan_upload = $nama_folder.date("d-m-Y").'/'.$slug;
                $image->move($tujuan_upload,$nama_file);

                $arr_foto[] = $nama_file;
            }
            $data_foto = implode(", ", $arr_foto);
            $konten = File_Gambar::create([
                // 'foto_video_konten' =>  $nama_file,
                'foto_video_konten' =>  $data_foto,
                'caption'           =>  $request->caption,
                'slug'              =>  $slug,
                'tempat'            =>  $request->tempat,
                'longitude_tempat'  =>  $request->longitude_tempat,
                'latitude_tempat'   =>  $request->latitude_tempat,
                'id_pengguna'       =>  Auth::user()->pengguna->id_pengguna,
                'id_group'          =>  $request->id_group
            ]);
        }else{
            $konten = File_Gambar::create([
                'foto_video_konten' =>  '',
                'caption'           =>  $request->caption,
                'slug'              =>  $slug,
                'tempat'            =>  $request->tempat,
                'longitude_tempat'  =>  $request->longitude_tempat,
                'latitude_tempat'   =>  $request->latitude_tempat,
                'id_pengguna'       =>  Auth::user()->pengguna->id_pengguna,
                'id_group'          =>  $request->id_group
            ]);
        }

        $insertedId = $konten->id;

        $data_anggota = DB::select("SELECT id_anggota FROM anggota_grup WHERE id_group = '".$request->id_group."' AND id_pengguna != '".Auth::user()->pengguna->id_pengguna."'");
        foreach ($data_anggota as $row) {
            DB::table('notif')->insert([
                'jenis_notif'   => 'Post Grup',
                'isi_notif'     => Auth::user()->pengguna->username.' memposting sesuatu di grup',
                'created_at'    => date("Y-m-d H:i:s"),
                'id_konten'     => $insertedId,
                'id_anggota'    => $row->id_anggota,
                'status'        => 'Belum Dibaca'
            ]); 
        }
        return redirect()->back()->with('success','Konten Group Berhasil Diposting!');
    }

    public function post_komen_grup(Request $request){
        $data = ModelUser::where('username',Auth::user()->pengguna->username)->first();
        if(isset($request->id_balas_komen)){
            $uname = str_replace('@'.$request->username, '<a href="/sosial-media/profil/"'.$request->username.'" style="color:blue;">@'.$request->username.'</a></h5>', $request->isi_komentar);
            $id_komentar = DB::table('comment')->insertGetId([
                    'id_pengguna'           => Auth::user()->pengguna->id_pengguna,
                    'id_balas_komen'        => $request->id_balas_komen,
                    'isi_komentar'          => $uname,
                    'tanggal_komen'         => date("Y-m-d H:i:s"),
                    'status'                => 'Belum Dibaca',
                    'id_konten'             => $request->id_konten
                ]);
        }else{
            $id_komentar = DB::table('comment')->insertGetId([
                'id_pengguna'           => Auth::user()->pengguna->id_pengguna,
                'id_balas_komen'        => 0,
                'isi_komentar'          => $request->isi_komentar,
                'tanggal_komen'         => date("Y-m-d H:i:s"),
                'status'                => 'Belum Dibaca',
                'id_konten'             => $request->id_konten
            ]);
        }
        $data = DB::table('comment')
                        ->join('pengguna', 'comment.id_pengguna', '=', 'pengguna.id_pengguna')->where('comment.id', $id_komentar)
                        ->select('comment.*', 'comment.id AS id_cmt', 'pengguna.*')
                        ->get();
        return response()->json($data);
        // return redirect()->back()->with('success', 'Berhasil Mengirimkan Komentar!');
    }

    public function gabung_grup($id_group){
        $kueri2 = DB::table('anggota_grup')->insert([
                    'id_pengguna'    => Auth::user()->pengguna->id_pengguna,
                    'id_group'       => $id_group
            ]);
        return redirect()->back()->with('success', 'Berhasil Bergabung di Group!');
    }

    public function terima_undangan_grup($id){
        $kueri = DB::table('undangan_grup')->where('id', $id)->update([
                    'status'        => 'Diterima',
                    'tanggal_aksi'  => date("Y-m-d H:i:s")
            ]);
        $id_group = DB::select("SELECT id_group FROM undangan_grup WHERE id = '".$id."'");
        foreach ($id_group as $data) {
            $id_grup = $data->id_group;
        }
        $kueri2 = DB::table('anggota_grup')->insert([
                    'id_pengguna'    => Auth::user()->pengguna->id_pengguna,
                    'id_group'       => $id_grup
            ]);
        return redirect()->back()->with('success', 'Berhasil Bergabung di Group!');
    }

    public function tolak_undangan_grup($id){
        $kueri = DB::table('undangan_grup')->where('id', $id)->update([
                    'status'        => 'Ditolak',
                    'tanggal_aksi'  => date("Y-m-d H:i:s")
            ]);
        return redirect()->back();
    }

    public function keluar_group_proses($id_group){
        DB::table('admin_grup')->where('id_group', $id_group)->where('id_admin', Auth::user()->pengguna->id_pengguna)->delete();
        DB::table('anggota_grup')->where('id_group', $id_group)->where('id_pengguna', Auth::user()->pengguna->id_pengguna)->delete();
        return redirect('/sosial-media/halaman_group');
    }

    public function hapus_group_proses($id_group){
        DB::table('undangan_grup')->where('id_group', $id_group)->delete();
        DB::table('anggota_grup')->where('id_group', $id_group)->delete();
        DB::table('admin_grup')->where('id_group', $id_group)->delete();

        DB::delete("DELETE FROM comment WHERE id_konten IN (SELECT id_konten FROM konten WHERE id_group = '".$id_group."')");

        DB::delete("DELETE FROM likes WHERE id_konten IN (SELECT id_konten FROM konten WHERE id_group = '".$id_group."')");

        File_Gambar::where('id_group', $id_group)->delete();
        
        $row_gr = DB::table('grup')->where('id_group', $id_group)->first();
        $nm_grp = $row_gr->nama_group;
        File::deleteDirectory(public_path('data_file/group/'.$nm_grp));

        DB::table('grup')->where('id_group', $id_group)->delete();

        return redirect('/sosial-media/halaman_group');
    }

    public function tambah_admin(Request $request){
        $tgl = date("Y-m-d H:i:s");
        // print_r($arr);die;
        foreach ($request->pilih_admin as $data) {
            $kueri2 = DB::table('admin_grup')->insertGetId([
                    'id_admin_penambah' => Auth::user()->pengguna->id_pengguna,
                    'id_admin'          => $data,
                    'id_group'          => $request->id_group
            ]);

            DB::table('notif')->insert([
                'jenis_notif'   => 'Admin Grup',
                'isi_notif'     => Auth::user()->pengguna->username.' menambahkan Anda menjadi admin Group',
                'created_at'    => $tgl,
                'id_undangan'   => $kueri2,
                'status'        => 'Belum Dibaca'
            ]);
        }
        return redirect()->back();
    }
   

    public function lihat_profil($username){
        $cek = ModelUser::where('username', $username)->first();
        if($cek){
            $jml_konten = DB::select("SELECT COUNT(id_pengguna) AS jml_konten FROM konten WHERE is_active = 1 AND id_group = 0 AND id_pengguna = (SELECT id_pengguna FROM pengguna WHERE username = '".$username."')");
            $konten = DB::select("SELECT * FROM konten WHERE is_active = 1 AND id_group = 0 AND id_pengguna = (SELECT id_pengguna FROM pengguna WHERE username = '".$username."') ORDER BY created_at DESC");
            $teman_saya = null;
            $followers_saya = null;
            $komentar = null;
            $balas_komentar = null;
            $notif_pesan = null;
            $list_notif_display = null;
            $total_notif = null;
            $notif_group = null;
            $likes = null;
            $likes_all = null;
            $follow_request = null;
            if(Auth::check()){
                $konten = DB::select("SELECT *, (SELECT IF(COUNT(*) > 0, true, false) FROM likes WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND likes.id_konten = konten.id_konten) AS is_like FROM konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna WHERE konten.is_active = 1 AND konten.id_group = 0 AND konten.id_pengguna = (SELECT id_pengguna FROM pengguna WHERE username = '".$username."') ORDER BY created_at DESC");
                
                $teman_saya = DB::select("SELECT * FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna=(SELECT id_pengguna FROM pengguna WHERE username = '".Auth::user()->pengguna->username."'))");
    
                $follow_request = DB::select("SELECT * FROM pengguna JOIN follow_request ON pengguna.id_pengguna = follow_request.id_pengguna WHERE follow_request.id_requester = '".Auth::user()->pengguna->id_pengguna."' AND follow_request.status = 'Menunggu'");
    
                
                $followers_saya = DB::select("SELECT * FROM pengguna WHERE id_pengguna IN (SELECT id_followers FROM followers WHERE id_pengguna=(SELECT id_pengguna FROM pengguna WHERE username = '".Auth::user()->pengguna->username."'))");
    
                $komentar = DB::select("SELECT comment.*, comment.id AS id_cmt, p.* FROM konten JOIN comment ON konten.id_konten=comment.id_konten JOIN pengguna p2 ON konten.id_pengguna=p2.id_pengguna JOIN pengguna p ON comment.id_pengguna = p.id_pengguna WHERE konten.is_active = 1 AND konten.id_group = 0 AND konten.id_pengguna = (SELECT id_pengguna FROM pengguna WHERE username = '".$username."') OR konten.id_pengguna IN (SELECT id_pengguna FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna='".Auth::user()->pengguna->id_pengguna."'))");
    
                $balas_komentar = DB::select("SELECT comment.*, comment.id AS id_cmt, pengguna.* FROM konten JOIN comment ON konten.id_konten=comment.id_konten JOIN pengguna ON comment.id_pengguna=pengguna.id_pengguna WHERE konten.is_active = 1 AND konten.id_group = 0 AND konten.id_pengguna = (SELECT id_pengguna FROM pengguna WHERE username = '".$username."') OR konten.id_pengguna IN (SELECT id_pengguna FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna='".Auth::user()->pengguna->id_pengguna."'))");
                $total_notif = $this->total_notif();
                $list_notif_display = $this->list_notif_display();
                $notif_pesan = $this->notif_pesan();
                $notif_group = $this->notif_group();
    
                $likes = DB::select("SELECT * FROM likes JOIN pengguna ON likes.id_pengguna = pengguna.id_pengguna WHERE id_konten IN (SELECT id_konten FROM konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna WHERE konten.is_active = 1 AND konten.id_group = 0 AND konten.id_pengguna = (SELECT id_pengguna FROM pengguna WHERE username = '".$username."') ORDER BY konten.created_at DESC)");
                $likes_all = DB::select("SELECT * FROM likes JOIN pengguna ON likes.id_pengguna = pengguna.id_pengguna WHERE id_konten IN (SELECT id_konten FROM konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna WHERE konten.is_active = 1 AND konten.id_group = 0 AND (konten.id_pengguna = (SELECT id_pengguna FROM pengguna WHERE username = '".$username."') OR konten.id_pengguna IN (SELECT id_pengguna FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna = (SELECT id_pengguna FROM pengguna WHERE username = '".$username."')))) ORDER BY konten.created_at DESC)");
                // $likes_me = DB::select("SELECT * FROM likes WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND id_konten IN (SELECT id_konten FROM konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna WHERE konten.id_group = 0 AND (konten.id_pengguna = '".Auth::user()->pengguna->id_pengguna."' OR konten.id_pengguna IN (SELECT id_pengguna FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."'))) ORDER BY konten.created_at DESC)");
            }
            $teman = DB::select("SELECT * FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna=(SELECT id_pengguna FROM pengguna WHERE username = '".$username."'))");
            
            $jml_teman = DB::select("SELECT COUNT(id) AS jml_following FROM following WHERE id_pengguna=(SELECT id_pengguna FROM pengguna WHERE username = '".$username."')");
            $profil = DB::select("SELECT * FROM pengguna WHERE id_pengguna = (SELECT id_pengguna FROM pengguna WHERE username = '".$username."')");
            $followers = DB::select("SELECT * FROM pengguna WHERE id_pengguna IN (SELECT id_followers FROM followers WHERE id_pengguna=(SELECT id_pengguna FROM pengguna WHERE username = '".$username."'))");
            $jml_followers = DB::select("SELECT COUNT(id) AS jml_followers FROM followers WHERE id_pengguna = (SELECT id_pengguna FROM pengguna WHERE username = '".$username."')");
            $pengaturan = DB::select("SELECT * FROM pengaturan WHERE id_pengguna = (SELECT id_pengguna FROM pengguna WHERE username = '".$username."')");
            // $data = ModelUser::where('username',$username)->first();
            // $url_api = 'http://marketpalcedesaku.masuk.web.id/api/productvillage/'.$data->village_id;
            // $api_product = json_decode( file_get_contents($url_api), true );
            // $api_product = '';
            $video_history_view = VideoView::where('id_user', Auth::user()->id)->with('video')->orderBy('created_at', 'desc')->limit(4)->get();
            $video_user = Video::where('id_pengguna', Auth::user()->id)->with(['detail'])->orderBy('created_at', 'desc')->paginate(8);
            // dd($video_user);
            return view('profil', compact('teman', 'teman_saya', 'jml_konten', 'konten', 'jml_teman', 'profil', 'followers', 'followers_saya', 'jml_followers', 'komentar', 'balas_komentar', 'notif_pesan', 'list_notif_display', 'total_notif', 'notif_group', 'likes', 'likes_all', 'pengaturan', 'follow_request','video_history_view','video_user'));
        }else{
            return redirect('/sosial-media/beranda');
        }
    }

    public function get_shop(){
        if(Auth::check()){
            $total_notif = $this->total_notif();
            $list_notif_display = $this->list_notif_display();
            $notif_pesan = $this->notif_pesan();
            $notif_group = $this->notif_group();
        }
        $url_api = 'http://marketpalcedesaku.masuk.web.id/api/products';
        // dd($url_api);
        $api_product = json_decode( file_get_contents($url_api), true );
        return view('landing_shop', compact('api_product', 'total_notif', 'list_notif_display', 'notif_pesan', 'notif_group'));
    }

    public function hapus_komentar_proses($id_komentar){
        DB::table('notif')->where('id_comment', $id_komentar)->delete();
        DB::table('reports')->where('id_comment_reported', $id_komentar)->delete();
        DB::table('comment')->where('id', $id_komentar)->delete();
    }

    public function hapus_konten($id_konten){
        $file = File_Gambar::where('id_konten',$id_konten)->first();
        $uname = Auth::user()->pengguna->username;
        $tmp_fold = 'foto_konten';
        $date = date("d-m-Y", strtotime($file->created_at));
        $slug = $file->slug;
        // HAPUS FILE AJA
        // if( strpos(', ', $file[0]->foto_video_konten) !== false ) {
        //     $file_list = explode(", ", $file[0]->foto_video_konten);
        //     for ($i=0; $i < COUNT($file_list); $i++) { 
        //         File::delete('data_file/'.$uname.'/'.$tmp_fold.'/'.$date.'/'.$slug.'/'.$file_list[$i]);
        //     }
        // }else{
        //     File::delete('data_file/'.$uname.'/'.$tmp_fold.'/'.$date.'/'.$slug.'/'.$file_list);
        // }

        //HAPUS FOLDER SLUG
        if($file->id_group == 0){
            File::deleteDirectory(public_path('data_file/'.$uname.'/'.$tmp_fold.'/'.$date.'/'.$slug));
        }else{
            $row_gr = DB::table('grup')->where('id_group', $file->id_group)->first();
            $nm_grp = $row_gr->nama_group;
            File::deleteDirectory(public_path('data_file/group/'.$nm_grp.'/'.$tmp_fold.'/'.$date.'/'.$slug));
        }

        $data = DB::table('comment')->where('id_konten', $id_konten)->get();
        foreach($data as $row){
            $id_comment = $row->id;
            DB::table('notif')->where('id_comment', $id_comment)->delete();
        }
        $data = DB::table('likes')->where('id_konten', $id_konten)->get();
        foreach($data as $row){
            $id_likes = $row->id;
            DB::table('notif')->where('id_likes', $id_likes)->delete();
        }
        DB::table('comment')->where('id_konten', $id_konten)->delete();
        DB::table('likes')->where('id_konten', $id_konten)->delete();
        File_Gambar::where('id_konten', $id_konten)->delete();

        return redirect()->back();
    }

    public function edit_konten_proses(Request $request){
        // if (isset($request->tempat2)) {
        //     $data = [
        //         'caption'   =>  $request->caption,
        //         'tempat'    =>  $request->tempat2,
        //         'long'      =>  $request->long,
        //         'lat'       =>  $request->lat
        //     ];
        // }else{
        //     $data = [
        //         'caption'   =>  $request->caption,
        //         'tempat'    =>  ''
        //     ];
        // }
        $data = [
                'caption'   =>  $request->caption
            ];
        DB::table('konten')->where('id_konten', $request->id_konten)->update($data);
        return redirect()->back()->with('success', 'Konten Berhasil Diupdate!');
    }

    public function pengaturan(){
        $profil = DB::select("SELECT * FROM pengguna WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        $total_notif = $this->total_notif();
        $list_notif_display = $this->list_notif_display();
        $notif_pesan = $this->notif_pesan();
        $notif_group = $this->notif_group();
        return view('pengaturan', compact('profil', 'notif_pesan', 'list_notif_display', 'total_notif', 'notif_group'));
    }

    public function ubah_profil_proses(Request $request){
        $data_before = DB::table('pengguna')
                    ->where('id_pengguna', $request->id_pengguna)->select()->first();
        if($request->hasFile('foto_profil') && $request->hasFile('foto_sampul')){
            $file_profil = $request->file('foto_profil');
            $file_sampul = $request->file('foto_sampul');

            $nama_file_profil = $file_profil->getClientOriginalName();
            $nama_file_sampul = $file_sampul->getClientOriginalName();

            $tujuan_upload_profil = 'data_file/foto_profil';
            $tujuan_upload_sampul = 'data_file/foto_sampul';
            $file_profil->move($tujuan_upload_profil,$nama_file_profil);
            $file_sampul->move($tujuan_upload_sampul,$nama_file_sampul);
            if($request->berita){
                DB::table('pengguna')->where('id_pengguna', $request->id_pengguna)->update([
                    'username'=>$request->username,
                    'nama'=>$request->nama,
                    'email' => $request->email,
                    'nomor_hp'=>$request->nomor_hp,
                    'bio'=>$request->bio,
                    'website'=>$request->website,
                    'youtube'=>$request->youtube,
                    'berita'=>$request->berita,
                    'marketplace'=>$request->marketplace,
                    'musrembang'=>$request->musrembang,
                    'foto_profil'=>$nama_file_profil,
                    'foto_sampul'=>$nama_file_sampul
                ]);
            }else{
                DB::table('pengguna')->where('id_pengguna', $request->id_pengguna)->update([
                    'username'=>$request->username,
                    'nama'=>$request->nama,
                    'email' => $request->email,
                    'nomor_hp'=>$request->nomor_hp,
                    'bio'=>$request->bio,
                    'website'=>$request->website,
                    'youtube'=>$request->youtube,
                    'foto_profil'=>$nama_file_profil,
                    'foto_sampul'=>$nama_file_sampul
                ]);
            }
            DB::table('users')->where('id', $request->id_pengguna)->update([
                    'name'=>$request->nama,
                    'email' => $request->email
                ]);
            File::move('data_file/'.$data_before->username, 'data_file/'.$request->username);
            return redirect('/sosial-media/pengaturan')->with('success', 'Profil Berhasil Diupdate!');
        }else if($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $nama_file = $file->getClientOriginalName();

            $tujuan_upload = 'data_file/foto_profil';
            $file->move($tujuan_upload,$nama_file);
            if($request->berita){
                DB::table('pengguna')->where('id_pengguna', $request->id_pengguna)->update([
                    'username'=>$request->username,
                    'nama'=>$request->nama,
                    'email' => $request->email,
                    'nomor_hp'=>$request->nomor_hp,
                    'bio'=>$request->bio,
                    'website'=>$request->website,
                    'youtube'=>$request->youtube,
                    'berita'=>$request->berita,
                    'marketplace'=>$request->marketplace,
                    'musrembang'=>$request->musrembang,
                    'foto_profil'=>$nama_file
                ]);
            }else{
                DB::table('pengguna')->where('id_pengguna', $request->id_pengguna)->update([
                    'username'=>$request->username,
                    'nama'=>$request->nama,
                    'email' => $request->email,
                    'nomor_hp'=>$request->nomor_hp,
                    'bio'=>$request->bio,
                    'website'=>$request->website,
                    'youtube'=>$request->youtube,
                    'foto_profil'=>$nama_file
                ]);
            }
            DB::table('users')->where('id', $request->id_pengguna)->update([
                    'name'=>$request->nama,
                    'email' => $request->email
                ]);
            File::move('data_file/'.$data_before->username, 'data_file/'.$request->username);
            return redirect('/sosial-media/pengaturan')->with('success', 'Profil Berhasil Diupdate!');
        }else if($request->hasFile('foto_sampul')){
            $file = $request->file('foto_sampul');
            $nama_file = $file->getClientOriginalName();

            $tujuan_upload = 'data_file/foto_sampul';
            $file->move($tujuan_upload,$nama_file);
            if($request->berita){
                DB::table('pengguna')->where('id_pengguna', $request->id_pengguna)->update([
                    'username'=>$request->username,
                    'nama'=>$request->nama,
                    'email' => $request->email,
                    'nomor_hp'=>$request->nomor_hp,
                    'bio'=>$request->bio,
                    'website'=>$request->website,
                    'youtube'=>$request->youtube,
                    'berita'=>$request->berita,
                    'marketplace'=>$request->marketplace,
                    'musrembang'=>$request->musrembang,
                    'foto_sampul'=>$nama_file
                ]);
            }else{
                DB::table('pengguna')->where('id_pengguna', $request->id_pengguna)->update([
                    'username'=>$request->username,
                    'nama'=>$request->nama,
                    'email' => $request->email,
                    'nomor_hp'=>$request->nomor_hp,
                    'bio'=>$request->bio,
                    'website'=>$request->website,
                    'youtube'=>$request->youtube,
                    'foto_sampul'=>$nama_file
                ]);
            }
            DB::table('users')->where('id', $request->id_pengguna)->update([
                    'name'=>$request->nama,
                    'email' => $request->email
                ]);
            File::move('data_file/'.$data_before->username, 'data_file/'.$request->username);
            return redirect('/sosial-media/pengaturan')->with('success', 'Profil Berhasil Diupdate!');
        }else{
            if($request->berita){
                DB::table('pengguna')->where('id_pengguna', $request->id_pengguna)->update([
                    'username'=>$request->username,
                    'nama'=>$request->nama,
                    'email' => $request->email,
                    'nomor_hp'=>$request->nomor_hp,
                    'bio'=>$request->bio,
                    'website'=>$request->website,
                    'youtube'=>$request->youtube,
                    'berita'=>$request->berita,
                    'marketplace'=>$request->marketplace,
                    'musrembang'=>$request->musrembang,
                ]);
            }else{
                DB::table('pengguna')->where('id_pengguna', $request->id_pengguna)->update([
                    'username'=>$request->username,
                    'nama'=>$request->nama,
                    'email' => $request->email,
                    'nomor_hp'=>$request->nomor_hp,
                    'bio'=>$request->bio,
                    'website'=>$request->website,
                    'youtube'=>$request->youtube
                ]);
            }
            DB::table('users')->where('id', $request->id_pengguna)->update([
                    'name'=>$request->nama,
                    'email' => $request->email
                ]);
            File::move('data_file/'.$data_before->username, 'data_file/'.$request->username);
            return redirect('/sosial-media/pengaturan')->with('success', 'Profil Berhasil Diupdate!');
        }
    }

    public function pengaturan_pass(){
       $profil = DB::select("SELECT * FROM pengguna WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        $total_notif = $this->total_notif();
        $list_notif_display = $this->list_notif_display();
        $notif_pesan = $this->notif_pesan();
        $notif_group = $this->notif_group();
        return view('pengaturan_password', compact('profil', 'notif_pesan', 'list_notif_display', 'total_notif', 'notif_group'));
    }

    public function ubah_password_proses(Request $request){
        $data = ModelUser::where('username',Auth::user()->pengguna->username)->first();
        if (strcmp($request->password_lama, $data->password)==0) {
            $this->validate($request, [
                'konfirmasi_password'=>'same:password_baru',
            ]);

            DB::table('pengguna')->where('id_pengguna', $request->id_pengguna)->update([
                'password'=>Hash::make($request->password_baru)
            ]);

            DB::table('users')->where('id', $request->id_pengguna)->update([
                'password'=>Hash::make($request->password)
            ]);
            return redirect('/sosial-media/pengaturan_pass')->with('success', 'Password Berhasil Diupdate!');
        }else{
            return redirect('/sosial-media/pengaturan_pass')->with('alert', 'Password Lama Salah!');
        }
    }

    public function pengaturan_notif(){
        $pengaturan = DB::select("SELECT * FROM pengaturan WHERE id_pengguna = (SELECT id_pengguna FROM pengguna WHERE username = '".Auth::user()->pengguna->username."')");
        $total_notif = $this->total_notif();
        $list_notif_display = $this->list_notif_display();
        $notif_pesan = $this->notif_pesan();
        $notif_group = $this->notif_group();
        $profil = DB::select("SELECT * FROM pengguna WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        return view('pengaturan_notif', compact('pengaturan', 'notif_pesan', 'list_notif_display', 'total_notif', 'notif_group', 'profil'));
    }

    public function ubah_notif_proses(Request $request){
        DB::table('pengaturan')->where('id_pengguna', $request->id_pengguna)->update([
            'notifikasi_menyukai'=>$request->notif_suka,
            'notifikasi_komentar'=>$request->notif_komentar,
            'notifikasi_pesan'=>$request->notif_pesan
        ]);
        return redirect('/sosial-media/pengaturan_notif')->with('success', 'Pengaturan Notifikasi Berhasil Diupdate!');
    }

    public function pengaturan_privasi(){
        $total_notif = $this->total_notif();
        $list_notif_display = $this->list_notif_display();
        $notif_pesan = $this->notif_pesan();
        $notif_group = $this->notif_group();
        $pengaturan = DB::select("SELECT * FROM pengaturan WHERE id_pengguna = (SELECT id_pengguna FROM pengguna WHERE username = '".Auth::user()->pengguna->username."')");
        $profil = DB::select("SELECT * FROM pengguna WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        return view('pengaturan_privasi', compact('notif_pesan', 'list_notif_display', 'total_notif', 'notif_group', 'profil', 'pengaturan'));
    }

    public function ubah_privasi_proses(Request $request){
        DB::table('pengaturan')->where('id_pengguna', Auth::user()->pengguna->id_pengguna)->update([
            'akun_privat'=>$request->pilihan
        ]);
        return redirect('/sosial-media/pengaturan_privasi')->with('success', 'Pengaturan Privasi Berhasil Diupdate!');
    }

    public function pengaturan_log(){
        $login_terbaru = DB::select("SELECT * FROM aktifitas_login WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."' ORDER BY tanggal DESC LIMIT 1");
        $riwayat_login = DB::select("SELECT * FROM aktifitas_login WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."' ORDER BY tanggal DESC LIMIT 5");
        $total_notif = $this->total_notif();
        $list_notif_display = $this->list_notif_display();
        $notif_pesan = $this->notif_pesan();
        $notif_group = $this->notif_group();
        $profil = DB::select("SELECT * FROM pengguna WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        return view('pengaturan_log', compact('login_terbaru', 'riwayat_login', 'notif_pesan', 'list_notif_display', 'total_notif', 'notif_group', 'profil'));
    }

    public function pengaturan_hapus_akun(){
        $total_notif = $this->total_notif();
        $list_notif_display = $this->list_notif_display();
        $notif_pesan = $this->notif_pesan();
        $notif_group = $this->notif_group();
        $profil = DB::select("SELECT * FROM pengguna WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
        return view('pengaturan_hapus_akun', compact('notif_pesan', 'list_notif_display', 'total_notif', 'notif_group', 'profil'));
    }

    public function hapus_akun_proses(Request $request){
        $data = ModelUser::where('username',Auth::user()->pengguna->username)->first();
        File::deleteDirectory(public_path('data_file/'.Auth::user()->pengguna->username));
        // if($data){ 
        //     if($request->password == $data->password){
        //         DB::table('hapus_akun')->insert([
        //                 'id_pengguna'   => $data->id_pengguna,
        //                 'alasan'        => $request->alasan,
        //                 'tanggal'       => date("Y-m-d H:i:s"),
        //                 // 'status'        => 'menunggu',
        //                 // 'tanggal_hapus' => date("Y-m-d H:i:s", strtotime("+2 minute"))
        //             ]);
        //         return redirect('/sosial-media/logout_proses');
        //     }else{
        //         return redirect('/sosial-media/pengaturan_hapus_akun')->with('alert', 'Password Salah!');
        //     }
        // }
        
        DB::delete("DELETE FROM notif 
WHERE id_followers IN (SELECT id FROM followers WHERE id_followers = '".$data->id_pengguna."' OR id_pengguna = '".$data->id_pengguna."') 
OR id_anggota IN (SELECT id_anggota FROM anggota_grup WHERE id_pengguna = '".$data->id_pengguna."') 
OR id_likes IN (SELECT id FROM likes WHERE id_pengguna = '".$data->id_pengguna."') 
OR id_comment IN (SELECT id FROM comment WHERE id_pengguna = '".$data->id_pengguna."') 
OR id_konten IN (SELECT id_konten FROM konten WHERE id_pengguna = '".$data->id_pengguna."') File::deleteDirectory(public_path('data_file/group/'.$nm_grp));
OR (id_undangan IN 
		(SELECT id FROM undangan_grup 
            WHERE id_pengguna_pengirim = '".$data->id_pengguna."'
            OR id_pengguna_penerima = '".$data->id_pengguna."'
         )
	AND jenis_notif = 'Undangan Grup')
OR (id_undangan IN 
		(SELECT id FROM admin_grup 
            WHERE id_admin_penambah = '".$data->id_pengguna."' 
            OR id_admin = '".$data->id_pengguna."'
         )
	AND jenis_notif = 'Admin Grup')");
                                                 
        DB::delete("DELETE FROM admin_grup WHERE id_admin = '".$data->id_pengguna."'");

        DB::delete("DELETE FROM aktifitas_login WHERE id_pengguna = '".$data->id_pengguna."'");

        DB::delete("DELETE FROM anggota_grup WHERE id_pengguna = '".$data->id_pengguna."'");

        DB::delete("DELETE FROM chat WHERE id_pengirim = '".$data->id_pengguna."' OR id_penerima = '".$data->id_pengguna."'");

        DB::delete("DELETE FROM comment WHERE id_pengguna = '".$data->id_pengguna."'");

        DB::delete("DELETE FROM followers WHERE id_followers = '".$data->id_pengguna."' OR id_pengguna = '".$data->id_pengguna."'");

        DB::delete("DELETE FROM following WHERE id_following = '".$data->id_pengguna."' OR id_pengguna = '".$data->id_pengguna."'");

        DB::delete("DELETE FROM follow_request WHERE id_requester = '".$data->id_pengguna."' OR id_pengguna = '".$data->id_pengguna."'");

        DB::delete("DELETE FROM grup WHERE admin = '".$data->id_pengguna."'");

        DB::delete("DELETE FROM konten WHERE id_pengguna = '".$data->id_pengguna."'");

        DB::delete("DELETE FROM likes WHERE id_pengguna = '".$data->id_pengguna."'");

        DB::delete("DELETE FROM pengaturan WHERE id_pengguna = '".$data->id_pengguna."'");

        DB::delete("DELETE FROM pengguna WHERE id_pengguna = '".$data->id_pengguna."'");

        DB::delete("DELETE FROM reports WHERE account_reporter = '".$data->id_pengguna."'");

        DB::delete("DELETE FROM undangan_grup WHERE id_pengguna_pengirim = '".$data->id_pengguna."' OR id_pengguna_penerima = '".$data->id_pengguna."'");

        DB::delete("DELETE FROM users WHERE id = '".$data->id_pengguna."'");
        Auth::logout();
        return redirect('/sosial-media');
    }

    public function chat(){
        $teman = DB::select("SELECT * FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna=(SELECT id_pengguna FROM pengguna WHERE username = '".Auth::user()->pengguna->username."'))");
        $list_chat = DB::select("SELECT c.*, p.username AS username_pengirim, p.foto_profil AS foto_pengirim, p2.username AS username_penerima, p2.foto_profil AS foto_penerima FROM chat c JOIN pengguna p ON c.id_pengirim=p.id_pengguna JOIN pengguna p2 ON c.id_penerima=p2.id_pengguna WHERE id_chat IN ( SELECT MAX(id_chat) FROM chat WHERE id_pengirim = '".Auth::user()->pengguna->id_pengguna."' OR id_penerima = '".Auth::user()->pengguna->id_pengguna."' GROUP BY id_room_chat ) ORDER BY id_chat DESC");
        $jumlah = DB::select("SELECT id_room_chat,  COUNT(id_chat) AS jml FROM chat WHERE id_penerima = '".Auth::user()->pengguna->id_pengguna."' AND status = 'Belum Dibaca' GROUP BY id_room_chat");
        $total_notif = $this->total_notif();
        $list_notif_display = $this->list_notif_display();
        $notif_pesan = $this->notif_pesan();
        $notif_group = $this->notif_group();
        return view('chat', compact('teman', 'list_chat', 'jumlah', 'notif_pesan', 'list_notif_display', 'total_notif', 'notif_group'));
    }

    public function chat_new($username){
        $teman = DB::select("SELECT * FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna=(SELECT id_pengguna FROM pengguna WHERE username = '".Auth::user()->pengguna->username."'))");
        $list_chat = DB::select("SELECT c.*, p.username AS username_pengirim, p.foto_profil AS foto_pengirim, p2.username AS username_penerima, p2.foto_profil AS foto_penerima FROM chat c JOIN pengguna p ON c.id_pengirim=p.id_pengguna JOIN pengguna p2 ON c.id_penerima=p2.id_pengguna WHERE id_chat IN ( SELECT MAX(id_chat) FROM chat WHERE id_pengirim = '".Auth::user()->pengguna->id_pengguna."' OR id_penerima = '".Auth::user()->pengguna->id_pengguna."' GROUP BY id_room_chat ) ORDER BY id_chat DESC");
        $jumlah = DB::select("SELECT id_room_chat,  COUNT(id_chat) AS jml FROM chat WHERE id_penerima = '".Auth::user()->pengguna->id_pengguna."' AND status = 'Belum Dibaca' GROUP BY id_room_chat");
        $data_penerima = ModelUser::where('username',$username)->first();
        $total_notif = $this->total_notif();
        $list_notif_display = $this->list_notif_display();
        $notif_pesan = $this->notif_pesan();
        $notif_group = $this->notif_group();
        return view('chat', compact('teman', 'list_chat', 'jumlah', 'notif_pesan', 'list_notif_display', 'total_notif', 'notif_group', 'data_penerima'));
    }    

    public function chat_lahan($username){
        $teman = DB::select("SELECT * FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna=(SELECT id_pengguna FROM pengguna WHERE username = '".Auth::user()->pengguna->username."'))");
        $list_chat = DB::select("SELECT c.*, p.username AS username_pengirim, p.foto_profil AS foto_pengirim, p2.username AS username_penerima, p2.foto_profil AS foto_penerima FROM chat c JOIN pengguna p ON c.id_pengirim=p.id_pengguna JOIN pengguna p2 ON c.id_penerima=p2.id_pengguna WHERE id_chat IN ( SELECT MAX(id_chat) FROM chat WHERE id_pengirim = '".Auth::user()->pengguna->id_pengguna."' OR id_penerima = '".Auth::user()->pengguna->id_pengguna."' GROUP BY id_room_chat ) ORDER BY id_chat DESC");
        $jumlah = DB::select("SELECT id_room_chat,  COUNT(id_chat) AS jml FROM chat WHERE id_penerima = '".Auth::user()->pengguna->id_pengguna."' AND status = 'Belum Dibaca' GROUP BY id_room_chat");
        $data_penerima = ModelUser::where('username',$username)->first();
        $total_notif = $this->total_notif();
        $list_notif_display = $this->list_notif_display();
        $notif_pesan = $this->notif_pesan();
        $notif_group = $this->notif_group();
        return view('chat', compact('teman', 'list_chat', 'jumlah', 'notif_pesan', 'list_notif_display', 'total_notif', 'notif_group', 'data_penerima'));
    }    

    public function chat_detail($id_room_chat){
        $teman = DB::select("SELECT * FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna=(SELECT id_pengguna FROM pengguna WHERE username = '".Auth::user()->pengguna->username."'))");
        DB::update("UPDATE chat SET status = 'Sudah Dibaca' WHERE id_room_chat = '".$id_room_chat."' AND id_penerima = '".Auth::user()->pengguna->id_pengguna."'");
        $list_chat = DB::select("SELECT c.*, p.username AS username_pengirim, p.foto_profil AS foto_pengirim, p2.username AS username_penerima, p2.foto_profil AS foto_penerima FROM chat c JOIN pengguna p ON c.id_pengirim=p.id_pengguna JOIN pengguna p2 ON c.id_penerima=p2.id_pengguna WHERE id_chat IN ( SELECT MAX(id_chat) FROM chat WHERE id_pengirim = '".Auth::user()->pengguna->id_pengguna."' OR id_penerima = '".Auth::user()->pengguna->id_pengguna."' GROUP BY id_room_chat ) ORDER BY id_chat DESC");
        $data_chat = DB::select("SELECT chat.*, p.username AS username_penerima, p2.username AS username_pengirim FROM chat JOIN pengguna p ON chat.id_penerima = p.id_pengguna JOIN pengguna p2 ON chat.id_pengirim = p2.id_pengguna WHERE chat.id_room_chat = '".$id_room_chat."' ORDER BY tanggal_chat ASC");
        // dd($data_chat);
        $jumlah = DB::select("SELECT id_room_chat,  COUNT(id_chat) AS jml FROM chat WHERE id_penerima = '".Auth::user()->pengguna->id_pengguna."' AND status = 'Belum Dibaca' GROUP BY id_room_chat");
        $total_notif = $this->total_notif();
        $list_notif_display = $this->list_notif_display();
        $notif_pesan = $this->notif_pesan();
        $notif_group = $this->notif_group();
        if($data_chat){
            return view('chat_detail', compact('teman', 'list_chat', 'data_chat', 'jumlah', 'list_notif_display', 'total_notif', 'notif_pesan', 'notif_group'));
        }else{
            return redirect('/sosial-media/chat');
        }
    }

    public function chat_proses(Request $request){
        $teman = DB::select("SELECT * FROM pengguna WHERE username IN (SELECT id_following FROM following WHERE id_pengguna=(SELECT id_pengguna FROM pengguna WHERE username = '".Auth::user()->pengguna->username."'))");
        $data = ModelUser::where('username',$request->username_penerima)->first();
        $tgl = date("Y-m-d H:i:s");
        // dd($request->all);
        if(isset($request->id_room_chat)){
            // dd($request->all());
            if ($request->hasFile('gambar')) {
                $foto = $request->file('gambar');

                $nama_foto = $foto->getClientOriginalName();

                // $tujuan_upload = 'data_file/chat/'+$id_room_chat;
                // print_r($nama_foto);
                $nama_folder = 'data_file/chat/'.$request->id_room_chat.'/'.date("d-m-Y");
                // print_r($nama_folder);die;
                $foto->move($nama_folder,$nama_foto);
                $data_chat = DB::table('chat')->insert([
                        'id_room_chat'          => $request->id_room_chat,
                        'tanggal_chat'          => $tgl,
                        // 'isi_chat'              => '',
                        'id_pengirim'           => Auth::user()->pengguna->id_pengguna,
                        'id_penerima'           => $data->id_pengguna,
                        'media'                 => $nama_foto,
                        'status'                => 'Belum Dibaca'
                    ]);
            }else{
                $data_chat = DB::table('chat')->insert([
                        'id_room_chat'          => $request->id_room_chat,
                        'tanggal_chat'          => $tgl,
                        'isi_chat'              => $request->isi_chat,
                        'id_pengirim'           => Auth::user()->pengguna->id_pengguna,
                        'id_penerima'           => $data->id_pengguna,
                        // 'media'                 => '',
                        'status'                => 'Belum Dibaca'
                    ]);
            }
            return redirect()->back();
        }else{
            $kueri = DB::select("SELECT MAX(id_room_chat) AS id_room_chat FROM chat");
            foreach($kueri as $row) {
                $id =  $row->id_room_chat;
            }
            if($id == null){
                $i = 0;
            }else{
                $i = $id;
            }
            $id_room_chat = $i+1;
            // $data_room = DB::table('room_chat')->insert([
            //         'id_room_chat'  => $id_room_chat
            //     ]);
            if ($request->hasFile('gambar')) {
                $foto = $request->file('gambar');

                $nama_foto = $foto->getClientOriginalName();

                $nama_folder = 'data_file/chat/'.$id_room_chat.'/'.date("d-m-Y");
                // print_r($nama_folder);die;
                $foto->move($nama_folder,$nama_foto);
                $data_chat = DB::table('chat')->insertGetId([
                        'id_room_chat'          => $id_room_chat,
                        'tanggal_chat'          => $tgl,
                        'id_pengirim'           => Auth::user()->pengguna->id_pengguna,
                        'id_penerima'           => $data->id_pengguna,
                        'media'                 => $nama_foto,
                        'status'                => 'Belum Dibaca'
                    ]);
                $data_room = DB::select("SELECT id_room_chat FROM chat WHERE id_chat = '".$data_chat."'");
                return response()->json($data_room);
            }else{
                $data_chat = DB::table('chat')->insertGetId([
                        'id_room_chat'          => $id_room_chat,
                        'tanggal_chat'          => $tgl,
                        'isi_chat'              => $request->isi_chat,
                        'id_pengirim'           => Auth::user()->pengguna->id_pengguna,
                        'id_penerima'           => $data->id_pengguna,
                        'status'                => 'Belum Dibaca'
                    ]);
                $data_room = DB::select("SELECT id_room_chat FROM chat WHERE id_chat = '".$data_chat."'");
                foreach ($data_room as $dt) {
                    $id_room_chat = $dt->id_room_chat;
                }
                return redirect('/sosial-media/chat/'.$id_room_chat);
                // return response()->json($data_room);
            }
            // return redirect('/sosial-media/chat/'.$id_room_chat);
            // $data_room = DB::select("SELECT id_room_chat FROM chat WHERE id_chat = '".$data_chat."'");
            // return response()->json($data_room);
        }
        // return redirect()->back();
    }

    public function cek_chat($username_penerima){
        $data = ModelUser::where('username', $username_penerima)->first();
        $data_chat = DB::select("SELECT * FROM chat JOIN pengguna p ON chat.id_penerima = p.id_pengguna JOIN pengguna p2 ON chat.id_pengirim = p2.id_pengguna WHERE (chat.id_pengirim = '".$data->id_pengguna."' OR chat.id_penerima = '".$data->id_pengguna."') AND (chat.id_pengirim = '".Auth::user()->pengguna->id_pengguna."' OR chat.id_penerima = '".Auth::user()->pengguna->id_pengguna."') ORDER BY tanggal_chat ASC");
        return response()->json($data_chat);
    }

    public function konten_detail($id_konten){
        $konten = DB::select("SELECT *, (SELECT IF(COUNT(*) > 0, true, false) FROM likes WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND likes.id_konten = konten.id_konten) AS is_like FROM konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna WHERE konten.id_konten = '".$id_konten."'");
        $komentar = DB::select("SELECT comment.*, comment.id AS id_cmt, p.* FROM konten JOIN comment ON konten.id_konten=comment.id_konten JOIN pengguna p2 ON konten.id_pengguna=p2.id_pengguna JOIN pengguna p ON comment.id_pengguna = p.id_pengguna WHERE konten.id_konten = '".$id_konten."'");
        $jml_komentar = DB::select("SELECT COUNT(comment.id) AS jumlah, comment.id_konten FROM konten JOIN comment ON konten.id_konten=comment.id_konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna WHERE konten.id_konten = '".$id_konten."' GROUP BY comment.id_konten");
        $balas_komentar = DB::select("SELECT comment.*, comment.id AS id_cmt, pengguna.* FROM konten JOIN comment ON konten.id_konten=comment.id_konten JOIN pengguna ON comment.id_pengguna=pengguna.id_pengguna WHERE konten.id_konten = '".$id_konten."'");
        $total_notif = $this->total_notif();
        $list_notif_display = $this->list_notif_display();
        $notif_pesan = $this->notif_pesan();
        $notif_group = $this->notif_group();
        $likes = DB::select("SELECT * FROM likes JOIN pengguna ON likes.id_pengguna = pengguna.id_pengguna WHERE likes.id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND id_konten = '".$id_konten."' LIMIT 1");
        $likes_all = DB::select("SELECT * FROM likes JOIN pengguna ON likes.id_pengguna = pengguna.id_pengguna WHERE id_konten = '".$id_konten."'");
        $likes_me = DB::select("SELECT * FROM likes WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND id_konten = '".$id_konten."'");
        $jml_konten = DB::select("SELECT COUNT(id_pengguna) AS jml_konten FROM konten WHERE id_group = 0 AND id_pengguna = (SELECT id_pengguna FROM pengguna WHERE username = '".Auth::user()->pengguna->username."')");
        $teman = DB::select("SELECT * FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna='".Auth::user()->pengguna->id_pengguna."')");
        if ($teman == null) {
            $rekomendasi = DB::select("SELECT * FROM pengguna WHERE id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND jenis_akun = 'desa' ORDER BY RAND() LIMIT 2");
            $rekomendasi_teman = DB::select("SELECT * FROM pengguna WHERE id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND jenis_akun = 'pribadi' ORDER BY RAND() LIMIT 2");
        } else {
            $rekomendasi = DB::select("SELECT * FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."')) AND id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND id_pengguna NOT IN (SELECT id_pengguna FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."')) AND jenis_akun = 'desa' ORDER BY RAND() LIMIT 2");
            if($rekomendasi == null){
                $rekomendasi = DB::select("SELECT * FROM pengguna WHERE id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND id_pengguna NOT IN (SELECT id_pengguna FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."')) AND jenis_akun = 'desa' ORDER BY RAND() LIMIT 2");
            }
            $rekomendasi_teman = DB::select("SELECT * FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."')) AND id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND id_pengguna NOT IN (SELECT id_pengguna FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."')) AND jenis_akun = 'pribadi' ORDER BY RAND() LIMIT 2");
            if($rekomendasi_teman == null){
               $rekomendasi_teman = DB::select("SELECT * FROM pengguna WHERE id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND id_pengguna NOT IN (SELECT id_following FROM following WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND jenis_akun = 'pribadi' ORDER BY RAND() LIMIT 2");
            }
        }
        $data_likes_total = DB::select("SELECT COUNT(likes.id) AS jml_likes FROM likes WHERE id_konten IN (SELECT id_konten FROM konten WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."')"); 
        $data_likes_week = DB::select("SELECT COUNT(likes.id) AS jml_likes FROM likes WHERE id_konten IN (SELECT id_konten FROM konten WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND tanggal_like > (now() - INTERVAL 7 day)");
        $data_followers_total = DB::select("SELECT COUNT(followers.id) AS jml FROM followers WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."'"); 
        $data_followers_week = DB::select("SELECT COUNT(followers.id) AS jml FROM followers JOIN notif ON followers.id = notif.id_followers WHERE followers.id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND notif.created_at > (now() - INTERVAL 7 day)");
        $list_all_group = DB::select("SELECT * FROM grup");
        if($konten){
            return view('halaman_konten_detail', compact('konten', 'komentar', 'jml_komentar', 'balas_komentar', 'total_notif', 'list_notif_display', 'notif_pesan', 'notif_group', 'likes', 'likes_all', 'jml_konten', 'teman', 'rekomendasi', 'rekomendasi_teman', 'data_likes_week', 'data_likes_total', 'data_followers_week', 'data_followers_total', 'list_all_group'));
        }else{
            return redirect('/sosial-media/beranda');
        }
    }

    public function konten_detail_by_slug($slug){
        $total_notif = null;
        $list_notif_display = null;
        $notif_pesan = null;
        $notif_group = null;
        $jml_konten = null;
        $teman = null;
        $rekomendasi = null;
        $rekomendasi_teman = null;
        $data_likes_week = null;
        $data_likes_total = null;
        $data_followers_week = null;
        $data_followers_total = null;
        $likes = null;
        $data = DB::select("SELECT * FROM konten JOIN pengguna ON konten.id_pengguna = pengguna.id_pengguna JOIN pengaturan ON pengguna.id_pengguna = pengaturan.id_pengguna WHERE konten.slug = '".$slug."'");
        if($data){
            foreach ($data as $k){
                $akun_privat = $k->akun_privat;
                $username = $k->username;
            }
            
            if($akun_privat == 'iya'){
                return redirect('/sosial-media/profil/'.$username);
            }else{
                $konten = DB::select("SELECT * FROM konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna WHERE konten.slug = '".$slug."'");
                $komentar = DB::select("SELECT comment.*, comment.id AS id_cmt, p.* FROM konten JOIN comment ON konten.id_konten=comment.id_konten JOIN pengguna p2 ON konten.id_pengguna=p2.id_pengguna JOIN pengguna p ON comment.id_pengguna = p.id_pengguna WHERE konten.slug = '".$slug."'");
                $jml_komentar = DB::select("SELECT COUNT(comment.id) AS jumlah, comment.id_konten FROM konten JOIN comment ON konten.id_konten=comment.id_konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna WHERE konten.slug = '".$slug."' GROUP BY comment.id_konten");
                $balas_komentar = DB::select("SELECT comment.*, comment.id AS id_cmt, pengguna.* FROM konten JOIN comment ON konten.id_konten=comment.id_konten JOIN pengguna ON comment.id_pengguna=pengguna.id_pengguna WHERE konten.slug = '".$slug."'");
                if(Auth::check()){
                    $konten = DB::select("SELECT *, (SELECT IF(COUNT(*) > 0, true, false) FROM likes WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND likes.id_konten = konten.id_konten) AS is_like FROM konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna WHERE konten.slug = '".$slug."'");
                    $total_notif = $this->total_notif();
                    $list_notif_display = $this->list_notif_display();
                    $notif_pesan = $this->notif_pesan();
                    $notif_group = $this->notif_group();
                    $likes = DB::select("SELECT * FROM likes JOIN pengguna ON likes.id_pengguna = pengguna.id_pengguna WHERE likes.id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND id_konten = (SELECT id_konten FROM konten WHERE slug = '".$slug."') LIMIT 1");
                    $likes_me = DB::select("SELECT * FROM likes WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND id_konten = (SELECT id_konten FROM konten WHERE slug = '".$slug."')");
                    $jml_konten = DB::select("SELECT COUNT(id_pengguna) AS jml_konten FROM konten WHERE id_group = 0 AND id_pengguna = (SELECT id_pengguna FROM pengguna WHERE username = '".Auth::user()->pengguna->username."')");
                    $teman = DB::select("SELECT * FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna='".Auth::user()->pengguna->id_pengguna."')");
                    if ($teman == null) {
                        $rekomendasi = DB::select("SELECT * FROM pengguna WHERE id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND jenis_akun = 'desa' ORDER BY RAND() LIMIT 2");
                        $rekomendasi_teman = DB::select("SELECT * FROM pengguna WHERE id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND jenis_akun = 'pribadi' ORDER BY RAND() LIMIT 2");
                    } else {
                        $rekomendasi = DB::select("SELECT * FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."')) AND id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND id_pengguna NOT IN (SELECT id_pengguna FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."')) AND jenis_akun = 'desa' ORDER BY RAND() LIMIT 2");
                        if($rekomendasi == null){
                            $rekomendasi = DB::select("SELECT * FROM pengguna WHERE id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND id_pengguna NOT IN (SELECT id_pengguna FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."')) AND jenis_akun = 'desa' ORDER BY RAND() LIMIT 2");
                        }
                        $rekomendasi_teman = DB::select("SELECT * FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."')) AND id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND id_pengguna NOT IN (SELECT id_pengguna FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."')) AND jenis_akun = 'pribadi' ORDER BY RAND() LIMIT 2");
                        if($rekomendasi_teman == null){
                            $rekomendasi_teman = DB::select("SELECT * FROM pengguna WHERE id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND id_pengguna NOT IN (SELECT id_following FROM following WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND jenis_akun = 'pribadi' ORDER BY RAND() LIMIT 2");
                        }
                    }
                    $data_likes_total = DB::select("SELECT COUNT(likes.id) AS jml_likes FROM likes WHERE id_konten IN (SELECT id_konten FROM konten WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."')"); 
                    $data_likes_week = DB::select("SELECT COUNT(likes.id) AS jml_likes FROM likes WHERE id_konten IN (SELECT id_konten FROM konten WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND tanggal_like > (now() - INTERVAL 7 day)");
                    $data_followers_total = DB::select("SELECT COUNT(followers.id) AS jml FROM followers WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."'"); 
                    $data_followers_week = DB::select("SELECT COUNT(followers.id) AS jml FROM followers JOIN notif ON followers.id = notif.id_followers WHERE followers.id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND notif.created_at > (now() - INTERVAL 7 day)");
                }
                $likes_all = DB::select("SELECT * FROM likes JOIN pengguna ON likes.id_pengguna = pengguna.id_pengguna WHERE id_konten = (SELECT id_konten FROM konten WHERE slug = '".$slug."')");
                $list_all_group = DB::select("SELECT * FROM grup");
                return view('halaman_konten_detail', compact('konten', 'komentar', 'jml_komentar', 'balas_komentar', 'total_notif', 'list_notif_display', 'notif_pesan', 'notif_group', 'likes', 'likes_all', 'jml_konten', 'teman', 'rekomendasi', 'rekomendasi_teman', 'data_likes_week', 'data_likes_total', 'data_followers_week', 'data_followers_total', 'list_all_group'));
            }
        }else{
            return redirect('/sosial-media/beranda');
        }
        
    }

    public function konten_group_detail_by_slug($slug){
        $cek = File_Gambar::where('slug', $slug)->where('is_active', 1)->first();
        if($cek){
            $konten = DB::select("SELECT * FROM konten JOIN pengguna ON konten.id_pengguna = pengguna.id_pengguna JOIN grup ON konten.id_group = grup.id_group WHERE konten.slug = '".$slug."'");
            $komentar = DB::select("SELECT comment.*, comment.id AS id_cmt, p.* FROM konten JOIN comment ON konten.id_konten=comment.id_konten JOIN pengguna p2 ON konten.id_pengguna=p2.id_pengguna JOIN pengguna p ON comment.id_pengguna = p.id_pengguna WHERE konten.slug = '".$slug."'");
            $jml_komentar = DB::select("SELECT COUNT(comment.id) AS jumlah, comment.id_konten FROM konten JOIN comment ON konten.id_konten=comment.id_konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna WHERE konten.slug = '".$slug."' GROUP BY comment.id_konten");
            $balas_komentar = DB::select("SELECT comment.*, comment.id AS id_cmt, pengguna.* FROM konten JOIN comment ON konten.id_konten=comment.id_konten JOIN pengguna ON comment.id_pengguna=pengguna.id_pengguna WHERE konten.slug = '".$slug."'");
            $total_notif = null;
            $list_notif_display = null;
            $notif_pesan = null;
            $notif_group = null;
            $likes = null;
            $teman = null;
            if(Auth::check()){
                $konten = DB::select("SELECT *, (SELECT IF(COUNT(*) > 0, true, false) FROM likes WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND likes.id_konten = konten.id_konten) AS is_like FROM konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna WHERE konten.slug = '".$slug."'");
                $total_notif = $this->total_notif();
                $list_notif_display = $this->list_notif_display();
                $notif_pesan = $this->notif_pesan();
                $notif_group = $this->notif_group();
                $likes = DB::select("SELECT * FROM likes JOIN pengguna ON likes.id_pengguna = pengguna.id_pengguna WHERE id_konten = (SELECT id_konten FROM konten WHERE slug = '".$slug."') LIMIT 1");
                // $likes_me = DB::select("SELECT * FROM likes WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND id_konten = (SELECT id_konten FROM konten WHERE slug = '".$slug."')");
                $teman = DB::select("SELECT * FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna='".Auth::user()->pengguna->id_pengguna."')");
            }
            $likes_all = DB::select("SELECT * FROM likes JOIN pengguna ON likes.id_pengguna = pengguna.id_pengguna WHERE id_konten = (SELECT id_konten FROM konten WHERE slug = '".$slug."')");
            $list_group_user = null;
            $jml_anggota = null;
            if(Auth::check()){
                $list_group_user = DB::select("SELECT * FROM grup JOIN anggota_grup ON grup.id_group = anggota_grup.id_group WHERE anggota_grup.id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
                if($list_group_user){
                $arr = array();
                foreach($list_group_user as $row){
                    $arr[] = $row->id_group;
                }
                $id_group_user = implode(",", $arr);
                // dd($id_group_user);
                $jml_anggota = DB::select("SELECT id_group, COUNT(id_anggota) AS jml_anggota FROM anggota_grup WHERE anggota_grup.id_group IN ($id_group_user) GROUP BY id_group");
            }
            }
            $list_group = DB::select("SELECT *, p2.nama AS nama_admin, p.nama as nama_anggota FROM pengguna p2 JOIN grup g ON p2.id_pengguna = g.admin JOIN anggota_grup gp ON g.id_group = gp.id_group JOIN pengguna p ON gp.id_pengguna = p.id_pengguna WHERE gp.id_group = (SELECT id_group FROM konten WHERE slug = '".$slug."')");
            foreach($list_group as $row){
                $id_group = $row->id_group;
            }
            $data_anggota = DB::select("SELECT id_group, COUNT(id_anggota) AS jml_anggota FROM anggota_grup WHERE anggota_grup.id_group IN ('".$id_group."') GROUP BY id_group");
            $kueri = DB::select("SELECT * FROM grup WHERE id_group = '".$id_group."'");
            $list_admin = DB::select("SELECT * FROM grup JOIN admin_grup ON admin_grup.id_group = grup.id_group JOIN pengguna ON admin_grup.id_admin = pengguna.id_pengguna WHERE admin_grup.id_group = '".$id_group."'");
            return view('halaman_konten_group_detail', compact('konten', 'komentar', 'jml_komentar', 'balas_komentar', 'total_notif', 'list_notif_display', 'notif_pesan', 'notif_group', 'likes', 'likes_all', 'list_group', 'list_group_user', 'data_anggota', 'jml_anggota', 'kueri', 'list_admin', 'teman'));
        }else{
            return redirect('/sosial-media/beranda');
        }
        
    }

    public function get_konten_lokasi($tempat){
        $tempat = $tempat;
        $teman = DB::select("SELECT * FROM pengguna WHERE id_pengguna IN (SELECT id_following FROM following WHERE id_pengguna='".Auth::user()->pengguna->id_pengguna."')");
        $konten = DB::select("SELECT *, (SELECT IF(COUNT(*) > 0, true, false) FROM likes WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND likes.id_konten = konten.id_konten) AS is_like FROM konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna JOIN pengaturan ON pengaturan.id_pengguna = pengguna.id_pengguna WHERE konten.is_active = 1 AND konten.id_group = 0 AND pengaturan.akun_privat = 'tidak' AND konten.tempat = '".$tempat."' ORDER BY konten.created_at DESC");
        $komentar = DB::select("SELECT comment.*, comment.id AS id_cmt, p.* FROM konten JOIN comment ON konten.id_konten=comment.id_konten JOIN pengguna p2 ON konten.id_pengguna=p2.id_pengguna JOIN pengguna p ON comment.id_pengguna = p.id_pengguna JOIN pengaturan ON pengaturan.id_pengguna = p2.id_pengguna WHERE konten.is_active = 1 AND konten.id_group = 0 AND konten.id_konten IN (SELECT id_konten FROM konten WHERE tempat = '".$tempat."') AND pengaturan.akun_privat = 'tidak'");
        // $jml_komentar = DB::select("SELECT COUNT(comment.id) AS jumlah, comment.id_konten FROM konten JOIN comment ON konten.id_konten=comment.id_konten JOIN pengguna ON konten.id_pengguna=pengguna.id_pengguna JOIN pengaturan ON pengaturan.id_pengguna = pengguna.id_pengguna WHERE konten.id_group = 0 AND konten.id_konten IN (SELECT id_konten FROM konten WHERE tempat = '".$tempat."') GROUP BY comment.id_konten");
        $balas_komentar = DB::select("SELECT comment.*, comment.id AS id_cmt, pengguna.* FROM konten JOIN comment ON konten.id_konten=comment.id_konten JOIN pengguna ON comment.id_pengguna=pengguna.id_pengguna JOIN pengaturan ON pengaturan.id_pengguna = pengguna.id_pengguna WHERE konten.is_active = 1 AND konten.id_group = 0 AND konten.id_konten IN (SELECT id_konten FROM konten WHERE tempat = '".$tempat."')");
        $total_notif = $this->total_notif();
        $list_notif_display = $this->list_notif_display();
        $notif_pesan = $this->notif_pesan();
        $notif_group = $this->notif_group();
        $likes = DB::select("SELECT * FROM likes JOIN pengguna ON likes.id_pengguna = pengguna.id_pengguna JOIN pengaturan ON pengaturan.id_pengguna = pengguna.id_pengguna WHERE id_konten IN (SELECT id_konten FROM konten WHERE is_active = 1 AND tempat = '".$tempat."') AND pengaturan.akun_privat = 'tidak'");
        $likes_all = DB::select("SELECT * FROM likes JOIN pengguna ON likes.id_pengguna = pengguna.id_pengguna WHERE id_konten IN (SELECT id_konten FROM konten WHERE is_active = 1 AND tempat = '".$tempat."')");
        $likes_me = DB::select("SELECT * FROM likes WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND id_konten IN (SELECT id_konten FROM konten WHERE is_active = 1 AND tempat = '".$tempat."')");
        return view('halaman_konten_perlokasi', compact('konten', 'komentar', 'balas_komentar', 'total_notif', 'list_notif_display', 'notif_pesan', 'notif_group', 'likes', 'likes_all', 'tempat', 'teman'));
    }

    public function ubah_foto_sampul(Request $request){
        if($request->hasFile('foto_sampul')){
            $file = $request->file('foto_sampul');
            $nama_file = $file->getClientOriginalName();

            $nama_folder = 'data_file/'.Auth::user()->pengguna->username.'/foto_sampul';
            $tujuan_upload = $nama_folder;
            $file->move($tujuan_upload,$nama_file);
            DB::table('pengguna')->where('id_pengguna', $request->id_pengguna)->update([
                    'foto_sampul'=>$nama_file
                ]);
        }else if($request->hasFile('gambar')){
            $file_sampul = $request->file('gambar');
            $nama_file_sampul = $file_sampul->getClientOriginalName();

            $nama_folder = 'data_file/group/'.$request->nama_group.'/foto_sampul';
            $tujuan_upload_sampul = $nama_folder;
            $file_sampul->move($tujuan_upload_sampul,$nama_file_sampul);
            DB::table('grup')->where('id_group', $request->id_group)->update([
                    'foto_sampul_group'=>$nama_file_sampul
                ]);
        }
        // return redirect()->back();
    }

    public function ubah_foto_profil(Request $request){
        if($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $nama_file = $file->getClientOriginalName();

            $nama_folder = 'data_file/'.Auth::user()->pengguna->username.'/foto_profil';
            $tujuan_upload = $nama_folder;
            $file->move($tujuan_upload,$nama_file);
            DB::table('pengguna')->where('id_pengguna', $request->id_pengguna)->update([
                    'foto_profil'=>$nama_file
                ]);
            // Session::put('foto_profil',url('/data_file/foto_profil/'.$nama_file));
        }
        // return redirect()->back();
    }

    public function hapus_chat($id_chat){
        $row = DB::table('chat')->where('id_chat', $id_chat)->first();
        if($row->media != null){
            //HAPUS FILE DI DALAM FOLDER
            File::delete(public_path('data_file/chat/'.$row->id_room_chat.'/'.date("d-m-Y", strtotime($row->tanggal_chat)).'/'.$row->media));
        }
        DB::table('chat')->where('id_chat', $id_chat)->delete();
        $data_chat = DB::select("SELECT chat.*, p.username AS username_penerima, p2.username AS username_pengirim FROM chat JOIN pengguna p ON chat.id_penerima = p.id_pengguna JOIN pengguna p2 ON chat.id_pengirim = p2.id_pengguna WHERE chat.id_room_chat = '".$row->id_room_chat."' ORDER BY tanggal_chat DESC LIMIT 1");
        return response()->json($data_chat);
    }

    public function hapus_room_chat($id_room_chat){
        //HAPUS FOLDER ROOM CHAT
        File::deleteDirectory(public_path('data_file/chat/'.$id_room_chat));
        DB::table('chat')->where('id_room_chat', $id_room_chat)->delete();
    }
  
}
