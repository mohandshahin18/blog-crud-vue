<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            'status' => true,
            'message' => 'Done',
            'data' => Blog::all(),
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'image' => 'required',
            'body' => 'required'
        ]);

        $path = rand().time().$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images'), $path);

        try {
           $blog= Blog::create([
                'title'=>$request->title,
                'image'=>$path,
                'body'=>$request->body,
            ]);

            return [
                'status' => true,
                'message' => 'Done',
                'data' => $blog,
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
        return [
            'status' => true,
            'message' => 'Done',
            'data' => Blog::findOrFail($id),
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'title' => 'required|string',
            'body' => 'required'
        ]);

        $blog = Blog::findOrFail($id);
        if($request->hasFile('image')){
            File::delete(public_path('images/'.$blog->image));
            $path = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $path);
            $data['image'] = $path;
        }

        try {
          $blog->update($data);

            return [
                'status' => true,
                'message' => 'Done',
                'data' => $blog,
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
        try{
            $blog = Blog::findOrFail($id);
            File::delete(public_path('images/'.$blog->image));
            $blog->delete();

            return [
                'status' => true,
                'message' => 'Done',
                'data' => [],
            ];
        }
        catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Reject',
                'data' => $e->getMessage(),
            ];
        }

    }
}
