<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    public function like(Request $request , $id)
    {
        $like_s=$request->like_s;
        $post_id=$id;
        $change_like = 0;

        $likes =Like::where('post_id',$post_id)->where('user_id',Auth::id())->first();

        if(!$likes){
            $new_like = new like();
            $new_like->post_id = $post_id;
            $new_like->user_id = Auth::id();
            $new_like->like = 1;

            $like=$new_like->save();

            $isLike = 1;
        }
        elseif($likes->like == 1){
            $Likes = Like::where('post_id',$post_id)->where('user_id',Auth::id())->delete();
            $isLike = 0;

        }
        elseif($likes->like == 0){
            $Likes = Like::where('post_id',$post_id)->where('user_id',Auth::id())->update(['like' => 1]);
            $isLike = 1;
            $change_like = 1;
        }

        // $response = array(

        //     'isLike' => $isLike ,
        //     'change_like' => $change_like ,
        // ) ;
        // return response()->json( $response ,200);

        return [
            'status' => true,
            'message' => 'Done',
            'data' => ['user_id'=>Auth::id() , 'post_id'=>$id , 'like'=>$isLike],
        ];

    }










}
