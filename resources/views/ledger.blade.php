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
            <x-comment author="Alex A." email="alex@localhosters.org" comment-body="123" created-at="2022-88-88" />
        </div>
    </div>
@endsection
