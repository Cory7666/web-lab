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
            <h2>О пользователе</h2>
        </div>
        <div class="card-content">
            <p>ФИО: {{ $current_user->firstname . ' ' . $current_user->lastname }}</p>
            <p>Email: {{ $current_user->email }}</p>
            <p>Тип учётной записи: {{ $current_user->account_type == 'admin' ? 'Администратор' : 'Пользователь Обычный' }}
            </p>
        </div>
    </div>

    @isset($spying_records)
    @if (count($spying_records) > 0)
    <div class="card">
        <div class="card-header">
            <h2>Шпионаж</h2>
        </div>
        <div class="card-content">
            @foreach ($spying_records as $record)
                <x-spying-record
                :datetime="$record->created_at"
                :ip="$record->client_ip"
                :user-agent="$record->client_user_agent"
                :hostname="$record->client_hostname"
                :path="$record->path"
                />
            @endforeach
            {{ $spying_records->links('pagination.default') }}
        </div>
    </div>
    @endif
    @endisset
    
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
