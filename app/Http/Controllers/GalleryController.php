<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Gallery;
use App\galleryCover;
use App\Images;
use Illuminate\Support\Facades\Log;
use File;

class GalleryController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
	public function index(Request $request){
		if(Auth::user()->level >= ADMIN){
			$galleries = Gallery::where('title','LIKE','%'.$request->search.'%')
								->orWhere('discription','LIKE','%'.$request->search.'%')->orderBy('action', 'asc')->paginate(15);
			$galleries->appends(request()->input())->links();
			return view('galleries.index')->with('galleries', $galleries)->with('searchEngine', $this->getSearchGalleryEngine());
		}else{
			return view('error404');
		}
	}
	public function store(Request $request){
		if(Auth::user()->level >= ADMIN){
			$data = $request->all();
			$gallery = $this->galleryValidator($data);
			if($gallery->passes()){
				$newGallery = new Gallery();
				$newGallery->title = $data['title'];
				$newGallery->discription = $data['discription'];
				$newGallery->publish = $data['publish'];
				$newGallery->action = $data['action'];
				$newGallery->save();
				Log::info($request->ip().'['.Auth::user()->email.']->Created Gallery['.$data['title'].'].');
				return redirect()->back()->with('success', 'สร้างแกลเลอรีสำเร็จ');
			}else{
				return redirect()->back()->withErrors($gallery)->withInput();
			}
		}else{
			return view('error404');
		}
	}
	public function destroy(Request $request){
		if(Auth::user()->level >= ADMIN){
			$gallery = Gallery::findOrFail($request->ref);
			$gallery->cover->delete();
			foreach ($gallery->images as $i => $image) {
				File::delete(resource_path('galleries').DIRECTORY_SEPARATOR.'img'.$image->id.'.jpg');
			}
			Log::alert($request->ip().'['.Auth::user()->email.']->Destroy Gallery['.$gallery->title.'].');
			$gallery->delete();
			return redirect()->back()->with('success', 'ลบข้อแกลเลอรีสำเร็จ');
		}else{
			return view('error404');
		}
	}
	public function edit($id){
		if(Auth::user()->level >= ADMIN){
			$gallery = Gallery::findOrFail($id);
			return view('galleries.edit')->with('gallery', $gallery);
		}else{
			return view('error404');
		}
	}
	public function update(Request $request){
		$gallery = $this->galleryValidator($request->all());
		if(Auth::user()->level >= ADMIN){
			if($gallery->passes()){
				$nGallery = Gallery::findOrFail($request->ref);
				$nGallery->title = $request->title;
				$nGallery->discription = $request->discription;
				$nGallery->publish = $request->publish;
				$nGallery->action = $request->action;
				$nGallery->save();
				Log::info($request->ip().'['.Auth::user()->email.']->Update Gallery['.$request->title.'].');
				return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
			}else{
				return redirect()->back()->withErrors($gallery)->withInput();
			}
			
		}else{
			return view('error404');
		}
	}
	public function destroyImage($id){
		if(Auth::user()->level >= ADMIN){
			$image = Images::findOrFail($id);
			File::delete(resource_path('galleries').DIRECTORY_SEPARATOR.'img'.$id.'.jpg');
			if(!empty($image->cover)){
				$image->cover->delete();
			}
			$image->delete();
			return redirect()->back();
		}else{
			return view('error404');
		}

	}
	public function setCover($gallery_id, $image_id){
		if(Auth::user()->level >= ADMIN){
			$gallery = Gallery::findOrFail($gallery_id);
			if(empty($gallery->cover)){
				$gallery->cover = new galleryCover();
				$gallery->cover->gallery_id = $gallery_id;
				$gallery->cover->images_id = $image_id;
				$gallery->cover->save();
			}else{
				$gallery->cover->images_id = $image_id;
				$gallery->cover->save();
			}
			return redirect()->back();
		}else{
			return view('error404');
		}
	}
	protected function getSearchGalleryEngine(){
        $searchEngine = new \stdClass();
        $searchEngine->link = url('/gallery/index');
        $searchEngine->placeHolder = 'ค้นหาแกลเลอรี...';
        $searchEngine->inputName = 'search';
        $searchEngine->enable = true;
        return $searchEngine;
    }
	protected function galleryValidator(array $data){
		return Validator::make($data, [
            'title' => 'required|max:255',
            'discription' => 'required',
            'action' => 'required|date',
        ]);
	}
}
