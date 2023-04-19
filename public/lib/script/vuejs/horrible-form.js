import { createApp } from "./vue.esm-browser.js";
import { HorriblePersonData } from "../HorriblePersonData.esm.js";

const app = createApp({
  data()
  {
    return {
      form:
      {
        date:
        {
          id: "dateField",
          name: "date",
          text: "Дата",
          data: ""
        },

        name:
        {
          id: "nameField",
          name: "name",
          text: "ФИО",
          data: ""
        },

        sex:
        {
          name: "sex",
          data: ""
        },

        age:
        {
          id: "ageField",
          name: "age",
          text: "Возраст",
          data: 18
        },

        telephoneNumber:
        {
          id: "telNumField",
          name: "telnum",
          text: "Тел.",
          data: ""
        },

        email:
        {
          id: "emailField",
          name: "email",
          text: "Email",
          data: ""
        },
      },

      sexOptions: Object.freeze({
        m: {
          id: "maleSexField",
          text: "Мужской",
          value: "m"
        },
        f: {
          id: "femaleSexField",
          text: "Женский",
          value: "f"
        },
        other: {
          id: "otherSexField",
          text: "Песец",
          value: "o"
        }
      })
    };
  },

  computed:
  {
    errors()
    {
      const errContainer = [];

      if (!new HorriblePersonData(this.form.name.data).isFIO())
      {
        errContainer.push({ text: "Неверные ФИО." });
      }

      if (!new HorriblePersonData(this.form.age.data).isAge())
      {
        errContainer.push({ text: "Неверный возраст." });
      }

      if (!new HorriblePersonData(this.form.telephoneNumber.data).isTelephoneNumber())
      {
        errContainer.push({ text: "Неверный номер телефона." });
      }

      if (!new HorriblePersonData(this.form.email.data).isEmail())
      {
        errContainer.push({ text: "Неверный email." });
      }

      return errContainer;
    }
  }
});

app.component("radio-field", {
  props: ["id", "name", "vm", "val", "text"],
  template: `
    <label :for="id">{{ text }}</label>
    <input :id="id" type="radio" :name="name" :value="val" v-model="vm" />
  `
});

app.component("error-message", {
  props: ["header", "text"],
  template: `
  <div class="message e-m">
    <div class="message-header">{{ header }}</div>
    <div class="message-body">{{ text }}</div>
  </div>
  `
});

app.mount("#contactsForm");
