<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function companies(){

        $company = DB::table('companies')->get();
        return view("company", compact('company'));
    }

    public function InsertCompay(Request $request){

        $company = new Companies();
        $company->companyname = $request->company;
        $company->address = $request->address;
        $company->phone = $request->phone;
        $company->save();
        return redirect()->back()->with('comnpany', 'Save Success');
    }

    public function UpdateCompany($id,Request $request){
        $company = Companies::where('id', $id)->first();
        $company->companyname = $request->company;
        $company->address = $request->address;
        $company->phone = $request->phone;
        $company->update();

        return redirect()->back()->with("update", "Update Successs");
    }

    public function DeleteCompany($id){
        $company = Companies::where('id', $id)->first();
        $company->delete();
        return redirect()->back()->with("delete", "Delete Success!");
        
    }
}
