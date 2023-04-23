<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LedgerComment;

class LedgerPageController extends Controller
{
    public function onGetRequest(Request $r)
    {
        if (count(LedgerComment::all()) < 2)
        {
            LedgerComment::create(
                [
                    "firstname" => "Alex",
                    "lastname" => "Alexeev",
                    "email" => "alex@example.com",
                    "body_text" => "Q^Q"
                ]
            );
        }

        return view(
            'ledger',
            [
                "page_title" => "Книга отзывов",
                "internal_path" => "/ledger/",

                'comments' => LedgerComment::where("id", ">", 0)->get()
            ]
        );
    }
}
