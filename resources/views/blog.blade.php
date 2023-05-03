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

    <div class="card">
        <div class="card-header">
            <h2>Добавить запись</h2>
        </div>
        <div class="card-content">
            <form action="/blog" method="post" enctype="multipart/form-data">
                <label for="title-input">Заголовок: </label>
                <input type="text" name="title" id="title-input" />
                <br />

                <label for="body-input">Текст: </label>
                <textarea name="body" id="body-input" cols="30" rows="10"></textarea>
                <br />

                <label for="image-input">Картинка (опционально): </label>
                <input type="file" name="uploaded_image" id="image-input" />
                <br />
                
                <input type="submit" value="Добавить" />
            </form>

            @if ($errors->any())
                <div id="error-messages">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection
