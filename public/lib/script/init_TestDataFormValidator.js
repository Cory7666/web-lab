function validateForm(e)
{
  let form = document.forms[0];
  function kill(event)
  {
    event.stopPropagation();
    return true;
  }
  function clearAndFocus(element)
  {
    element.value = "";
    element.focus();
  }

  let name = form.elements.name;
  let answer1 = form.elements.answer1;
  
  if (!(new HorriblePersonData(name.value).isFIO()))
  {
    alert("ФИО введено некорректно.");
    clearAndFocus(name);
    return kill(e);
  }
  else if (!(new HorribleTestData(answer1.value).isFirstQuestionAnswer()))
  {
    console.log(new HorribleTestData(answer1.value).isFirstQuestionAnswer());
    alert("Требования к ответу 1 не удовлетворены.");
    clearAndFocus(answer1);
    return kill(e);
  }
  else
  {
    form.submit();
    return false;
  }

}

document.addEventListener("DOMContentLoaded", () =>
{
  document.getElementById("submitButton").addEventListener("click", validateForm, true);
});
