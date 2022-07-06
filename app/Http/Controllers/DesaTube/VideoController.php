<?php

namespace App\Http\Controllers\DesaTube;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\VideoDetail;
use App\Models\VideoView;
use App\Traits\NavbarTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
            $videos = Video::where('title', 'LIKE', "%$search%")->with(['pengguna','detail'])->paginate(10);
        }else{
            $videos = Video::with(['pengguna','detail'])->paginate(10);            
        }
        // dd(is_null($videos[2]->detail));
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
    public function show(Request $request, $id)
    {
        $total_notif = NavbarTrait::total_notif();
        $list_notif_display = NavbarTrait::list_notif_display();
        $notif_pesan = NavbarTrait::notif_pesan();
        $notif_group = NavbarTrait::notif_group();
        $video = Video::where('id', $id)->with('detail')->first();
        $videos = Video::with('pengguna')->limit(5)->orderBy('created_at', 'DESC')->get();
        $detail = VideoDetail::where('id_video', $id)->first();
        if ($detail) {
            $views = VideoView::where('id_video', $id)->whereDate('created_at', Carbon::today())->first();
            if(!$views){
                $views = $detail->views;
                $detail->views = $views+1;
                $detail->save();

                $data_view = [
                    'id_video' => $video->id,
                    'id_user' => Auth::user()->id,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent()
                ];
                VideoView::create($data_view);
            }
        }else{
            $data = [
                'id_video' => $video->id,
                'id_user' => Auth::user()->id,
                'views' => 1
            ];
            $data_view = [
                'id_video' => $video->id,
                'id_user' => Auth::user()->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ];
            VideoDetail::create($data);
            VideoView::create($data_view);
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
