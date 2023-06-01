function flip(record_container, form)
{
    let is_flipped = record_container.style.display == 'none';

    if (!is_flipped)
    {
        form.title.value = record_container.getElementsByClassName('br-title')[0].innerHTML;
        form.content.value = record_container.getElementsByClassName('br-content')[0].innerHTML;
    }

    record_container.style.display = is_flipped ? '' : 'none';
    form.style.display = is_flipped ? 'none' : '';
}

function get_parent_with_class(element, class_name)
{
    let parent = element;
    while (parent != null)
    {
        if (parent.classList.contains(class_name))
            break;
        parent = parent.parentElement;
    }

    return parent;
}

document.addEventListener(
    'dblclick',
    event =>
    {
        let record_root = get_parent_with_class(event.target, 'blog-record');
        if (record_root != null)
        {
            let form = record_root.getElementsByClassName('blog-record-editor')[0];
            let content_container = record_root.getElementsByClassName('content-container')[0];
            let title_container = content_container.getElementsByClassName('br-title')[0];
            let record_content_container = content_container.getElementsByClassName('br-content')[0];

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
                                    {
                                        content_container.innerHTML += `<img src="${value.image_path}" alt="Картинка" />`;
                                        record_content_container.innerHTML = value.content;
                                        title_container.innerHTML = value.title;
                                    }
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
