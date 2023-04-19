'use strict';

class HorribleTestData
{
  constructor(x)
  {
    this.x = x;
  }

  isFirstQuestionAnswer()
  {
    return /^[\w]+(\s+[\w]+){0,24}$/.test(this.x);
  }
}
