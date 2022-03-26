<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelUser;
use App\Report;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\File_Gambar;
use File;
use Auth;

class Report_Con extends Controller{
    function insert_report(Request $request){
        $tgl = Carbon::now();
        $kategori = $request->kategori_report;
        if($kategori == 'Konten'){
            Report::create([
                'kategori_report'       => $kategori,
                'account_reporter'      => $request->acct_reporter,
                'alasan_report'         => $request->alasan_report,
                'id_konten_reported'    => $request->id_reported,
                // 'status'                => 'Waiting'
            ]);
        }else{
            Report::create([
                'kategori_report'       => $kategori,
                'account_reporter'      => $request->acct_reporter,
                'alasan_report'         => $request->alasan_report,
                'id_comment_reported'    => $request->id_reported,
                // 'status'                => 'Waiting'
            ]);
        }

        return redirect()->back()->with('success', $kategori.' Berhasil Direport!');
    }
}
