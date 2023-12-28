<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TestControll extends Controller
{
    public function index_test(){


        $select = DB::table("tests")->orderBy('id', "DESC")->get();
        return view('test', compact('select'));
    }

    public function save_student(Request $request){
        sleep(1);

        $request->validate([
            'photo' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048'
        ]);

        $student = new Test();
        $student->student = $request->student;
        $student->grade = $request->gade;
        $student->sex = $request->gender;
        $student->pob = $request->pob;
        $student->phone = $request->phone;
        $extension = $request->file("photo")->extension();
        $filename = date("YmdHis"). '.' . $extension;
        $request->file('photo')->move(public_path('upload/'), $filename);
        $student->photo = $filename;
        $student->save();
        return redirect()->back()->with("success", "Save Successfull!");
    }
    //select

    // public function select_student($id){
    //     $student = Test::where('id', $id)->first();
    //     return view("test", compact('student'));
    // }

    //delete

    public function delete_item($id){
        sleep(1);
        $delete = Test::where('id', $id)->first();
        // if(file_exists(public_path('upload' .$delete->photo)) and !empty($delete->photo)){
        //     unlink(public_path('upload/' .$delete->photo));
        // }
        $image_path = public_path('upload/' . $delete->photo);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $delete->delete();
        return redirect()->back()->with("del", "Delete Successfull...");
    }

    public function update_item($id, Request $request){
        sleep(1);

        $request->validate([
            'student' => 'required',
            'pob' => 'required',
            'phone' => 'required',
            'photo' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048'
        ]);

        $student = Test::where('id', $id)->first();
        $student->student = $request->student;
        $student->grade = $request->gade;
        $student->sex = $request->gender;
        $student->pob = $request->pob;
        $student->phone = $request->phone;

        // if($request->hasFile('cover')){

        //     if(file_exists(public_path('upload/' . $student->photo)) and !empty($student->photo)){
        //         unlink(public_path('upload/' . $student->photo));
        //     }
        // }
        // $extension = $request->file('photo')->extension();
        // $filename = date('YmdHis') . '.' . $extension;
        // $request->file('photo')->move(public_path('upload'), $filename);
        // $student->photo = $filename;

        if($request->hasFile('photo')){

            $destination = 'upload/' .$student->photo;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file("photo");
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('upload/', $filename);
            $student->photo = $filename;
        }
        $student->update();
        return redirect()->back()->with("success", "Update successfull!");
    }
}
