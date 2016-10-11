<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

use App\Http\Requests;
use App\File;

class MediaController extends Controller
{
    
    public function index()
    {
        $files = File::all();
        return view('media.index',compact('files'));
    }
    public function getFiles($id = null)
    {

        $files = File::where('parent_id', $id)->get()->all();
        if(count($files) == 0)
        {
            $files = File::where('parent_id', NULL)->get()->all();
        }
        return $files;
    }
    public function upload(Request $request)
    {
        $requestFile = $request->file('file');

        $name = Uuid::generate(4).'.'.$requestFile->getClientOriginalExtension();

        $folder = File::find($request->parent_id);
        if(!$folder)
        {
            $folder_id = null;
            $folder_path = '/upload';
        } else
        {
            $folder_id = $folder->id;
            $folder_path = $folder->path;
        }
        if($requestFile->move(storage_path().'/app/public'.$folder_path, $name))
        {
            $file = new File();

            $file->name = $requestFile->getClientOriginalName();
            $file->type = $requestFile->getClientMimeType();
            $file->path = $folder_path.'/'.$name;
            $file->save();

            return 'success';
        }
        return 'error';
    }

    public function create()
    {
        //
    }
    
    public function store(Request $request)
    {
        //
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        //
    }
    
    public function update(Request $request, $id)
    {
        //
    }
    
    public function destroy($id)
    {
        $file = File::find($id);
        if($file->delete()){ return 'success'; }
        return 'error';
    }
}
