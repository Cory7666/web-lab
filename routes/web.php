<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\LedgerPageController;
use App\Http\Controllers\BlogPageController;
use App\Http\Controllers\TestsPageController;
use App\Http\Controllers\AuthController;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\SpyingRecord;

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


Route::get('/', function (Request $r) {
    SpyingRecord::spy_stealthily($r);
    return view('main', [
        "page_title" => "Главная страница",
        "internal_path" => "/"
    ]);
});

Route::get('/about/', function (Request $r) {
    SpyingRecord::spy_stealthily($r);
    return view('about', [
        "page_title" => "Об",
        "internal_path" => "/about/"
    ]);
});

Route::get('/fotos/', function (Request $r) {
    SpyingRecord::spy_stealthily($r);
    return view('fotos', [
        "page_title" => "Фотоальбом",
        "internal_path" => "/fotos/",
        "fotos" => Foto::orderBy('name')->get(),
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
        SpyingRecord::spy_stealthily($r);
        if (Auth::check()) {
            $user = Auth::user();
            return view('lk', [
                "page_title" => "Личный кабинет",
                "internal_path" => "/lk/",
                "current_user" => $user,
                "spying_records" => $user->account_type == 'admin' ? SpyingRecord::orderBy('created_at', 'desc')->paginate(10) : []
            ]);
        } else {
            return redirect('/auth');
        }
    }
);
