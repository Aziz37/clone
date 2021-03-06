<?php

namespace App\Http\Controllers\Admin;

use App\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function store(Request $request)
    {
    	$files = $request->file('file');

    	foreach($files as $file)
		{
			File::create([
				'admin_id'  =>  Auth::user()->id,
				'board_id'  =>  $request->input('board_id'),
				'listing_id'=>  $request->input('list_id'),
				'card_id'   =>  $request->input('card_id'),
				'filename'  =>  $file->getClientOriginalName(),
				'path'      =>  $file->store('public/storage')
			]);

            session()->flash('message', 'File uploaded! ');
			return redirect()->back();
		}
    }

    public function show($id)
    {
        $download = File::findOrFail($id);
        return Storage::download($download->path, $download->filename);
    }

    public function destroy($id)
    {
    	$file = File::findOrFail($id);
        
    	Storage::delete($file->path);
    	$file->delete();

        session()->flash('message', 'File deleted');

    	return redirect()->back();
    }
}
