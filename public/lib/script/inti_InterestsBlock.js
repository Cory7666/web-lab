'use strict';

function representArgumentsAsListItems()
{
  let ret = []
  for (let i = 0; i < arguments.length; ++i)
  {
    ret.push(`<li>${arguments[i]}</li>`);
  }
  return ret;
}

document.addEventListener("DOMContentLoaded", () =>
{
  let interestsBlock = document.getElementById("interests-content");
  let listElement = document.createElement("ul");
  listElement.innerHTML = representArgumentsAsListItems("хоккей", "футбол", "баскетбол").join("");
  interestsBlock.append(listElement);
});
