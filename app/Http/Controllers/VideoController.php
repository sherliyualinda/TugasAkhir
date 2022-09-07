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

/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'  => 'required',
        ]);
        try{
            $video = Video::find($id);
            $file = $request->file('video');
            $uniqueName = time()."-".date('dmY');
            if($file){
                $this->validate($request, [
                    'video'  => 'required|mimes:mp4,mov,3gp|max:20000',
                ]);
                $videoold = public_path($video['url']);
                if(file_exists($videoold)){
                    unlink($videoold);
                }
                // Upload video
                $destinationPath = 'uploads/videos';
                $fileName = $uniqueName.'.'.$file->getClientOriginalExtension();
                $uploadSuccess = $file->move($destinationPath, $fileName);
                $video->url = '/'.$destinationPath.'/'.$fileName;
            }

            $thumbnail = $request->file('thumbnail');
            if($thumbnail){
                $this->validate($request, [
                    'thumbnail'  => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);
                $thumbnailold = public_path($video['thumbnail']);
                if(file_exists($thumbnailold)){
                    unlink($thumbnailold);
                }
                // Upload thumbnail
                $destinationPath = 'uploads/thumbnails';
                $fileName = $uniqueName."-thumbnail".'.'.$thumbnail->getClientOriginalExtension();
                $resize_image = Image::make($thumbnail->getRealPath());

                $resize_image->resize(200, 200, function($constraint){
                $constraint->aspectRatio();
                })->save($destinationPath . '/' . $fileName);
                $video->thumbnail = '/'.$destinationPath.'/'.$fileName;
            }

            $video->title = $request->title;
            $video->description = $request->description;
            $video->id_pengguna = (Auth::user()->id == 1 ) ? 4 : Auth::user()->id;
            $video->save();
            return redirect()->route('sosial-media.profil', Auth::user()->pengguna->username)
                ->with('success', 'Sukses edit video');
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return redirect()->back()
                ->with('errors', 'Gagal edit data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $video = Video::find($id);
        $thumbnail = public_path($video->thumbnail);
        $video = public_path($video->url);
        if(file_exists($thumbnail)){
            unlink($thumbnail);
        }
        if(file_exists($video)){
            unlink($video);
        }
        Video::where('id', $id)->delete();
        return redirect()->route('sosial-media.profil', Auth::user()->pengguna->username)
                ->with('success', 'Sukses hapus video');
    }
}
