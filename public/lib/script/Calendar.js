import { consoleLog } from "./ConsoleLog.js";

class Calendar
{
  constructor(targetFieldId, month, year)
  {
    this.targetElementId = targetFieldId;
    this.header = new CalendarHeader(this, month || 1, year || 1970);
    this.body = new CalendarBody(this, month || 1, year || 1970);

    this.container = document.createElement("div");
    this.container.classList.add("calendar");
    this.container.style.position = "absolute";
    this.container.style.display = "none";
    this.container.appendChild(this.header.createNode());
    this.container.appendChild(this.body.createNode());

    document.body.appendChild(this.container);
  }

  show()
  {
    consoleLog.add("DEBUG", "Calendar#show", `Показать календарь.`);

    let element = document.getElementById(this.targetElementId);
    element.value = getFormattedDate(this.body.day, this.header.month, this.header.year);

    this.container.style.display = "inline-block";
    this.container.style.top = `${element.offsetTop + element.offsetHeight}px`;
    this.container.style.left = `${element.offsetLeft}px`;
    this.container.style.width = `${element.offsetWidth}px`;
  }

  hide()
  {
    consoleLog.add("DEBUG", "Calendar#hide", `Скрытие календаря.`);

    this.container.style.display = "none";
  }

  update()
  {
    consoleLog.add("DEBUG", "Calendar#update", `Обновление календаря.`);

    let element = document.getElementById(this.targetElementId);
    element.value = getFormattedDate(this.body.day, this.header.month, this.header.year);

    this.container.style.display = "inline-block";
    this.container.style.top = `${element.offsetTop + element.offsetHeight}px`;
    this.container.style.left = `${element.offsetLeft}px`;
    this.container.style.width = `${element.offsetWidth}px`;
    this.container.innerHTML = "";

    this.header = new CalendarHeader(this, this.header.month, this.header.year);
    this.body = new CalendarBody(this, this.header.month, this.header.year);

    this.container.appendChild(this.header.createNode());
    this.container.appendChild(this.body.createNode());
  }
}

class CalendarHeader
{
  constructor(owner, month, year)
  {
    this.owner = owner;
    this.month = month || 1;
    this.year = year || 1970;
    consoleLog.add("DEBUG", "CalendarHeader#constructor", `Создание заголовка календаря с ${this.month}/${this.year}.`);
  }

  createNode()
  {
    let container = document.createElement("div");
    let monthField = document.createElement("input");
    let yearField = document.createElement("input");

    container.classList.add("calendar-header");

    monthField.value = this.month;
    monthField.addEventListener("change", (event) =>
    {
      this.month = event.target.value - 0;
      this.owner.update();
    });

    yearField.value = this.year;
    yearField.addEventListener("change", (event) =>
    {
      this.year = event.target.value - 0;
      this.owner.update();
    });

    container.appendChild(monthField);
    container.appendChild(yearField);
    return container;
  }
}

class CalendarBody
{
  constructor(owner, month, year)
  {
    this.owner = owner;
    this.day = 1;
    this.month = month || 1;
    this.year = year || 1970;
    consoleLog.add("DEBUG", "CalendarBody#constructor", `Создание тела календаря с ${this.month}/${this.year}.`);
  }

  createNode()
  {
    let container = document.createElement("div");
    let table = document.createElement("table");
    let tableHeader = document.createElement("thead");
    let tableBody = document.createElement("tbody");

    let beginDayOfWeek = getWeekOfDay(1, this.month, this.year);
    let daysInMonthCount = getDaysInMonthCount(this.month, this.year);
    let weekCount = div(daysInMonthCount + beginDayOfWeek, 7) + ((daysInMonthCount + beginDayOfWeek) % 7 != 0 ? 1 : 0);

    for (let weekNumber = 0; weekNumber < weekCount; ++weekNumber)
    {
      let row = document.createElement("tr");
      for (let dayNumber = weekNumber * 7 - beginDayOfWeek; dayNumber < (weekNumber + 1) * 7 - beginDayOfWeek; ++dayNumber)
      {
        let td = document.createElement("td");
        if (dayNumber >= 0 && dayNumber < daysInMonthCount)
        {
          td.dataset.dayNumber = dayNumber + 1;
          td.innerHTML = dayNumber + 1;
        }
        row.appendChild(td);
      }
      tableBody.appendChild(row);
    }

    let headerRow = document.createElement("tr");
    for (let day in weekDaysShort["en"])
    {
      let td = document.createElement("td");
      td.innerHTML = weekDaysShort["en"][day];
      headerRow.appendChild(td);
    }
    tableHeader.appendChild(headerRow);

    tableBody.addEventListener("click", (event) =>
    {
      if (event.target.dataset.dayNumber != undefined)
      {
        this.day = event.target.dataset.dayNumber - 0;
        this.owner.update();
      }
    });

    table.appendChild(tableBody);
    table.appendChild(tableHeader);
    container.appendChild(table);
    return container;
  }
}

function getFormattedDate(day, month, year)
{
  return `${day || 1}.${month || 1}.${year || 2010}`;
}

// https://otvet.mail.ru/question/1891423
function getWeekOfDay(day, month, year)
{
  let d = day;
  let m = (month + 9) % 12 + 1;
  let y = year % 100;
  let c = div(year, 100) - (y == 0 && (m == 11 || m == 12) ? 1 : 0);
  let result = (d + div(13 * m - 1, 5) + y + div(y, 4) + div(c, 4) - 2 * c) % 7;
  consoleLog.add("INFO", "getDaysInMonthCount", `${day}(${d})/${month}(${m})/${year}(${c}.${y}) => ${result}.`);
  return result;
}

// https://habr.com/ru/post/261773/
function getDaysInMonthCount(x, y)
{
  let k1 = div(
    1 + (1 - div(y % 4 + 2, y % 4 + 1)) * div(y % 100 + 2, y % 100 + 1) + (1 - div(y % 400 + 2, y % 400 + 1)),
    x * x);
  let k2 = div(
    (1 - div(y % 4 + 2, y % 4 + 1)) * div(y % 100 + 2, y % 100 + 1) + (1 - div(y % 400 + 2, y % 400 + 1)),
    x);
  let result = 28 + (x + div(x, 8)) % 2 + 2 % x + k1 + div(1, x) - k2;
  consoleLog.add("INFO", "getDaysInMonthCount", `${x}/${y} => ${result}.`);
  return result;
}

function div(a, b)
{
  return ~~(a / b);
}

const weekDaysShort = {
  "en": ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
  "ru": ["Вн", "По", "Вт", "Ср", "Чт", "Пт", "Сб"]
};
const months = {
  "en": ["January", "February", "March", "April", "May", "Juny", "July", "August", "September", "October", "November", "December"],
  "ru": ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"]
};

export { Calendar };

