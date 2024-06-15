<?php

namespace App\Http\Controllers\API\Web;

use App\Http\Controllers\Controller;

use App\Models\Blog;
use App\Http\Requests\BlogRequest;
use App\Http\Resources\BlogResource;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::paginate(15);
        return BlogResource::collection($blogs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $blog = new Blog;
		$blog->title = $request->input('title');
		$blog->message = $request->input('message');
        $blog->image = $request->input('image');
        $blog->save();

        return response()->json($blog, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return new BlogResource($blog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BlogRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, $id)
    {
        $blog = Blog::findOrFail($id);
		$blog->title = $request->input('title');
		$blog->message = $request->input('message');
		$blog->image = $request->input('image');
        $blog->save();

        return response()->json($blog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return response()->json(null, 204);
    }
}
