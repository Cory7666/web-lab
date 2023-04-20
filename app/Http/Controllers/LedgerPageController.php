<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LedgerPageController extends Controller
{
    public function onGetRequest(Request $r)
    {
        return view(
            'ledger',
            [
                "page_title" => "Книга отзывов",
                "internal_path" => "/ledger/"
            ]
        );
    }
}
