class DateTimeFormat
{
  constructor(date)
  {
    this.date = date;
  }

  getFirstVariant()
  {
    return `${this.date.getDate()}.${this.date.getMonth()}.${this.date.getFullYear() % 100} ${weekDays["en"][this.date.getDay()]}`;
  }

  getSecondVariant()
  {
    return `${this.date.getDate()} ${months["en"][this.date.getMonth()]} ${this.date.getFullYear() % 100}`;
  }

  getThirdVariant()
  {
    return `${this.date.getDate()}.${this.date.getMonth()}.${this.date.getFullYear()} ${weekDays["ru"][this.date.getDay()]}`;
  }

  getFourVariant()
  {
    return `${this.date.getDate()} ${months["ru"][this.date.getMonth()]} ${this.date.getFullYear()}`;
  }
}

const weekDays = {
  "en": ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
  "ru": ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"]
};

const months = {
  "en": ["January", "February", "March", "April", "May", "Juny", "July", "August", "September", "October", "November", "December"],
  "ru": ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"]
}

export { DateTimeFormat }
