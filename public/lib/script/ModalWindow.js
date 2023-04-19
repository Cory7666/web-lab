class ModalWindow
{
  constructor(modalWindowCharacteristics)
  {
    this.text = modalWindowCharacteristics.text || "Default text.";
    this.onSuccess = modalWindowCharacteristics.onSuccess || ((event) => { });
    this.onDeny = modalWindowCharacteristics.onDeny || ((event) => { event.preventDefault(); event.stopPropagation(); });

    $(modalWindowCharacteristics.targetElementSelector)
      .click(
        event =>
        {
          event.stopPropagation();
          event.preventDefault();
          this.show();
        }
      );
  }

  show()
  {
    $("<div>")
      .addClass("modal-window-container")
      .click(
        (event) =>
        {
          if ($(event.target).hasClass("button-success"))
          {
            this.onSuccess(event);
          }
          else if ($(event.target).hasClass("button-deny"))
          {
            this.onDeny(event);
          }
          this.hide();
        }
      )
      .append(
        $("<div>")
          .addClass("modal-window")
          .append(
            $("<div>")
              .addClass("modal-window-text")
              .text(this.text)
          )
          .append(
            $("<div>")
              .addClass("modal-window-buttons")
              .append(
                $("<button>")
                  .addClass("button-success")
                  .text("Да")
              )
              .append(
                $("<button>")
                  .addClass("button-deny")
                  .text("Нет")
              )
          )
      )
      .appendTo(
        $(document.body)
      )
  }

  hide()
  {
    $(".modal-window-container").remove();
  }
}

class ModalWindowCharacteristics
{
  constructor(targetElementSelector, text, onSuccess, onDeny)
  {
    this.targetElementSelector = targetElementSelector || "body";
    this.text = text || "Default text.";
    this.onSuccess = onSuccess || ((event) => { });
    this.onDeny = onDeny || ((event) => { event.preventDefault(); event.stopPropagation(); });
  }
}

export { ModalWindow, ModalWindowCharacteristics }
