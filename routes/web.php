<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\LedgerPageController;
use App\Http\Controllers\BlogPageController;
use App\Http\Controllers\TestsPageController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
    '/blog',
    [BlogPageController::class, 'onGetRequest']
);

Route::post(
    '/blog',
    [BlogPageController::class, 'onPostRequest']
);


Route::get(
    '/auth',
    [AuthController::class, 'onGetRequest']
);
Route::post(
    '/action/auth',
    [AuthController::class, 'onAuthAction']
);
Route::post(
    '/action/register',
    [AuthController::class, 'onRegAction']
);
Route::post(
    '/action/exit',
    function (Request $r) {
        if (Auth::check()) {
            Auth::logout();
            Session::flush();
        }
        return redirect('/');
    }
);



Route::get(
    '/lk',
    function (Request $r) {
        if (Auth::check()) {
            return view('lk', [
                "page_title" => "Личный кабинет",
                "internal_path" => "/lk/",
            ]);
        } else {
            return redirect('/auth');
        }
    }
);
