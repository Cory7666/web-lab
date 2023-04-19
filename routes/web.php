<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactsController;

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
    return view('fotos', [
        "page_title" => "Фотоальбом",
        "internal_path" => "/fotos/"
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
