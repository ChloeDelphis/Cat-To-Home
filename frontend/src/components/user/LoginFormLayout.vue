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
</style>