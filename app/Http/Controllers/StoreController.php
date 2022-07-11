<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use App\Category;
use App\Pengguna;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
       

        return view('pages.search-store',compact('store'));
    }

     public function area(Request $request, $id)
    {   
       $villages = Village::find($id);
       $categories = Category::take(6)->get();

       $products = Product::with(['user'])
        ->whereHas('user', function($q) use($id) {
                    $q->where('villages_id', '=', $id); 
                    })->get();

        if ($products) {
             return view('pages.home-store-area',compact('products','villages','categories'));
        }else{
            return 'belum ada produk';
        }
       
       
    }

    public function detail(Request $request, $id){

       $user = User::find($id);

      $products = Product::with(['galleries'])->where('users_id',$id);
        //dd($user);

       
        return view('pages.detail-store',[
            'user' => $user,
            'products_data' => $products->get(),
            'products_count' => $products->count(),
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
        return view('pages.create-store');
    }
}


