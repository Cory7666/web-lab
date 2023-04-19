import { consoleLog } from "./ConsoleLog.js";
import { ModalWindow, ModalWindowCharacteristics } from "./ModalWindow.js"

var handlers = [];

document.addEventListener("DOMContentLoaded", () =>
{
  for (let index in handlers)
  {
    consoleLog.add("DEBUG", "addEventHandlers", `Добавить для ${handlers[index].targetElementSelector}.`);
    console.log(handlers[index]);
    new ModalWindow(handlers[index]);
  }
});

function addTargetElementHandler(targetElementSelector, text, onSuccess, onDeny)
{
  handlers.push(new ModalWindowCharacteristics(targetElementSelector, text, onSuccess, onDeny));
}

export { addTargetElementHandler }
