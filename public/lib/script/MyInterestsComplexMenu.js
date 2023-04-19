import { consoleLog } from "/lib/script/ConsoleLog.js"

const removeDelay = 100

class MyInterestsComplexMenu
{
  constructor(targetMenuItemId)
  {
    consoleLog.add("DEBUG", "MyInterestsComplexMenu#constructor", "Создать #" + this.constructSubmenuId(targetMenuItemId) + " подменю для #" + targetMenuItemId + ".")

    this.element = document.getElementById(targetMenuItemId)
    this.submenu = this.constructSubmenu(this.constructSubmenuId(targetMenuItemId))
    this.element.addEventListener("mouseover", (event) =>
    {
      if (this.removeElementTimeout != undefined)
      {
        clearTimeout(this.removeElementTimeout)
      }
      else
      {
        consoleLog.add("DEBUG", "MyInterestsComplexMenu#mouseoverEventHandler", "Создать подменю #" + this.submenu.id + ".")
        document.body.append(this.submenu)
      }
    })

    this.element.addEventListener("mouseout", (event) =>
    {
      consoleLog.add("DEBUG", "MyInterestsComplexMenu#mouseoutEventHandler", "Уничтожить подменю #" + this.submenu.id + ".")
      this.removeElementTimeout = setTimeout(() =>
      {
        this.removeElementTimeout = undefined
        document.getElementById(this.submenu.id).remove()
      }, removeDelay)
    })
  }

  constructSubmenu(targetMenuItemId)
  {
    const elementCharacteristics = this.element.getBoundingClientRect();

    const mainObject = document.createElement("div");
    mainObject.id = targetMenuItemId;
    mainObject.style.position = "absolute";
    mainObject.style.top = `${elementCharacteristics.top + elementCharacteristics.height}px`;
    mainObject.style.left = `${elementCharacteristics.left}px`;
    mainObject.style.width = `${elementCharacteristics.width}px`;

    [
      ["Об авторе", "/about/#about-me-part"],
      ["Интересы", "/about/#interests-part"],
      ["Учёба", "/about/#study-part"],
      ["Контакты", "/about/#study-part"]
    ].forEach(referenceDescription =>
    {
      let mainObjectItem = document.createElement("a")
      mainObjectItem.style.display = "block"
      mainObjectItem.innerHTML = referenceDescription[0]
      mainObjectItem.href = referenceDescription[1]
      mainObject.appendChild(mainObjectItem)
    })

    mainObject.addEventListener("mouseover", event =>
    {
      clearTimeout(this.removeElementTimeout)
    })

    mainObject.addEventListener("mouseout", event =>
    {
      this.removeElementTimeout = setTimeout(() =>
      {
        this.removeElementTimeout = undefined
        document.getElementById(this.submenu.id).remove()
      }, removeDelay)
    })

    return mainObject
  }

  constructSubmenuId(menuItemId)
  {
    return menuItemId + "-submenu"
  }
}

export { MyInterestsComplexMenu }
