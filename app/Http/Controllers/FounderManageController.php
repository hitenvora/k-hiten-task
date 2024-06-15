<?php

namespace App\Http\Controllers;

use App\Models\FounderManage;
use Illuminate\Http\Request;
use Illuminate\View\View;


class FounderManageController extends Controller
{
    public function add_founder_mange(): View
    {

        return view('admin-pages/founder-manage/add', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu'
        ]);
    }   
    public function founder_mange_list()
    {
        $founder_mange_list = FounderManage::all();
        return view('admin-pages/founder-manage/list', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'founder_mange_list' => $founder_mange_list,
            'layout' => 'side-menu'
        ]);
    }
    public function save_founder_mange(Request $request)
    {
        // dd($request->all());
        try {
           
            $savefounder_mange = new FounderManage();
            $savefounder_mange->name = $request->name;
            $savefounder_mange->position = $request->position;
            $savefounder_mange->linkdin_link = $request->linkdin_link;
            $savefounder_mange->facebook_link = $request->facebook_link;
            $savefounder_mange->instagram_link = $request->instagram_link;
      

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = 'image-' . time() . '_' . generateString() . '.' . $ext;
                $filepath = 'upload/' . $filename;
                $file->move('upload/', $filename);
                $savefounder_mange->image = $filepath;
            }
        // dd($filepath);
            $savefounder_mange->save();

            return redirect()->route('founder_mange.list')->with('success', 'Founder Mange  saved successfully!');
        } catch (\Exception $e) {
            // Handle other exceptions
       
            return redirect()->back()->with('error', 'An error occurred while saving the Founder Mange data.');
        }
    }
    public function edit_founder_mange($id)
    {


        $edit_founder_mange = FounderManage::findOrFail($id);
        // dd($edit_founder_mange);
        return view('admin-pages/founder-manage/edit', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'edit_founder_mange' => $edit_founder_mange,
            'layout' => 'side-menu'
        ]);
    }
    public function update_founder_mange(Request $request, $id)
    {
        try {
            // $validated = $request->validate([
            //     'title' => 'required|max:255',
            //     'message' => 'required|max:255',

            // ]);
            // Find the record by ID or create a new instance if not found
            $data = FounderManage::findOrFail($id);
            $data->name = $request->name;
            $data->position = $request->position;
            $data->linkdin_link = $request->linkdin_link;
            $data->facebook_link = $request->facebook_link;
            $data->instagram_link = $request->instagram_link;


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
            return redirect()->route('founder_mange.list')->with('success', 'Founder Mange  Updated successfully!');

        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['success' => false, 'message' => 'Error updating data: ' . $e->getMessage()]);
        }
    }


    public function delete_founder_mange($id)
    {
        try {
        $contectu = FounderManage::findOrFail($id);
        $contectu->delete();

        return redirect()->route('founder_mange.list')->with('success', 'Founder Mange  Updated successfully!');
        } catch (\Exception $e) {
        // Handle the exception
            return response()->json(['success' => false, 'message' => 'Error Delete data: ' . $e->getMessage()]);
    }
    }

}
