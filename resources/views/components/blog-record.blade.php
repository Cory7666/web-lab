<div class="blog-record">
    <h2>{{ $title }}</h2>
    <p class="br-created-at">создано {{ $created_at }}</p>

    @if ($imagepath)
        <img src="{{ $imagepath }}" alt="Картинка" />
    @endif

    <div class="content-container">
        <div class="br-content">{!! $body_text !!}</div>
        <form class="br-content-editor" action="/blog/{{ $record_id }}/edit" method="post" style="display: none">
            <textarea name="content" id="content_input" cols="30" rows="10"></textarea>
            <button type="submit" data-action="reject">Отменить</button>
            <button type="submit" data-action="approve">Изменить</button>
        </form>
    </div>
</div>
