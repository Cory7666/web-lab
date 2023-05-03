<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LedgerComment;

class LedgerPageController extends Controller
{
    private static int $perPageCommentCount = 20;

    public function onGetRequest(Request $r, string $responseType = '.html')
    {
        switch ($responseType)
        {
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
        if ($r->hasFile('file'))
        {
            $file = $r->file('file');
            $fd = fopen($file->openFile()->getPathname(), 'r');
            $header = fgetcsv($fd);

            while (($line = fgetcsv($fd)) !== FALSE)
            {
                LedgerComment::create([
                    "firstname" => $line[0],
                    "lastname" => $line[1],
                    "email" => $line[2],
                    "body_text" => $line[3],
                ]);
            }

            return response()->json();
        }
        else
        {
            return response()->json([
                "error" => "Ожидается файл."
            ]);
        }
    }
}
