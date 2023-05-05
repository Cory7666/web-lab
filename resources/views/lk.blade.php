@extends('app-template')

@section('styles')
<link rel="stylesheet" href="/lib/css/lk-page-styles.css" />
@endsection



@section('scripts')
    
@endsection



@section('sidenav')

@endsection



@section('content')
    <div class="card">
        <div class="card-header">
            Действия
        </div>
        <div class="card-content">
            <form action="/action/exit" method="post">
                @csrf
                <input type="submit" value="Выйти" />
            </form>
        </div>
    </div>
@endsection
