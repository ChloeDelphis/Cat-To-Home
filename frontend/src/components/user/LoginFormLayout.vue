<template>
  <main>
    <section class="connexion">
      <img class="connexion__img" src="../../assets/img/illu_cat_door.png"
        alt="chat devant un portail de voyage spatio-temporel" />

      <div class="connexion__form">
        <h2 class="connexion__form__title">Connexion</h2>

        <fieldset class="connexion__form__fieldset">
          <div class="connexion__form__fieldset__field">
            <label for="email">Adresse e-mail</label><br />
            <input class="connexion__form__fieldset__field__input input" type="text" />
          </div>
          <div class="connexion__form__fieldset__field">
            <label for="password">Mot de passe</label><br />
            <input class="connexion__form__fieldset__field__input input" type="password" />
          </div>
        </fieldset>

        <button class="connexion__form__button button__orange--papate">
          Je me connecte
        </button>
      </div>
    </section>
  </main>
</template>

<script>
export default {};
</script>

<style lang="scss">
@use "../assets/scss/abstracts/variables/colors";
@use "../assets/scss/abstracts/variables/font";

.connexion {
  color: white;
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 10rem;

  &__img {
    margin: 3rem 0;
    width: 55%;
  }

  &__form {
    background-color: colors.$color-bg2;
    width: 100%;
    padding: 5rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    &__title {
      margin-bottom: 2rem;
    }

    &__fieldset {
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;

      &__field {
        margin-bottom: 2rem;
        width: 100%;

        &__input {
          width: 100%;
        }
      }
    }

    &__button {
      margin-top: 1rem;
    }
  }
}

@media (min-width: 768px) {
  // A partir de 768px (tablette)

  .connexion__form {
    &__fieldset__field {
      width: 70%;
    }
  }
}

@media (min-width: 1024px) {
  // A partir de 1024 px (laptop)

  .connexion {
    padding: 5rem;
    margin-bottom: 5rem;
    flex-direction: row;
    align-items: stretch;

    &__img {
      margin: 0;
      padding-right: 5rem;
      width: 50%;
    }

    &__form {
      &__title {
        margin-bottom: 5rem;
      }

      &__fieldset__field {
        width: 90%;
      }

      &__button {
        margin-top: 5rem;
      }
    }
  }
}
</style>