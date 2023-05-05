<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LedgerComment;
use Illuminate\Support\Facades\Auth;

class LedgerPageController extends Controller
{
    private static int $perPageCommentCount = 20;

    public function onGetRequest(Request $r, string $responseType = '.html')
    {
        switch ($responseType) {
            case ".json":
                return response()->json(LedgerComment::paginate(LedgerPageController::$perPageCommentCount));
            default:
                return view(
                    'ledger',
                    [
                        "page_title" => "Книга отзывов",
                        "internal_path" => "/ledger/",

                        'comments' => LedgerComment::paginate(LedgerPageController::$perPageCommentCount)
                    ]
                );
        }
    }

    public function onAddNew(Request $r)
    {
        if (Auth::check()) {
            if ($r->hasFile('uploaded_file')) {
                $file = $r->file('uploaded_file');
                $fd = fopen($file->openFile()->getPathname(), 'r');
                $header = fgetcsv($fd);

                while (($line = fgetcsv($fd)) !== FALSE) {
                    LedgerComment::create([
                        "firstname" => $line[0],
                        "lastname" => $line[1],
                        "email" => $line[2],
                        "body_text" => $line[3],
                    ]);
                }

                return redirect("/");
            } else if ($r->has('text')) {
                $curr_user = Auth::user();
                LedgerComment::create([
                    'firstname' => $curr_user->firstname,
                    'lastname' => $curr_user->lastname,
                    'email' => $curr_user->email,
                    'body_text' => $r->get('text'),
                ]);
                return redirect("/");
            } else {
                return back()->withErrors(["Ожидается комментарий."]);
            }
        } else {
            return back()->withErrors(["Вы должны бать зарегистрированы."]);
        }
    }
}
