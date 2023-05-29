<form action="/blog/comment" method="post">
    @csrf
    <input type="hidden" name="blog_record_id" value="{{ $blogRecordId }}" />
    <input type="text" name="text_body" id="text_body" placeholder="Текст комментария" />
    <input type="submit" value="Отправить" />
</form>
