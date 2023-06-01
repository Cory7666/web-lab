<div class="blog-record">
    <div class="content-container">
        <h2 class="br-title">{{ $title }}</h2>
        <p class="br-created-at">создано {{ $created_at }}</p>
        
        @auth
            <form action="/blog/{{ $record_id }}" method="post">
                @csrf
                @method('delete')
                <button type="submit">Удалить</button>
            </form>
        @endauth

        @if ($imagepath)
            <img src="{{ $imagepath }}" alt="Картинка" />
        @endif

        <div class="br-content">{!! $body_text !!}</div>
    </div>
    <form class="blog-record-editor" action="/blog/{{ $record_id }}/edit" method="post" style="display: none">
        <input type="text" name="title" placeholder="Заголовок" />
        <br />
        <input type="file" name="uploaded_image" />
        <br />
        <textarea name="content" cols="30" rows="10"></textarea>
        <br />
        <button type="submit" data-action="reject">Отменить</button>
        <button type="submit" data-action="approve">Изменить</button>
    </form>
</div>
