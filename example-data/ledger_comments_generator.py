from fishtext import FishTextJson
from fishtext.types import TextType
from russian_names import RussianNames
from secmail import SecMail
from csv import DictWriter

def sentence_iter(portion_size: int = 100):
    api = FishTextJson(text_type=TextType.Sentence)
    buffer: list[str] = []
    while True:
        if len(buffer) < 1:
            buffer = list(filter(lambda s: len(s) > 0, api.get(portion_size).text.split('.')))
        yield buffer.pop().strip() + '.'

def email_iter(portion_size: int = 20):
    api = SecMail()
    buffer: list[str] = []
    while True:
        if len(buffer) < 1:
            buffer = api.generate_email(portion_size)
        yield buffer.pop().strip()

header_names = {
    "firstname": "firstname",
    "lastname": "lastname",
    "email": "email",
    "text": "body_text"
}

count = 1000

names = RussianNames(count=count, output_type='dict', transliterate=True).get_batch()

with open('ledger_comments.csv', 'w', newline='') as file:
    writer = DictWriter(file, fieldnames=[k for k in header_names.values()])
    writer.writeheader()
    for _, person, email, text in zip(range(count), names, email_iter(200), sentence_iter(200)):
        writer.writerow({
            header_names['firstname']: person['name'],
            header_names['lastname']:  person['surname'],
            header_names['email']:     email,
            header_names['text']:      text,
        })
