import { DateTimeFormat } from "/lib/script/DateTimeFormat.js"

const datetimePlaceholder = document.getElementById("datetime-placeholder")

function update()
{
  let variant = datetimePlaceholder.dataset.variant || 0;
  let dateTimeFormatObject = new DateTimeFormat(new Date());

  datetimePlaceholder.innerHTML = (
    variant == 0 ? dateTimeFormatObject.getFirstVariant()
      : variant == 1 ? dateTimeFormatObject.getSecondVariant()
        : variant == 2 ? dateTimeFormatObject.getThirdVariant()
          : dateTimeFormatObject.getFourVariant()
  );
}

setInterval(() =>
{
  update();
}, 1000);
datetimePlaceholder.addEventListener("click", (event) =>
{
  let oldVariant = event.target.dataset.variant || 0;
  event.target.dataset.variant = (oldVariant - 0 + 1) % 4;
  event.stopPropagation();
  update();
}
);

update();
