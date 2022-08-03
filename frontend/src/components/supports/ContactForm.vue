<template>
  <main>
    <section class="contact">
      <img
        class="contact__img"
        src="../../assets/img/illu_cat_carton.png"
        alt="chat dans un colis"
      />

      <div class="contact__form">
        <h2 class="contact__form__title">Contact</h2>

        <fieldset class="contact__form__fieldset">
          <div class="connexion__form__fieldset__field">
            <label for="name">Prénom et Nom</label><br />
            <input
              v-model="full_name"
              id="name"
              class="connexion__form__fieldset__field__input input"
              type="text"
            />
            <p class="contact__form__errors">{{errors.full_name}}</p>
          </div>
          <div class="contact__form__fieldset__field">
            <label for="email">Adresse e-mail</label><br />
            <input
              v-model="email"
              id="email"
              class="contact__form__fieldset__field__input input"
              type="text"
            />
            <p class="contact__form__errors">{{errors.email}}</p>
          </div>
          <div class="contact__form__fieldset__field">
            <label for="message">Message</label><br />

            <textarea
              v-model="message"
              class="contact__form__fieldset__field__input input"
              name="message"
              id="message"
              rows="10"
            ></textarea>
            <p class="contact__form__errors">{{errors.message}}</p>
          </div>
        </fieldset>

        <button @click="sendContactMail" class="contact__form__button button__orange">Envoyer</button>
        <p class="contact__form__validate">{{isSendMessage}}</p>
      </div>
    </section>
  </main>
</template>

<script>
import ContactService from '@/services/contact/ContactService';

  export default {
    name: 'ContactForm',

    data() {
      return {
        full_name: null,
        email: null,
        message: null,
        errors: {},
        isSendMessage: null
      }
    },
    methods: {
      async sendContactMail() {
        document.body.style.cursor = 'wait';
        this.errors = {};

        if (!this.full_name) {
          this.errors = {...this.errors, full_name: "Le nom et prénom doivent être indiqués"};
        }
        if (!this.email || !this.email.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)) {
          this.errors = {...this.errors, email: "L'email doit être indiqué et avoir le bon format 'test@test.fr'"};
        }
        if (!this.message) {
          this.errors = {...this.errors, message: "Le message doit être indiqué"};
        }

        if (Object.keys(this.errors).length === 0) {
          const response = await ContactService.send({
            "name": this.full_name,
            "email": this.email,
            "content": this.message
          });
          if (response.sended) {
            this.isSendMessage = "Votre message a été envoyé avec succès";
            this.full_name = null;
            this.email = null;
            this.message = null;
          } else {
            this.isSendMessage = "Votre message n'a pas pu être envoyé, merci de réessayer ultérieurement";
          }
        }
        document.body.style.cursor = 'default';
      }
    }
  };
</script>

<style lang="scss" scoped>

.contact__form__errors,
.contact__form__validate {
  padding-top: 0.3rem;
}

.contact__form__erros {
  color: darkred;
}
</style>