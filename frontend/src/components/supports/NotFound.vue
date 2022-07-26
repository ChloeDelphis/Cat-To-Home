<template>
  <main>
    <h1>
      <router-link :to="{ name: 'home' }"
        ><img
          class="header__logo"
          src="../../assets/logo/Logo.png"
          alt="logoCatToHome"
        />
      </router-link>
    </h1>
    <section class="error">
      <img
        class="error__img"
        src="../../assets/img/illu_cat_door.png"
        alt="chat devant un portail de voyage spatio-temporel"
      />

      <div class="error__bloc">
        <h2 class="error__bloc__title">
          Oups ! <br />
          Vous êtes sur une page 404
        </h2>
      </div>
    </section>
  </main>
</template>

<script>
export default {};
</script>

<style>
</style>