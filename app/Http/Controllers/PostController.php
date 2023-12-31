<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->with('likes')->with(['comments' => function ($builder) {
            $builder->with('user');
        }])->latest('id')->get();

        return [
            'stuats' => true,
            'message' => "Done",
            'data' => $posts
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required'
        ]);
        // dd(Auth::id());

        try {
            $post = Post::create([
                'body' => $request->body,
                'user_id' => Auth::id(),
            ]);
            $post->load('user');
            $post->load('likes');
            return [
                'status' => true,
                'message' => 'Done',
                'data' => $post,
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
        $post = Post::findOrFail($id);

        if ($post) {
            return [
                'stuats' => true,
                'message' => "Done",
                'data' => $post,
            ];
        } else {
            return [
                'stuats' => true,
                'message' => "Done",
                'data' => $post,
            ];
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'body' => 'required'
        ]);


        $post = Post::findOrFail($id);
        $data = $request->all();


        try {
            $post->update($data);
            return [
                'status' => true,
                'message' => 'Done',
                'data' => $post,
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
            $post = Post::findOrFail($id);
            $post->delete();

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
