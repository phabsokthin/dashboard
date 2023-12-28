<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestControll;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin');
});

// Route::get("/admin", function(){
//     return view('admin');
// });

Route::get("/product", [ProductController::class, "product"])->name("product");
Route::get("/dash", [ProductController::class, 'dash'])->name("dash");
Route::post('/save_product', [ProductController::class, 'save_product'])->name("save_product");

//company
Route::get("/company", [CompanyController::class, 'companies'])->name("company");
Route::post('/companypost', [CompanyController::class, 'InsertCompay'])->name("company_insert");
Route::post('/company_update/{id}', [CompanyController::class, "UpdateCompany"])->name("company_update");
Route::get("/company_delete/{id}", [CompanyController::class, 'DeleteCompany'])->name("DeleteCompany");

//category
Route::get('/cateogry', [CategoryController::class, 'Category'])->name("Category_name");
Route::post('/post_category', [CategoryController::class, 'insert_category'])->name("insert_category");
//student

Route::get('/get_test', [TestControll::class, "index_test"])->name("test");
Route::post("/post_test", [TestControll::class, "save_student"])->name("save_student");
Route::get('/delete/{id}', [TestControll::class, "delete_item"])->name("delete_item");
Route::post('/update/{id}', [TestControll::class, "update_item"])->name("update_item");
