<?php

namespace App\Http\Controllers;

use Image;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Notification;
use App\Models\VideoSubscribe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'thumbnail'  => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'video'  => 'required|mimes:mp4,mov,3gp|max:20000',
        'title'  => 'required',
        ]);
        DB::beginTransaction();

        try {
            $data = $request->all();
    
            $uniqueName = time()."-".date('dmY'); // For unique naming vaideo/thumbnail
            $videoSrc = "";
            $thumbnailSrc = "";

            $file = $request->file('video');     
            // Upload video
            $destinationPathVideo = 'uploads/videos';
            if (!file_exists($destinationPathVideo)) {
                mkdir($destinationPathVideo, 666, true);
            }
            $fileName = $uniqueName.'.'.$file->getClientOriginalExtension();
            $uploadSuccess = $file->move($destinationPathVideo, $fileName);
            $videoSrc = '/'.$destinationPathVideo.'/'.$fileName;
            $data['url'] = $videoSrc;

            $thumbnail = $request->file('thumbnail');
            // Upload thumbnail
            $destinationPath = 'uploads/thumbnails';
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 666, true);
            }
            $fileName = $uniqueName."-thumbnail".'.'.$thumbnail->getClientOriginalExtension();
            $resize_image = Image::make($thumbnail->getRealPath());

            $resize_image->resize(200, 200, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $fileName);
            $thumbnailSrc = '/'.$destinationPath.'/'.$fileName;
            $data['thumbnail'] = $thumbnailSrc;

            $data['id_pengguna'] = (Auth::user()->id == 1 ) ? 4 : Auth::user()->id;

            $video = Video::create($data);

            $subscribers = VideoSubscribe::where('id_channel', (Auth::user()->id == 1 ) ? 4 : Auth::user()->id)->get();
            $ids_user = [];
            foreach($subscribers as $value){
                if(!in_array($value->id_user, $ids_user, true)){
                    array_push($ids_user, $value->id_user);
                }
            }
            $notif = [];
            foreach ($ids_user as $id_user) {
                $notif[] = [
                    'jenis_notif' =>  'Subscriber',
                    'id_video' => $video->id,
                    'isi_notif' => 'Channel '. $video->user->name .' telah mengunggah video baru',
                    'status' => 'Belum Dibaca',
                    'id_user' => $id_user,
                    'created_at' => date("Y-m-d H:i:s")
                ];
            }
            Notification::insert($notif);
            DB::commit();
            return redirect()->route('sosial-media.profil', Auth::user()->pengguna->username)
                ->with('success', 'Sukses tambah video');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollback();
            return redirect()->back()
                ->with('errors', 'Gagal simpan data');
        }
    }
}
