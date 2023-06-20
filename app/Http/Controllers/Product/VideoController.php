<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    
    public function index () {
        return view('seller.videos.index');
    }
    
    public function upload () {
        return view('seller.videos.upload');
    }

    public function store(Request $request) {

        $request->validate([
            'file' => 'required|mimes:mpg,mp4,avi|max:102400',
        ]);

        
        $file = $this->addToQueue($request->file('file'));

    }

    private function addToQueue ($file) {

        $filename = $file->store('/', 'public');

        if (!$filename) {
            return response()->json(['message' => "There was a error traying uploading the file"], 422);
        }

        // $this->saveDb ($filename);
        return $filename;
        
    }
}
