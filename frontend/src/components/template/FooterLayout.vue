<template>
  <footer class="footer">
    <div class="footer__visuals">
      <img
        class="footer__visuals__logo"
        src="../../assets/logo/Logo.svg"
        alt="Logo Cat To Home blanc"
      />

      <div class="footer__visuals__social-media">
        <a class="footer__visuals__social-media__item" href="#">
          <img src="../../assets/icones/insta.png" alt="logo insta" />
        </a>
        <a class="footer__visuals__social-media__item" href="#">
          <img src="../../assets/icones/facebook.png" alt="loho facebook" />
        </a>
        <a class="footer__visuals__social-media__item" href="#">
          <img src="../../assets/icones/twitter.png" alt="logo twitter" />
        </a>
        <a class="footer__visuals__social-media__item" href="#">
          <img src="../../assets/icones/tiktok.png" alt="logo tiktok" />
        </a>
      </div>
    </div>
    <nav class="footer__nav">
      <div class="footer__nav__left">
        <router-link class="footer__nav__item" :to="{ name: 'home' }"
          >Homepage</router-link
        >
        <router-link class="footer__nav__item" :to="{ name: 'about' }"
          >À propos</router-link
        >
        <router-link class="footer__nav__item" :to="{ name: 'contact' }"
          >Contact</router-link
        >
      </div>
      <div class="footer__nav__right">
        <router-link class="footer__nav__item" v-bind:to="{ name: 'cats' }"
          >Les chats</router-link
        >
        <router-link
          v-if="!this.$store.getters.getToken"
          class="footer__nav__item"
          :to="{ name: 'registration' }"
          >Inscription</router-link
        >
        <router-link
          v-if="!this.$store.getters.getToken"
          class="footer__nav__item"
          :to="{ name: 'login' }"
          >Connexion</router-link
        >
        <!-- <a class="footer__nav__item" href="#">Déconnexion</a> -->
        <router-link class="footer__nav__item" :to="{ name: 'legals-mention' }"
          >Mentions Légales</router-link
        >
      </div>
    </nav>
    <div class="footer__mention">
      <p>
        Ce site a été réalisé grâce à Antoine et sa meuf. Nous avons utilisés
        les images de
        <a
          style="text-decorations: none; color: inherit"
          href="https://www.icones8.fr"
          >icones8.</a
        >
      </p>
    </div>
  </footer>
</template>

<script>
export default {};
</script>

<style lang="scss">
</style>