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
            @foreach ($comments as $comment)
                <x-comment
                    :author-firstname="$comment->firstname"
                    :author-lastname="$comment->lastname"
                    :email="$comment->email"
                    :comment-body="$comment->body_text"
                    :created-at="$comment->created_at" />
            @endforeach
            {{ $comments->links('pagination.default') }}
        </div>
    </div>
@endsection
