from fishtext import FishTextJson
from fishtext.types import TextType
import json

def titles_iterator(portion_size: int = 50):
    buffer: list[str] = []
    api = FishTextJson(text_type=TextType.Title)

    while True:
        if len(buffer) < 1:
            buffer = list(filter(lambda s: len(s) > 0, api.get(portion_size).text.split('\\n\\n')))
        
        yield buffer.pop().strip()

def message_body_iterator(portion_size: int = 50):
    buffer: list[str] = []
    api = FishTextJson(text_type=TextType.Paragraph)

    while True:
        if len(buffer) < 1:
            buffer = list(filter(lambda s: len(s) > 0, api.get(portion_size).text.split('\\n\\n')))
        
        yield buffer.pop().strip()

def main():
    record_count = 20

    records = []
    for _, title, message_body in zip(range(record_count), titles_iterator(), message_body_iterator()):
        records.append({
            'title': title,
            'body': message_body
        })
    
    with open('blog-records.json', 'w') as file:
        json.dump(
            records,
            file,
            ensure_ascii=False,
            indent=4
        )

main()
