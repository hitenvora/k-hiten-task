<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function addblog(): View
    {

        return view('admin-pages/blog/add', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu'
        ]);
    }
    public function blogList()
    {
        $blog = Blog::all();
        return view('admin-pages/blog/list', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'blog' => $blog,
            'layout' => 'side-menu'
        ]);
    }
    public function saveblog(Request $request)
    {
        // dd($request->all());
        try {
            $validated = $request->validate([
                'title' => 'required',
                'message' => 'required',

            ]);

            $blog = new Blog();
            $blog->title = $request->title;
            $blog->message = $request->message;
      

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = 'image-' . time() . '_' . generateString() . '.' . $ext;
                $filepath = 'upload/' . $filename;
                $file->move('upload/', $filename);
                $blog->image = $filepath;
            }
            // dd($filepath);
            $blog->save();

            return redirect()->route('blog.list')->with('success', 'blog  saved successfully!');
        } catch (\Exception $e) {
            // Handle other exceptions

            return redirect()->back()->with('error', 'An error occurred while saving the blog data.');
        }
    }
    public function editblog($id)
    {


        $blogEdit = Blog::findOrFail($id);
        // dd($blogEdit);
        return view('admin-pages/blog/edit', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'blogEdit' => $blogEdit,
            'layout' => 'side-menu'
        ]);
    }
    public function updateblog(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|max:255',
                'message' => 'required|max:255',

            ]);
            // Find the record by ID or create a new instance if not found
            $data = Blog::findOrFail($id);
            $data->title = $request->title;
            $data->message = $request->message;


            if ($request->image == '') {
                $data->image = $request->old_image;
            } else {
                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $ext = $file->getClientOriginalExtension();
                    $filename = 'image-' . time() . '_' . generateString() . '.' . $ext;
                    $filepath = 'upload/' . $filename;
                    $file->move('upload/', $filename);
                    $data->image = $filepath;
                }

            }




            $data->updated_at = now();
            $data->save();
            return redirect()->route('blog.list')->with('success', 'blog  Updated successfully!');

        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['success' => false, 'message' => 'Error updating data: ' . $e->getMessage()]);
        }
    }


    public function deleteblog($id)
    {
        try {
        $contectu = Blog::findOrFail($id);
        $contectu->delete();

        return redirect()->route('blog.list')->with('success', 'blog  Updated successfully!');
        } catch (\Exception $e) {
        // Handle the exception
            return response()->json(['success' => false, 'message' => 'Error Delete data: ' . $e->getMessage()]);
    }
    }

}
