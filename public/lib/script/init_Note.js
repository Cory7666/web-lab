import { Note } from "./Note.js"

var targetElements = []

document.addEventListener("DOMContentLoaded", () =>
{
  for (let index in targetElements)
  {
    new Note(targetElements[index][0], targetElements[index][1]);
  }
});

function addTarget(targetSelector, text)
{
  targetElements.push([targetSelector, text]);
}

export { addTarget }
