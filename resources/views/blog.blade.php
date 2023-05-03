@extends('app-template')

@section('styles')
    <link rel="stylesheet" href="/lib/css/blog-page-styles.css" />
@endsection



@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Мой блог</h2>
        </div>
        <div class="card-content">
            @if (count($records) > 0)
                @foreach ($records as $record)
                    <x-blog-record
                        :title="$record->title"
                        :created-at="$record->created_at"
                        :body-text="$record->body_text"
                        :image-path="$record->image_path"
                    />
                @endforeach
            @else
                <p>Nobody here but us chickens!</p>
            @endif
        </div>
    </div>
@endsection
