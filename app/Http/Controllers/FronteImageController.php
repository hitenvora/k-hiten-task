<?php

namespace App\Http\Controllers;

use App\Models\FronteImage;
use Illuminate\Http\Request;
use Illuminate\View\View;


class FronteImageController extends Controller

  
{
        public function addfront_image(): View
        {
    
            return view('admin-pages/front-image/add', [
                // Specify the base layout.
                // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
                // The default value is 'side-menu'
    
                'layout' => 'side-menu'
            ]);
        }
        public function front_imageList()
        {
            $front_imageList = FronteImage::all();
            return view('admin-pages/front-image/list', [
                // Specify the base layout.
                // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
                // The default value is 'side-menu'
                'front_imageList' => $front_imageList,
                'layout' => 'side-menu'
            ]);
        }
        public function save_front_image(Request $request)
        {
            // dd($request->all());
            try {
                $validated = $request->validate([
                    'title' => 'required',
    
                ]);
    
                $saveaddfront_image = new FronteImage();
                $saveaddfront_image->title = $request->title;
          
    
                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $ext = $file->getClientOriginalExtension();
                    $filename = 'image-' . time() . '_' . generateString() . '.' . $ext;
                    $filepath = 'upload/' . $filename;
                    $file->move('upload/', $filename);
                    $saveaddfront_image->image = $filepath;
                }
            // dd($filepath);
                $saveaddfront_image->save();
    
                return redirect()->route('front_image.list')->with('success', 'Front Image  saved successfully!');
            } catch (\Exception $e) {
                // Handle other exceptions
            
                return redirect()->back()->with('error', 'An error occurred while saving the Front Image data.');
            }
        }
        public function edit_front_image($id)
        {


        $editaddfront_image = FronteImage::findOrFail($id);
        // dd($editaddfront_image);
            return view('admin-pages/front-image/edit', [
                // Specify the base layout.
                // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
                // The default value is 'side-menu'
            'editaddfront_image' => $editaddfront_image,
                'layout' => 'side-menu'
            ]);
        }
        public function update_front_image(Request $request, $id)
        {
            try {
                // $validated = $request->validate([
                //     'title' => 'required|max:255',
                //     'message' => 'required|max:255',
    
                // ]);
                // Find the record by ID or create a new instance if not found
                $data = FronteImage::findOrFail($id);
                $data->title = $request->title;
    
    
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
                return redirect()->route('front_image.list')->with('success', 'Front Image  Updated successfully!');
    
            } catch (\Exception $e) {
                // Handle the exception
                return response()->json(['success' => false, 'message' => 'Error updating data: ' . $e->getMessage()]);
            }
        }
    
    
        public function delete_front_image($id)
        {
            try {
            $contectu = FronteImage::findOrFail($id);
            $contectu->delete();

            return redirect()->route('front_image.list')->with('success', 'Front Image  Updated successfully!');
            } catch (\Exception $e) {
            // Handle the exception
                return response()->json(['success' => false, 'message' => 'Error Delete data: ' . $e->getMessage()]);
        }
        }
    
    }
    