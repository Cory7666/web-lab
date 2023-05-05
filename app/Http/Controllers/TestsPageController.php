<?php

namespace App\Http\Controllers;

use App\Models\TestAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhysicsTeacher
{
    public function __construct(
        private string $questionableAnswer
    ) {
    }

    public function isAnswerToFirstQuestion(): string
    {
        return ($this->questionableAnswer == "123") ? 'true' : 'false';
    }

    public function isAnswerToSecondQuestion(): string
    {
        return ($this->questionableAnswer == "9.8") ? 'true' : 'false';
    }

    public function isAnswerToThirdQuestion(): string
    {
        return ($this->questionableAnswer == "right") ? 'true' : 'false';
    }
}

class TestsPageController extends Controller
{
    public function onGetRequest(Request $r)
    {
        return view('test', [
            "page_title" => "Тест",
            "internal_path" => "/test/",
            "answers" => Auth::check() ? TestAnswer::all() : [],
        ]);
    }

    public function onPostRequest(Request $r)
    {
        $this->validate(
            $r,
            [
                'name'    => ['required'],
                'group'   => ['required'],
                'answer1' => ['required'],
                'answer2' => ['required'],
                'answer3' => ['required'],
            ]
        );

        TestAnswer::create([
            'name' => $r->name,
            'group' => $r->group,
            'q1_answer' => (new PhysicsTeacher($r->answer1))->isAnswerToFirstQuestion(),
            'q2_answer' => (new PhysicsTeacher($r->answer2))->isAnswerToSecondQuestion(),
            'q3_answer' => (new PhysicsTeacher($r->answer3))->isAnswerToThirdQuestion(),
        ]);

        return redirect('/');
    }
}
