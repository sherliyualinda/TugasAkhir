<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\lahan;

class LahanController extends Controller
{
    public function index()
    {
        $lahans = lahan::where('statusLahan', 'Waiting')->with('category')->get();
        return view('pages.adminstore.lahan.index', compact('lahans'));
    }
    
    public function show($id)
    {
        $lahan = lahan::where('id', $id)->with('category','user')->first();
        return view('pages.adminstore.lahan.show', compact('lahan'));
    }
    
    public function approval(Request $request, $id)
    {
        $lahan = lahan::where('id', $id)->first();
        if ($request->post('approve')) {
            $lahan->statusLahan = 'Ready';
            $lahan->save();
            return redirect('dashboard/lahan-pending');
        }elseif ($request->post('reject')) {
            $lahan->statusLahan = 'Reject';
            $lahan->save();
            return redirect('dashboard/lahan-pending');
        }
    }
}
