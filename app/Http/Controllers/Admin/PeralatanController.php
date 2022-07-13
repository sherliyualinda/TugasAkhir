<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Peralatan;

class PeralatanController extends Controller
{
    public function index()
    {
        $peralatans = Peralatan::where('status', 'Waiting')->with('pengguna')->get();
        return view('pages.adminstore.peralatan.index', compact('peralatans'));
    }
    
    public function show($id)
    {
        $peralatan = Peralatan::where('id_peralatan', $id)->with('pengguna')->first();
        return view('pages.adminstore.peralatan.show', compact('peralatan'));
    }
    
    public function approval(Request $request, $id)
    {
        $peralatan = Peralatan::where('id_peralatan', $id)->first();
        if ($request->post('approve')) {
            $peralatan->status = 'Ready';
            $peralatan->save();
            return redirect('dashboard/peralatan/pending');
        }elseif ($request->post('reject')) {
            $peralatan->status = 'Reject';
            $peralatan->save();
            return redirect('dashboard/peralatan/pending');
        }
    }
}
