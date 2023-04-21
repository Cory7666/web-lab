@extends('app-template')

@section('styles')
    <link rel="stylesheet" href="/lib/css/test-page-styles.css" />
@endsection



@section('scripts')
    <script src="/lib/script/jquery/jquery.js"></script>
    <script src="/lib/script/HorriblePersonData.js"></script>
    <script src="/lib/script/HorribleTestData.js"></script>
    <script src="/lib/script/init_TestDataFormValidator.js"></script>
    <script type="module">
        import { addTargetElementHandler } from "/lib/script/init_ModalWindow.js"
        addTargetElementHandler(
          ".question *[type=reset]",
          "Вы действительно хотите очистить форму?",
          (event) => { document.forms[0].reset() }
        );
        addTargetElementHandler(
          "#submitButton",
          "Вы действительно хотите отправить форму?",
          (event) => { document.forms[0].submit(); }
        );
    </script>
@endsection



@section('sidenav')
@endsection



@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Тест</h1>
        </div>
        <div class="card-content">
            <form action="mailto:activity.alex69985@gmail.com">
                <div class="question">
                    <label for="name">Я </label><input id="name" name="name" type="text">
                    <label for="group">Из </label>
                    <select name="group" id="group">
                        <option value="is1">ИС/б-20-1-о</option>
                        <option value="is2">ИС/б-20-2-о-</option>
                        <option value="pi">ПИ/б-20-1-о</option>
                    </select>
                </div>
                <div class="question">
                    <div class="question-header">Вопрос 1: Второй закон Ньютона?</div>
                    <div class="question-answers">
                        <div class="question-answer">
                            <input id="answer1" name="answer1" type="textarea" />
                        </div>
                    </div>
                </div>
                <div class="question">
                    <div class="question-header">Вопрос 2: Ускорение свободного падения равно:</div>
                    <ol class="question-answers">
                        <li class="question-answer"><label for="answer2_1">9.9</label><input id="answer2_1" name="answer2"
                                value="9.9" type="radio" checked /></li>
                        <li class="question-answer"><label for="answer2_2">9.8</label><input id="answer2_2" name="answer2"
                                value="9.8" type="radio" /></li>
                        <li class="question-answer"><label for="answer2_3">9.7</label><input id="answer2_3" name="answer2"
                                value="9.7" type="radio" /></li>
                    </ol>
                </div>
                <div class="question">
                    <div class="question-header">Вопрос 3: Атом состоит из:</div>
                    <div class="question-answers">
                        <div class="question-answer">
                            <select name="answer3" id="answer3">
                                <option value="right">Протоны и Нейтроны</option>
                                <option value="wrong2">Протоны и Электроны</option>
                                <option value="wrong1">Нейтроны и Электроны</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="question">
                    <input type="reset" value="Очистить" />
                    <input id="submitButton" type="button" value="Отправить" />
                </div>
            </form>
        </div>
    </div>
@endsection