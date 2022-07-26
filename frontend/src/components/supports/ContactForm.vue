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
              class="connexion__form__fieldset__field__input input"
              type="text"
            />
          </div>
          <div class="contact__form__fieldset__field">
            <label for="email">Adresse e-mail</label><br />
            <input
              class="contact__form__fieldset__field__input input"
              type="text"
            />
          </div>
          <div class="contact__form__fieldset__field">
            <label for="message">Message</label><br />

            <textarea
              class="contact__form__fieldset__field__input input"
              name="message"
              id="message"
              rows="10"
            ></textarea>
          </div>
        </fieldset>

        <button class="contact__form__button button__orange">Envoyer</button>
      </div>
    </section>
  </main>
</template>

<script>
export default {};
</script>

<style>
</style>