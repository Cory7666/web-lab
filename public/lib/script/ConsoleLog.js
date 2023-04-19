class ConsoleLog
{
  constructor()
  {
    this.add("INFO", "ConsoleLog", "Объект логгера создан.")
  }

  add(warnLevel, who, message)
  {
    console.log("[" + who + "][" + warnLevel + "] " + message)
  }
}

const consoleLog = new ConsoleLog()

export { consoleLog }
