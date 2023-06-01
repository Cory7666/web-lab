<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\LedgerPageController;
use App\Http\Controllers\BlogPageController;
use App\Http\Controllers\TestsPageController;
use App\Http\Controllers\AuthController;
use App\Models\BlogRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\SpyingRecord;

use Illuminate\Support\Facades\DB;

interface ActiveRecord
{
    public function save(): void;
    public function get(int $id);
    public static function getAll(): array;
}

class FotoAR implements ActiveRecord
{
    private static string $__select_all_pattern = "SELECT * FROM 'fotos';",
        $__select_specific_pattern = "SELECT * FROM 'fotos' WHERE 'id' = ?;",
        $__insert_pattern = "INSERT INTO 'fotos' ('id', 'name', 'path') VALUES (?, ?, ?);",
        $__update_pattern = "UPDATE 'fotos' SET 'name' = ?, 'path' = ? WHERE 'id' = ?;",
        $__count = "SELECT COUNT(*) as c FROM 'fotos' WHERE 'id' = ?;";

    public function __construct(
        public string $name,
        public string $path,
        public int $id = -1,
    ) {
    }

    public static function getAll(): array
    {
        return DB::select(FotoAR::$__select_all_pattern);
    }

    public function get(int $id)
    {
        return DB::select(FotoAR::$__select_specific_pattern, [$id])[0];
    }

    public function save(): void
    {
        $count = DB::select(FotoAR::$__count, [$this->id])[0]->c;
        if (0 == $count) {
            $this->id = $count;
            DB::insert(FotoAR::$__insert_pattern, [$this->id, $this->name, $this->path]);
        } else {
            DB::update(FotoAR::$__update_pattern, [$this->name, $this->path, $this->id]);
        }
    }
}

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
        #"fotos" => Foto::orderBy('name')->get(),
        "fotos" => FotoAR::getAll(),
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

Route::get(
    '/blog',
    [BlogPageController::class, 'onGetRequest']
);
Route::post(
    '/blog',
    [BlogPageController::class, 'onPostRequest']
);
Route::post(
    '/blog/comment',
    [BlogPageController::class, 'onAddComment']
);
Route::post(
    '/blog/{pk}/edit',
    [BlogPageController::class, 'onUpdateRecordContent']
);
Route::delete(
    '/blog/{pk}/',
    [BlogPageController::class, 'onDeleteRecord']
);


Route::post(
    '/ledger',
    [LedgerPageController::class, "onAddNew"]
);
Route::post(
    '/action/ledger/add/file',
    [LedgerPageController::class, 'onAddRecordsFromFile']
);
Route::post(
    '/action/ledger/add/record',
    [LedgerPageController::class, 'onAddOneRecord']
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
    '/action/checkemail',
    [AuthController::class, 'onEmailCheck']
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




Route::get(
    '/spystat',
    function (Request $r) {
        return view('spystat', [
            "page_title" => "Spystat",
            "internal_path" => "/spystat/",
        ]);
    }
);


Route::get('/totest/', function (Request $r) { dd(BlogRecord::where('id', '=', 9000)->first()); });
