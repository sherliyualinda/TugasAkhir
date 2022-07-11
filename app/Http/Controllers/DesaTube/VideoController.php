<?php

namespace App\Http\Controllers\DesaTube;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\VideoDetail;
use App\Models\VideoView;
use App\Models\VideoLike;
use App\Models\VideoComment;
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
            $videos = Video::where('title', 'LIKE', "%$search%")->with(['user','detail'])->paginate(10);
        }else{
            $videos = Video::with(['user','detail'])->paginate(10);            
        }
        // dd($videos);
        return view('pages.desatube.index', compact('videos', 'total_notif' ,'list_notif_display', 'notif_pesan', 'notif_group'));
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
        $videos = Video::with('user')->limit(5)->orderBy('created_at', 'DESC')->get();
        $detail = VideoDetail::where('id_video', $id)->first();
        $videoLike = VideoLike::where('id_video', $id)->first();
        $comments = VideoComment::where('id_video', $id)->get();
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
        return view('pages.desatube.detail', compact('video','videos','videoLike','comments','total_notif' ,'list_notif_display', 'notif_pesan', 'notif_group'));
    }

    public function like(Request $request, $id, $type)
    {
        $detail = VideoDetail::where('id_video', $id)->first();
        $videoLike = VideoLike::where('id_video', $id)->first();
        if ($videoLike) {
            $videoLike->delete();

            $like = $detail->$type;
            $detail->$type = $like-1;
            $detail->save();
            return response()->json(['message'=> 'data deleted'], 200);
        }else{
            if($detail){
                $data = [
                    'id_video' => $id,
                    'id_user' => Auth::user()->id,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'type' => $type,
                    'created_at' => Carbon::now()
                ];
                VideoLike::insert($data);
                $like = $detail->$type;
                $detail->$type = $like+1;
                $detail->save();
                $data['message'] = 'success';
            }
            return response()->json($data, 200);
        }
    }

    public function comment(Request $request)
    {
        $detail = VideoDetail::where('id_video', $request->post('id_video'))->first();
        $request->request->add(['id_user' => Auth::user()->id]);
        VideoComment::create($request->all());

        return redirect()->back()->with('success', 'Komentar di tambahkan');
    }

}
