<?php

namespace App\Http\Controllers\DesaTube;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\VideoDetail;
use App\Traits\NavbarTrait;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $total_notif = NavbarTrait::total_notif();
        $list_notif_display = NavbarTrait::list_notif_display();
        $notif_pesan = NavbarTrait::notif_pesan();
        $notif_group = NavbarTrait::notif_group();
        $search = $request->get('search');
        if($search){
            $videos = Video::where('title', 'LIKE', "%$search%")->with('pengguna')->paginate(10);
        }else{
            $videos = Video::with('pengguna')->paginate(10);            
        }
        return view('pages.desatube.index', compact('videos', 'total_notif' ,'list_notif_display', 'notif_pesan', 'notif_group'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $total_notif = NavbarTrait::total_notif();
        $list_notif_display = NavbarTrait::list_notif_display();
        $notif_pesan = NavbarTrait::notif_pesan();
        $notif_group = NavbarTrait::notif_group();
        $video = Video::find($id)->with('detail')->first();
        $videos = Video::with('pengguna')->limit(5)->orderBy('created_at', 'DESC')->get();
        $detail = VideoDetail::where('video_id', $id)->first();
        if ($detail) {
            $views = $detail->views;
            $detail->views = $views+1;
            $detail->save();
        }else{
            $data = [
                'video_id' => $video->id,
                'views' => 1
            ];
            VideoDetail::create($data);
        }
        // dd($video);
        return view('pages.desatube.detail', compact('video', 'videos', 'total_notif' ,'list_notif_display', 'notif_pesan', 'notif_group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
