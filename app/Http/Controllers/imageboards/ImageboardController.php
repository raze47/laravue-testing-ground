<?php

namespace App\Http\Controllers\imageboards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageboardController extends Controller
{
    public function create(Request $req){
        $req->file('thread_file')->store('public');
        return response()->json([
            "message" => "Controller connected!",
            "request" => $req->all(),
            "file" => $req->thread_file
        ]);
    }
}
