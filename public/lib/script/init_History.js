import { Cookie } from "./Cookie.js"
import { HistoryInLocalStorage } from "./HistoryInLocalStorage.js"

document.addEventListener("DOMContentLoaded", () => 
{
  new Cookie(currentDocument).incrementValue();
  new HistoryInLocalStorage(currentDocument).incrementValue();

  [
    "/",
    "/fotos/",
    "/about/",
    "/test/"
  ].forEach((x) => 
  {
    let x_n = normalizeName(x);
    let e_cookie = document.createElement("p");
    e_cookie.innerHTML = `${x} => ${new Cookie(x_n).getValue() || 0}`;
    let e_ls = document.createElement("p");
    e_ls.innerHTML = `${x} => ${new HistoryInLocalStorage(x_n).getValue() || 0}`;

    document.getElementById("card-current-session-history")?.appendChild(e_cookie);
    document.getElementById("card-all-history")?.appendChild(e_ls);
  });
});

var currentDocument = "_";

function setCurrentDocument(name)
{
  currentDocument = normalizeName(name || currentDocument);
}

function normalizeName(name)
{
  return (name + "").replace("/", "_");
}

export { setCurrentDocument }
