function flip(content_container, form)
{
    let is_flipped = content_container.style.display == 'none';

    if (!is_flipped)
    {
        form.content.value = content_container.innerHTML;
    }

    content_container.style.display = is_flipped ? '' : 'none';
    form.style.display = is_flipped ? 'none' : '';
}

document.addEventListener(
    'dblclick',
    event =>
    {
        let content_container = event.target;
        if (content_container.classList.contains('br-content'))
        {
            let form = content_container.parentElement.getElementsByClassName('br-content-editor')[0];
            flip(content_container, form);

            form.onsubmit = (event) =>
            {
                event.preventDefault();
                let button = event.submitter;

                if (button.dataset['action'] == 'approve')
                {
                    fetch(
                        form.action, {
                        method: form.method,
                        body: new FormData(form),
                    })
                        .then(response =>
                        {
                            response.json()
                                .then(value =>
                                {
                                    if (value.result)
                                        content_container.innerHTML = value.content;
                                })
                                .catch(alert);
                        })
                        .catch(alert)
                        .finally(() =>
                        {
                            flip(content_container, form);
                        });
                }
                else if (button.dataset['action'] == 'reject')
                {
                    flip(content_container, form);
                }
            };
        }
    }
);
