<div class="ledger-comment">
    <span class="lc-author">{{ $author }}</span>
    <span class="lc-aka">also known as <a href="mailto:{{ $email }}">{{ $email }}</a></span>
    <span class="lc-datetime">написано {{ $created_at }}</span>
    <span class="lc-content">
        {{ $comment_body }}
    </span>
</div>
