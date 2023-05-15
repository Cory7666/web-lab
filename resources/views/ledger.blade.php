@extends('app-template')

@section('styles')
    <link rel="stylesheet" href="/lib/css/ledger-styles.css" />
@endsection



@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Отзывы</h2>
        </div>
        <div class="card-content">
            @if (count($comments) > 0)
                @foreach ($comments as $comment)
                    <x-comment :author-firstname="$comment->firstname" :author-lastname="$comment->lastname" :email="$comment->email" :comment-body="$comment->body_text" :created-at="$comment->created_at" />
                @endforeach
                {{ $comments->links('pagination.default') }}
            @else
                <p>Nobody here but us chickens!</p>
            @endif
        </div>
    </div>

    @auth
        <div class="card">
            <div class="card-header">
                <h2>Добавить отзыв</h2>
            </div>
            <div class="card-content">
                <form action="/action/ledger/add/record" method="post" enctype="application/x-www-form-urlencoded">
                    @csrf

                    <textarea name="text" id="text-input" cols="30" rows="10" placeholder="Текст отзыва" required="true"></textarea>
                    <input type="submit" value="Отправить" />
                </form>
            </div>
        </div>

        @if (Auth::user()->account_type == 'admin')
            <div class="card">
                <div class="card-header">
                    <h2>Добавить пачку отзывов</h2>
                </div>
                <div class="card-content">
                    <form action="/action/ledger/add/file" enctype="multipart/form-data" method="POST">
                        @csrf

                        <input type="file" name="uploaded_file" id="ledger-file-input" />
                        <input type="submit" value="Отправить" />
                    </form>
                </div>
            </div>
        @endif
    @endauth
@endsection
