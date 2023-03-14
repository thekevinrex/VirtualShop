<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{
    
    /**
     * Upload files to the application and is store to the db
     * @param Request $request
     * @return void
     */

    public function upload(Request $request) {

        
        $validator = Validator::make(
            $this->getValidationData ($request),
            $this->getValidationRules($request)
        );

        if ($validator->fails()){
            return response()->json(['message' => "Verify the uploaded file is a valid " . $request->only('type')], 422);
        }

        if ($request->boolean('multiple')) {

            $files = array();

            foreach ($request->file('file') as $fileToUpload) {
                $filename = $this->store($fileToUpload);

                $files[] = array(
                    'image' => $filename,
                    'path' => Storage::url($filename),
                );
            }

            return response()->json($files, 200);
        } else {
            $filename = $this->store($request->file('file'));
            return response()->json(['image' => $filename, 'path' => Storage::url($filename)], 200);
        }
    }

    private function store ($file) {

        $filename = $file->store('/', 'public');

        if (!$filename) {
            return response()->json(['message' => "There was a error traiting uploading the file"], 422);
        }

        // $this->saveDb ($filename);
        return $filename;
        
    }

    private function saveDb ($filename) {

        Image::create([
            'url' => $filename,
        ]);

    }

    private function getValidationData ($request) {
        if ($request->boolean ('multiple')){
            return $request->file('file');
        } else {
            return [
                'file' => $request->file('file'),
            ];
        }
    }
    private function getValidationRules ($request) {
        
        $rules = $this->getFilesValidationRules();
        if ($request->only('type') === 'images')
            $rules = $this->getImagesValidationRules();

        if ($request->only('type') === 'videos')
            $rules = $this->getVideosValidationRules();
            
        $data = $this->getValidationData($request);
        $validationRules = [];
        foreach($data as $key => $value) {
            $validationRules[$key] = $rules;
        }

        return $validationRules;
    }

    private function getImagesValidationRules () {
        return 'required|image|mimes:jpg,jpeg,png|' . $this->maxImagesSize();
    }

    private function getVideosValidationRules () {
        return 'required|mimes:mpg,mp4,avi|' . $this->maxFilesSize();
    }

    private function getFilesValidationRules () {
        return 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|' . $this->maxFilesSize ();
    }

    private function maxFilesSize () {
        return 'max:2048';
    }

    private function maxImagesSize () {
        return 'max:2048';
    }
}
