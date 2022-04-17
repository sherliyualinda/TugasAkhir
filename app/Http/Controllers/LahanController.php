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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class LahanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     *
     */
    protected $guarded=[];
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
       return view('lahan');
    }

    public function create(){
        //$data['categori']= "select * from category_lahan";
        $categori=category_lahan::all();
        return view('create_lahan',[
            'categori' => $categori,
        ]);
    }

    public function simpan(Request $request){
        // lahan::create([
        //     'category_lahan_id'=>$request->category_lahan_id,
        //     'ukuran'=>$request->ukuran,
        //     'deskripsi'=>$request->deskripsi,
        //     //'gambar'=>$request->gambar
        // ]);
        dd($request->all());
    }
    
}

