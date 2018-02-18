<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Gallery;
use App\Images;
use App\galleryCover;
use Illuminate\Support\Facades\Log;
use Image;

class ImagesController extends Controller
{
    public function __construct(){
		$this->middleware('auth');
	}
	public function index($id){
		if(Auth::user()->level >= ADMIN){
			$gallery = Gallery::findOrFail($id);
			return view('image.index')->with('gallery', $gallery);
		}else{
			return view('error404');
		}
	}
	public function receive($id , Request $request){
		if(Auth::user()->level >= ADMIN){
			$file = $this->imageValidator($request->all());
			if($file->passes()){
				$Image = new Images();
				$Image->filename = 'draft';
				$Image->gallery_id = $id;
				$Image->save();

				$_PATH = resource_path('galleries');        
                $_EXTENDSTION = $request->file('file')->getClientOriginalExtension();
                $_GENFILENAME = 'img'.$Image->id;
                $Image->filename = $_GENFILENAME.'.'.$_EXTENDSTION;
                $Image->save();
                //Save Image
                $request->file('file')->move($_PATH , $_GENFILENAME.'.'.$_EXTENDSTION);

				return response()->json('Successful', 200);
			}else{
				return response()->json('Maximum : 4 MiB', 400);
			}
		}else{
			return response()->json('error', 400);
		}
	}
	protected function imageValidator(array $data){
		return Validator::make($data, [
            'file' => 'image|max:5000000',
        ]);
	}
}
