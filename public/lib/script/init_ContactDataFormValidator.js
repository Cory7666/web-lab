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
  let age = form.elements.age;
  let telnum = form.elements.telnum;
  let email = form.elements.email;
  
  if (!(new HorriblePersonData(name.value).isFIO()))
  {
    alert("ФИО введено некорректно.");
    clearAndFocus(name);
    return kill(e);
  }
  else if (!(new HorriblePersonData(age.value).isAge()))
  {
    alert("Возраст введен некорректно.");
    clearAndFocus(age);
    return kill(e);
  }
  else if (!(new HorriblePersonData(telnum.value).isTelephoneNumber()))
  {
    alert("Номер телефона введен некорректно.");
    clearAndFocus(telnum);
    return kill(e);
  }
  else if (!(new HorriblePersonData(email.value).isEmail()))
  {
    alert("Email введен некорректно.");
    clearAndFocus(email);
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
