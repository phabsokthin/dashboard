<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function product(){

        $products = DB::table("products")
        ->join("companies", "companies.id", "=", "products.company_id")
        ->join("categories", "categories.id", "=", "products.category_id")
        ->select("products.id","products.productname", "companies.companyname", "categories.categoryname", "products.qty","products.price")
        ->get();

        $company = DB::table("companies")->get();
        $category = DB::table("categories")->get();
        return view('product', compact("company", "category", "products"));

    }

    public function dash(){
        return view('dashboard');
    }

    public function save_product(Request $request){
        sleep(2);
        $product= new Product();
        $product->productname = $request->pname;
        $product->company_id = $request->companyname;
        $product->category_id = $request->categoryname;
        $product->qty = $request->qty;
        $product->price = $request->price;
        $product->save();
        return redirect()->back()->with("success", "Save Success!");
    }
}
