<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function search(Request $request)
    {
        $text = $request->input('searchText');
        $date = $request->input('searchDate');
        $type = $request->input('searchType');

        $files = [];
        $folders = [];
        
        if($type == 'FILENAME'){
            $files = $this->getFilesByFileName($text);
        }
        elseif($type == 'DATE'){
            $files = $this->getFilesByDate($date);
            $folders = $this->getFolderByDate($date);
        }
        elseif($type == 'FOLDER'){
            $folders = $this->getFolderByName($text);
        }

        $data = compact('files','folders');

        return response()->json($data);
    }

    private function getFilesByFileName($filename){

        $files = File::where('filename',$filename)->get();

        return $files;

    }

    private function getFilesByDate($date){

        $date = new Carbon($date);
        
        $files = File::whereDate('created_at', $date->toDateString())->get();
        
        return $files;

    }

    private function getFolderByName($name){

        $folders = Category::where('name',$name)->get();

        return $folders;

    }

    private function getFolderByDate($date){

        $date = new Carbon($date);
        
        $folders = Category::whereDate('created_at', $date->toDateString())->get();
        
        return $folders;

    }



}
