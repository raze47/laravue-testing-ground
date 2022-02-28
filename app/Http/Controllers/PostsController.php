<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException as ME;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\User;
use Carbon\Carbon;
use Validator;
use Auth;
use DB;

class PostsController extends Controller
{
    public function create_post(Request $req)
    {
        /*
        1. Fill posts table
        2. Fill postsComments

        */
        $valid = Validator::make($req->all(), [
            'text' => 'required|string',
        ]);
        if ($valid->fails()) {
            return response()->json(
                [
                    'errors' => $valid->errors(),
                ],
                400
            );
        }
        $user = Auth::user();
        DB::BeginTransaction();

        try {
            $post = Posts::create([
                "text" => $req->text,
                "user_id" => $user->id,
            ]);
            DB::commit();
            return response()->json([
                'data' => $post,
                //'user' => User::where(['id' => $user->id])->firstOrFail('name'),
                'text' => 'Post successful',
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(
                [
                    'errors' => ['Can`t create your entry as of now. Contact the developer to fix it. Error Code : AM-comp-0x05'],
                    'msg' => $e->getMessage(),
                ],
                500
            );
        }
    }

    public function list_posts()
    {
        $user = Auth::user();
        
        return response()->json([
            "data" => Posts::orderBy('post_id', 'desc')->where(['user_id' => $user->id])->with('users')->paginate(5),
            "text" => "Listing done"
        ]);
        
        
    }

    public function delete_post(Request $req){

        Posts::where(['post_id' => $req->id])->delete();
        dd($req->id);
        return response()->json([
            "text" => "Post deleted!"
        ]);
    }
}
