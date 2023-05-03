<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\LedgerPageController;
use App\Http\Controllers\BlogPageController;

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
    return view('main', [
        "page_title" => "Главная страница",
        "internal_path" => "/"
    ]);
});

Route::get('/about/', function () {
    return view('about', [
        "page_title" => "Об",
        "internal_path" => "/about/"
    ]);
});

Route::get('/fotos/', function () {
    $select_result = DB::select("SELECT COUNT(*) as 'a' FROM 'user';");
    return view('fotos', [
        "page_title" => "Фотоальбом",
        "internal_path" => "/fotos/",
        "additional_message" => $select_result[0]->a
    ]);
});

Route::get('/test/', function () {
    return view('test', [
        "page_title" => "Тест",
        "internal_path" => "/test/"
    ]);
});

Route::post(
    '/action/contact/new',
    [ContactsController::class, 'onNewRequest']
);

Route::get(
    '/ledger{response_type?}',
    [LedgerPageController::class, 'onGetRequest']
);

Route::post(
    '/ledger',
    [LedgerPageController::class, "onAddNew"]
);

Route::get(
    '/blog/',
    [BlogPageController::class, 'onGetRequest']
);
