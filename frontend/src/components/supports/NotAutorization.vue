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
        src="../../assets/img/purr-sign-in.png"
        alt="chat devant un portail de voyage spatio-temporel"
      />

      <div class="error__bloc">
        <h2 class="error__bloc__title">
          You shall not pass !!! <br />
          <br />
          Vous êtes sur une page 403 <br />
          <br />
          Vous n'avez pas les droits d'accès à cette page <br />
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