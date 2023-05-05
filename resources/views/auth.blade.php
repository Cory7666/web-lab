@extends('app-template')

@section('styles')
    <link rel="stylesheet" href="/lib/css/auth-page-styles.css" />
@endsection



@section('scripts')
@endsection



@section('sidenav')
@endsection



@section('content')
    @if ($errors->any())
        <div class="card">
            <div class="card-header">
                <h2>Ошибки</h2>
            </div>
            <div class="card-content">
                <div id="error-messages">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-header">Вход</div>
        <div class="card-content">
            <form action="/action/auth" method="post">
                @csrf

                <label for="email-input">Логин </label>
                <input type="email" name="email" id="email-input" />
                <br />

                <label for="password-input">Пароль </label>
                <input type="password" name="password" id="password-input" />
                <br />

                <input type="submit" value="Войти" />
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Регистрация</div>
        <div class="card-content">
            <form action="/action/register" method="post">
                @csrf

                <label for="name-input">ФИО </label>
                <input type="text" name="name" id="name-input" />
                <br />

                <label for="email-input">Логин </label>
                <input type="email" name="email" id="email-input" />
                <br />

                <label for="password-input">Пароль </label>
                <input type="password" name="password" id="password-input" />
                <br />

                <input type="checkbox" name="is-admin" id="admin-input" />
                <label for="admin-input">Админом быть я хочу</label>
                <br />

                <input type="submit" value="Зарегистрироваться" />
            </form>
        </div>
    </div>
@endsection
