class Note
{
  constructor(elementSelector, text)
  {
    this.elementSelector = elementSelector || "body";
    this.text = text || "Default message.";

    $(elementSelector)
      .mouseover(
        event =>
        {
          this.show();
        }
      )
      .mouseout(
        event =>
        {
          this.hide();
        }
      );
  }

  show()
  {
    let element = document.getElementById(this.elementSelector);
    $("<div>")
      .attr("id", this.elementSelector + "-note")
      .addClass("note")
      .css("position", "absolute")
      .css("left", `${element.offsetLeft() + element.offsetWidth()}px`)
      .css("top", `${element.offsetTop()}px`)
      .css("width", `10vw`)
      .text(this.text)
      .appendTo(
        $(document.body)
      );
  }

  hide()
  {
    $(`#${this.elementSelector}-note`).remove();
  }
}

export { Note }
