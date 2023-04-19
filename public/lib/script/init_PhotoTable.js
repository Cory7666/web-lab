import { consoleLog } from "./ConsoleLog.js";
import { ImageFrame } from "./ImageFrame.js";
import { Photo } from "./Photo.js";

const kTableColumnCount = 4;

var photos = [];
var targetTableSelector = `#${"table-content"}`;

$(document).on("DOMContentLoaded", () =>
{
  let preparedPhotos = [];
  for (let index in photos)
  {
    preparedPhotos.push(
      $("<td>")
        .append(
          $("<div>")
            .addClass("image-frame")
            .click(
              (event) =>
              {
                consoleLog.add("DEBUG", "div.image-frame", "Нажатие по картинке.");
                new ImageFrame(photos, index).show();
              }
            )
            .append(
              $("<div>")
                .addClass("if-content")
                .append(
                  $("<img>")
                    .attr("title", photos[index].title)
                    .attr("alt", photos[index].title)
                    .attr("src", photos[index].url)
                )
            )
            .append(
              $("<div>")
                .addClass("if-title")
                .text(`/${photos[index].title}`)
            )
        )
    );
  }

  for (let i = 0; i < kTableColumnCount; ++i)
  {
    let startPosition = i * kTableColumnCount;
    let preparedPhotosSlice = preparedPhotos.slice(startPosition, startPosition + kTableColumnCount);
    let row = $("<tr>").appendTo(targetTableSelector);

    for (let j in preparedPhotosSlice)
    {
      $(preparedPhotosSlice[j]).appendTo(row);
    }
  }
});

function setPhotos(x)
{
  photos = x || [];
}

function setTargetTableSelector(x)
{
  targetTableSelector = x || "";
}

export { setPhotos, setTargetTableSelector }
