import { consoleLog } from "./ConsoleLog.js";

class ImageFrame
{
  constructor(photos, index)
  {
    this.photos = photos;
    this.index = index;
  }

  show()
  {
    $(document.body)
      .append(createNode(this));
  }

  hide()
  {
    $(".image-frame-container")
      .remove();
  }
}

function createNode(imageFrameObject)
{
  return $("<div>")
    .addClass("image-frame-container")
    .append(
      $("<div>")
        .addClass("image-frame-content")
        .click(
          (event) => 
          {
            imageFrameObject.hide();
          }
        )
        .append(
          $("<img>")
            .attr("src", imageFrameObject.photos[imageFrameObject.index].url)
            .attr("alt", imageFrameObject.photos[imageFrameObject.index].title)
            .attr("title", imageFrameObject.photos[imageFrameObject.index].title)
        )
    )
    .append(
      $("<div>")
        .addClass("image-frame-navigation")
        .click(
          (event) => 
          {
            if ($(event.target).hasClass("button-prev") && imageFrameObject.index > 0)
            {
              consoleLog.add("DEBUG", ".image-frame-navigation#clickHandle", "Показать предыдущую картинку.");
              imageFrameObject.hide();
              new ImageFrame(imageFrameObject.photos, imageFrameObject.index - 1).show();
            }
            else if ($(event.target).hasClass("button-next") && imageFrameObject.index < imageFrameObject.photos.length - 1)
            {
              consoleLog.add("DEBUG", ".image-frame-navigation#clickHandle", "Показать следующую картинку.");
              imageFrameObject.hide();
              new ImageFrame(imageFrameObject.photos, (imageFrameObject.index - 0) + 1).show();
            }
          }
        )
        .append(
          $("<span>")
            .addClass("button-prev")
            .text("Prev")
        )
        .append(
          $("<span>")
            .addClass("button-next")
            .text("Next")
        )
    );
}

export { ImageFrame }
