<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            'stuats' => true,
            'message' => "Done",
            'data' =>Comment::with('user')->with('post')->get(),
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , $id)
    {
        $request->validate([
            'body' => 'required'
        ]);

        $posts = Post::with('user')->with(['comments' => function ($builder) {
            $builder->with('user');
        }])->findOrFail($id);

        try {
            $comment = Comment::create([
                'body' => $request->body,
                'post_id' => $request->post_id,
                'user_id' => $request->user_id,
            ]);
            $comment->load('user');
            return [
                'status' => true,
                'message' => 'Done',
                'data' => ['post' => $posts ,'comment'=> $comment ],
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Reject',
                'data' => $e->getMessage(),
            ];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'body' => 'required'
        ]);


        $comment = Comment::findOrFail($id);
        $data = $request->all();


        try {
            $comment->update($data);
            return [
                'status' => true,
                'message' => 'Done',
                'data' => $comment,
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Reject',
                'data' => $e->getMessage(),
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $comment->delete();

            return [
                'status' => true,
                'message' => 'Done',
                'data' => [],
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Reject',
                'data' => $e->getMessage(),
            ];
        }
    }
}
