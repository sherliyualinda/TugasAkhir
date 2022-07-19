<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use App\Category;
use App\Pengguna;
use App\Models\Regency;
use App\Models\Village;
use App\Traits\NavbarTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Image;

class StoreController extends Controller
{
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // $store = User::whereNotNull('store_name');
        // dd($store);
       
            if($request->villages_id){
                
                $store = User::where('villages_id',$request->villages_id)->get();
                 
            }elseif($request->districts_id){
                

                $store = User::where('districts_id',$request->districts_id)->get();

            }elseif($request->regencies_id){
           

                $store = User::where('regencies_id',$request->regencies_id)->get();

            }elseif($request->provinces_id){
               

               $store = User::where('provinces_id',$request->provinces_id)->get();
                
            }else{
                $store = '';
            }
            
            
            // $store = User::whereNotNull('store_name')->get();


        // $store = User::where('villages_id',$request->villages_id)->get();
        $total_notif = NavbarTrait::total_notif();
        $list_notif_display = NavbarTrait::list_notif_display();
        $notif_pesan = NavbarTrait::notif_pesan();
        $notif_group = NavbarTrait::notif_group();
        return view('pages.search-store',compact('store','total_notif' ,'list_notif_display', 'notif_pesan', 'notif_group'));
    }

     public function area(Request $request, $id)
    {   
       $villages = Village::find($id);
       $categories = Category::take(6)->get();
       $total_notif = NavbarTrait::total_notif();
       $list_notif_display = NavbarTrait::list_notif_display();
       $notif_pesan = NavbarTrait::notif_pesan();
       $notif_group = NavbarTrait::notif_group();
       $products = Product::with(['user'])
        ->whereHas('user', function($q) use($id) {
                    $q->where('villages_id', '=', $id); 
                    })->get();

        if ($products) {
             return view('pages.home-store-area',compact('products','villages','categories','total_notif' ,'list_notif_display', 'notif_pesan', 'notif_group'));
        }else{
            return 'belum ada produk';
        }
       
       
    }

    public function detail(Request $request, $id){
        $total_notif = NavbarTrait::total_notif();
       $list_notif_display = NavbarTrait::list_notif_display();
       $notif_pesan = NavbarTrait::notif_pesan();
       $notif_group = NavbarTrait::notif_group();
       $user = User::find($id);

      $products = Product::with(['galleries'])->where('users_id',$id);
        //dd($user);

       
        return view('pages.detail-store',[
            'user' => $user,
            'products_data' => $products->get(),
            'products_count' => $products->count(),
            'total_notif' => $total_notif,
            'notif_pesan' => $notif_pesan,
            'list_notif_display' => $list_notif_display,
            'notif_grup' => $notif_group
        ]);
    }

    public function storePending()
    {
        $pengguna = Pengguna::where('status_pengajuan_store', 'PENDING')->where('village_id', Auth::user()->pengguna->village_id)->get();
        return view('pages.adminstore.store.index',compact('pengguna'));
    }

    public function storeDetail($id)
    {
        $pengguna = Pengguna::where('id_pengguna', $id)->first();
        return view('pages.adminstore.store.show',compact('pengguna'));
    } 

    public function storeApprove(Request $request, $id)
    {
        $item = Pengguna::findOrfail($id);
        $item->status_pengajuan_store = 'APPROVE';
        $item->save();

        return redirect()->route('dashboard.store-pending-show', $id);
    }

    public function create()
    {
        $total_notif = NavbarTrait::total_notif();
        $list_notif_display = NavbarTrait::list_notif_display();
        $notif_pesan = NavbarTrait::notif_pesan();
        $notif_group = NavbarTrait::notif_group();
        $pengguna = Pengguna::where('id_pengguna', Auth::user()->pengguna->id_pengguna)->first();
        $products = Product::where('users_id', Auth::user()->id)->get();
        $product_count = count($products);
        if($pengguna->status_pengajuan_store){
            return view('pages.create-store', compact('pengguna', 'products', 'product_count', 'total_notif' ,'list_notif_display', 'notif_pesan', 'notif_group'));
        }else {
            return view('pages.submission-store', compact('pengguna', 'total_notif' ,'list_notif_display', 'notif_pesan', 'notif_group'));
        }
    }

    public function mystore()
    {
        $total_notif = NavbarTrait::total_notif();
        $list_notif_display = NavbarTrait::list_notif_display();
        $notif_pesan = NavbarTrait::notif_pesan();
        $notif_group = NavbarTrait::notif_group();
        $pengguna = Pengguna::where('id_pengguna', Auth::user()->pengguna->id_pengguna)->first();
        $products = Product::where('users_id', Auth::user()->id)->get();
        $product_count = count($products);
        if($pengguna->status_pengajuan_store){
            return view('pages.create-store', compact('pengguna', 'products', 'product_count', 'total_notif' ,'list_notif_display', 'notif_pesan', 'notif_group'));
        }else {
            return view('pages.submission-store', compact('pengguna', 'total_notif' ,'list_notif_display', 'notif_pesan', 'notif_group'));
        }
    }

    public function sendSubmissionStore(Request $request, $id)
    {
        $this->validate($request, [
            'foto_ktp'  => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama'  => 'required',
            'email'  => 'required',
            'nik'  => 'required',
            'nomor_hp'  => 'required',
            'pekerjaan'  => 'required',
            'alamat'  => 'required',
            ]);

            try {
                $pengguna = Pengguna::where('id_pengguna', $id)->first();
                $pengguna->nama  = $request->post('nama');
                $pengguna->email  = $request->post('email');
                $pengguna->nik  = $request->post('nik');
                $pengguna->nomor_hp  = $request->post('nomor_hp');
                $pengguna->pekerjaan  = $request->post('pekerjaan');
                $pengguna->alamat  = $request->post('alamat');
                $pengguna->bio  = $request->post('bio');
                $pengguna->website  = $request->post('website');
                $pengguna->youtube  = $request->post('youtube');
                $pengguna->marketplace  = $request->post('marketplace');
                $pengguna->berita  = $request->post('berita');
                $pengguna->musrembang  = $request->post('musrembang');
                $pengguna->status_pengajuan_store  = 'PENDING';

                $uniqueName = time()."-".date('dmY'); // For unique naming

                if($request->file('foto_ktp')){
                    $foto_ktp = $request->file('foto_ktp');
                    // Upload foto_ktp
                    $destinationPath = 'foto_ktp';
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 666, true);
                    }
                    $fileNameKTP = $uniqueName."-foto_ktp".'.'.$foto_ktp->getClientOriginalExtension();
                    $resize_image_ktp = Image::make($foto_ktp->getRealPath());

                    $resize_image_ktp->resize(700, null, function($constraint){
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $fileNameKTP);
                    $pengguna->foto_ktp = '/'.$destinationPath.'/'.$fileNameKTP;
                }
                
                if($request->file('foto_profil')){
                    $foto_profil = $request->file('foto_profil');
                    // Upload foto_profil
                    $destinationPathProfile = 'data_file/'.$pengguna->username.'/foto_profil';;
                    if (!file_exists($destinationPathProfile)) {
                        mkdir($destinationPathProfile, 666, true);
                    }
                    $fileNameSampul = $uniqueName."-foto_profil".'.'.$foto_profil->getClientOriginalExtension();
                    $resize_image_ktp = Image::make($foto_profil->getRealPath());

                    $resize_image_ktp->resize(700, null, function($constraint){
                        $constraint->aspectRatio();
                    })->save($destinationPathProfile . '/' . $fileNameSampul);
                    $pengguna->foto_profil = $fileNameSampul;
                }
                
                if($request->file('foto_sampul')){
                    $foto_sampul = $request->file('foto_sampul');
                    // Upload foto_sampul
                    $destinationPathSampul = 'data_file/'.$pengguna->username.'/foto_sampul';;
                    if (!file_exists($destinationPathSampul)) {
                        mkdir($destinationPathSampul, 666, true);
                    }
                    $fileNameSampul = $uniqueName."-foto_sampul".'.'.$foto_sampul->getClientOriginalExtension();
                    $resize_image_ktp = Image::make($foto_sampul->getRealPath());

                    $resize_image_ktp->resize(700, null, function($constraint){
                        $constraint->aspectRatio();
                    })->save($destinationPathSampul . '/' . $fileNameSampul);
                    $pengguna->foto_sampul = $fileNameSampul;
                }

                $pengguna->save();                

                return redirect()->route('my-store');
            } catch (\Throwable $th) {
                //throw $th;
                // dd($th->getMessage());
                return redirect()->route('my-store');
            }
    }
}


