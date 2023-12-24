<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function Category(){

        $category = DB::table("categories")->get();
        return view('category', compact('category'));

    }

    public function insert_category(Request $request){

        $category = new Categories();
        $category->categoryname = $request->category;
        $category->detail = $request->detail;
        $category->save();
        return redirect()->back()->with("success", "Insert Success!");
    }
}
