<?php

namespace App\Http\Controllers\imageboards;

use App\Http\Controllers\Controller;
use App\Models\imageboard\PostImageBoard;
use Illuminate\Http\Request;
use Validator;
use Exception;
use DB;


class ImageboardController extends Controller
{
    public function create(Request $req){

        $valid = Validator::make($req->all(),[
            'thread_file' => 'image|max:2048|required',
            'post' => 'required|string|max:500'
        ]);
        if($valid->fails()){
            return response()->json([
                "error" => $valid->errors()
            ]);
        }
        $path = $req->file('thread_file')->storeAs(
            'public/images', $req->file('thread_file')->getClientOriginalName()
        );

        DB::beginTransaction();
        try{
            $post = PostImageBoard::create([
               "post" => $req->post,
               "thread_file" => $path,
            ]);
            DB::commit();
            return response()->json([
                "request" => $req->all(),
                "file" => $path,
                "original name" => $req->file('thread_file')->getClientOriginalName(),
            ]);
        }
        catch(\Exception $e) {
            DB::rollback();
            return response()->json([
                "error" => $e,
            ]);
        }

        
    }

    public function list_threads(){

        $data = PostImageBoard::all();

        return response()->json([
            "message" => "list_threads connected!",
            "data" => $data,
            "TITE" => "tite"
            // "thread_file" =>PostImageBoard::select('thread_file')->get(),
            // "post" => PostImageBoard::select('post')->get(),

        ]);
    }
}
