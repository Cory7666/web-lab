<div class="blog-record">
    <h2>{{ $title }}</h2>
    <p class="br-created-at">создано {{ $created_at }}</p>

    @if ($imagepath)
        <img src="{{ $imagepath }}" alt="Картинка" />
    @endif
    
    <p class="br-content">{{ $body_text }}</p>
</div>
