<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

use Image;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::paginate();
        return view('super-admin.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super-admin.videos.create');
    }

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

        try {
            $data = $request->all();
    
            $uniqueName = time()."-".date('dmY'); // For unique naming vaideo/thumbnail
            $videoSrc = "";
            $thumbnailSrc = "";

            $file = $request->file('video');     
            // Upload video
            $destinationPath = 'uploads/videos';
            $fileName = $uniqueName.'.'.$file->getClientOriginalExtension();
            $uploadSuccess = $file->move($destinationPath, $fileName);
            $videoSrc = '/'.$destinationPath.'/'.$fileName;
            $data['url'] = $videoSrc;

            $thumbnail = $request->file('thumbnail');
            // Upload thumbnail
            $destinationPath = 'uploads/thumbnails';
            $fileName = $uniqueName."-thumbnail".'.'.$thumbnail->getClientOriginalExtension();
            $resize_image = Image::make($thumbnail->getRealPath());

            $resize_image->resize(200, 200, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $fileName);
            $thumbnailSrc = '/'.$destinationPath.'/'.$fileName;
            $data['thumbnail'] = $thumbnailSrc;

            $data['id_pengguna'] = (Auth::user()->id == 1 ) ? 1 : Auth::user()->pengguna->id_pengguna;

            Video::create($data);

            return redirect()->route('superadmin.sosial-media.video.index')
                ->with('success', 'Sukses simpan data');
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return redirect()->back()
                ->with('errors', 'Gagal simpan data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = Video::find($id);
        return view('super-admin.videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::find($id);
        return view('super-admin.videos.edit', compact('video'));
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
            $video->id_pengguna = (Auth::user()->id == 1 ) ? 1 : Auth::user()->pengguna->id_pengguna;
            $video->save();
            return redirect()->route('superadmin.sosial-media.video.index')
                    ->with('success', 'Sukses simpan data');
        } catch (\Throwable $th) {
            dd($th->getMessage());
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
        return redirect()->route('superadmin.sosial-media.video.index')
                ->with('success', 'Sukses hapus data');
    }
}
