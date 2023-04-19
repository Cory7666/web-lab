import { consoleLog } from "./ConsoleLog.js"
import { Calendar } from "./Calendar.js"

const targetElementId = "dateField";

document.addEventListener("DOMContentLoaded", () => 
{
  let calendar = new Calendar(targetElementId);

  $(`#${targetElementId}`).click((event) =>
  {
    let showCalendar = event.target.dataset.showCalendar || "false";
    if (showCalendar == "false")
    {
      consoleLog.add("DEBUG", "init_Calendar#focusHandler", "Показать календарь.");
      calendar.show();
      event.target.dataset.showCalendar = "true";
    }
    else
    {
      consoleLog.add("DEBUG", "init_Calendar#focusHandler", "Скрыть календарь.");
      calendar.hide();
      event.target.dataset.showCalendar = "false";
    }
  });
});
