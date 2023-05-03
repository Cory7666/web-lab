<div class=blog-record>
    <h2>{{ $title }}</h2>

    @if ($imagepath)
        <img src="{{ $imagepath }}" alt="Картинка" />
    @endif
    
    <p>создано {{ $created_at }}</p>
    <p>{{ $body_text }}</p>
</div>
