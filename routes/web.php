<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\LedgerPageController;
use App\Http\Controllers\BlogPageController;
use App\Http\Controllers\TestsPageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        "internal_path" => "/fotos/",
    ]);
});

Route::get(
    '/test',
    [TestsPageController::class, 'onGetRequest']
);

Route::post(
    '/test',
    [TestsPageController::class, 'onPostRequest']
);

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

Route::get(
    '/images/{filename}',
    function (Request $r, string $filename)
    {
        return Storage::drive('blog_images')->get($filename);
    }
);
