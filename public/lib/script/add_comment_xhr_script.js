function add_comment(comments_containers, comment)
{
    [].forEach.call(comments_containers, element =>
    {
        element.innerHTML += comment;
    });
}

function onXhrStateUpdate(state)
{
    let request = state.target;
    if (request.readyState == 4 && request.status < 400)
    {
        console.log(state.target.response);
        let response = JSON.parse(state.target.response);
        let containers = request._containers;

        if (response.result)
        {
            add_comment(containers, response.comment);
        }
    }
}

function onFormSubmit(form)
{
    let containers = form.parentElement.getElementsByClassName('comments-container');
    let text_body = form.text_body.value || "НЛО уничтожил текст комментария!";
    let blog_record_id = form.blog_record_id.value;

    let request = new XMLHttpRequest();

    request._containers = containers;

    request.open(form.method, form.action, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.onreadystatechange = onXhrStateUpdate;
    request.send(`text_body=${encodeURIComponent(text_body)}&blog_record_id=${blog_record_id}`);
}

document.addEventListener(
    'submit',
    event =>
    {
        if (event.target.attributes.action.value == '/blog/comment')
        {
            event.preventDefault();
            onFormSubmit(event.target);
        }
    }
);
