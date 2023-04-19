'use strict';

class HorriblePersonData
{
  constructor(x)
  {
    this.x = x;
  }

  isFIO()
  {
    return /\w{1,}\s\w{1,}\s\w{1,}/gm.test(this.x);
  }

  isTelephoneNumber()
  {
    return /^\+[7|3][0-9]{9,11}$/.test(this.x);
  }

  isAge()
  {
    return /[0-9]{1,3}/gm.test(this.x);
  }

  isEmail()
  {
    return /\w{1,}@\w{1,}\.\w{2,5}/gm.test(this.x);
  }

  isGroup()
  {
    return /\w{2,3}\/\w{1}-[0-9]{2}-[0-9]{1,2}-\w{1}/gmu.test(this.x);
  }
}
