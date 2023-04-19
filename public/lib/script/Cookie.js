class Cookie
{
  constructor(name)
  {
    this.name = name;
  }

  getValue()
  {
    let name = this.name + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++)
    {
      let c = ca[i];
      while (c.charAt(0) == ' ')
      {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0)
      {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

  setValue(value, days)
  {
    const d = new Date();
    d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = this.name + "=" + value + ";" + expires + ";path=/";
  }

  incrementValue()
  {
    this.setValue((this.getValue() || 0) - 0 + 1);
  }
}

export { Cookie };

