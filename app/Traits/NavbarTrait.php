<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

trait NavbarTrait {
  public static function total_notif(){
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

  public static function list_notif_display(){
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

  public static function notif_pesan(){
    $data_notif = DB::select("SELECT * FROM pengaturan WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."'");
    foreach ($data_notif as $row) {
        $pilihan_notif_pesan    = $row->notifikasi_pesan;
    }

    if($pilihan_notif_pesan == 'dari semua orang'){
        return $notif_pesan = DB::select("SELECT COUNT(id_chat) AS jml FROM chat WHERE id_penerima = '".Auth::user()->pengguna->id_pengguna."' AND status = 'Belum Dibaca'");
    }
    // return $notif_pesan = DB::select("SELECT COUNT(id_chat) AS jml FROM chat WHERE id_penerima = '".Auth::user()->pengguna->id_pengguna."' AND status = 'Belum Dibaca'");
  }

  public static function notif_group(){
    return $notif_group = DB::select("SELECT grup.id_group, COUNT(konten.id_konten) AS jml FROM konten JOIN grup ON konten.id_group = grup.id_group JOIN anggota_grup ON grup.id_group = anggota_grup.id_group JOIN notif ON konten.id_konten = notif.id_konten WHERE anggota_grup.id_pengguna = '".Auth::user()->pengguna->id_pengguna."' AND konten.id_pengguna != '".Auth::user()->pengguna->id_pengguna."' AND notif.id_anggota IN (SELECT id_anggota FROM anggota_grup WHERE id_pengguna = '".Auth::user()->pengguna->id_pengguna."') AND notif.status = 'Belum Dibaca' GROUP BY grup.id_group");
  }
}