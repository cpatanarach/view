<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function secure($image){
    	return response()->file(resource_path('galleries').DIRECTORY_SEPARATOR.'img'.$image.'.jpg');
    }
}
