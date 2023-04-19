class HistoryInLocalStorage
{
  constructor(name)
  {
    this.name = name;
  }

  getValue()
  {
    return localStorage.getItem(this.name);
  }

  setValue(value)
  {
    localStorage.setItem(this.name, value);
  }

  incrementValue()
  {
    this.setValue((this.getValue() || 0) - 0 + 1);
  }
}

export { HistoryInLocalStorage };

