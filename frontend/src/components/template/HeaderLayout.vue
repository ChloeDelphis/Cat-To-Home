<template>
  <header class="header" id="header">
    <h1>
      <router-link :to="{ name: 'home' }"
        ><img
          class="header__logo"
          src="../../assets/logo/Logo.png"
          alt="logoCatToHome"
        />
      </router-link>
    </h1>
    <nav class="header__nav">
      <div class="header__nav--mobtab">
        <a id="burger" href="#">|||</a>
        <a id="cross" href="#">&#10060;</a>
      </div>

      <!-- pour faire apparaître le menu en mode mobile et tablette :
                Ajouter la classe header__nav--small à la div ci-dessous
            Ajouter la classe fixed à l'élément header  -->

      <div id="menu" class="header__nav--desktop">
        <router-link
          v-if="this.$store.getters.getToken && this.$store.getters.getRole !== 'adopter'"
          class="header__nav__don button__orange--papate"
          :to="{ name: 'cat_add' }"
          >Je donne un chat</router-link
        >
        <router-link
          v-if="!this.$store.getters.getToken"
          class="header__nav__don button__orange--papate"
          :to="{ name: 'registration' }"
          >Je donne un chat</router-link
        >

        <router-link class="header__nav__menu" :to="{ name: 'about' }"
          >À propos</router-link
        >
        <router-link class="header__nav__menu" :to="{ name: 'cats' }"
          >Les chats</router-link
        >
        <router-link
          v-if="!this.$store.getters.getToken"
          class="header__nav__menu"
          :to="{ name: 'registration' }"
          >Inscription</router-link
        >
        <router-link
          v-if="!this.$store.getters.getToken"
          class="header__nav__menu"
          :to="{ name: 'login' }"
          >Connexion</router-link
        >
        <a class="header__nav__menu" href="#">Contact</a>

        <a
          class="header__nav__menu"
          v-if="this.$store.getters.getToken"
          v-on:click="disconnect"
          >Déconnexion</a
        >
        <router-link
          class="header__nav__profile"
          v-if="this.$store.getters.getToken"
          :to="{
            name: 'profile',
            params: { id: this.$store.getters.getUserId },
          }"
          ><img
            class="header__nav__profile--icon"
            src="../../assets/icones/profil.png"
            alt="icône vers profil utilisateur"
          /><span class="header__nav__profile--text">Profil</span></router-link
        >
      </div>
    </nav>
  </header>
</template>

<script>
export default {
  name: "HeaderLayout",
  methods: {
    disconnect() {
      // On execute la mutation qui va supprimer le token dans le store et dans le sessionStorage
      this.$store.commit("deleteToken");
      this.$store.commit('deleteRole');
      // On redirige l'utilisateur
      this.$router.push({ name: "login" });
    },
  },
  mounted() {
    const headerElmnt = document.querySelector("#header");
    const burgerElmnt = document.querySelector("#burger");
    const crossElmnt = document.querySelector("#cross");
    const menu = document.querySelector("#menu");

    burgerElmnt.addEventListener("click", displaySmallMenuHandle);

    function displaySmallMenuHandle() {
      menu.classList.remove("header__nav--desktop");
      menu.classList.add("header__nav--small");
      headerElmnt.classList.add("fixed");

      burgerElmnt.style.display = "none";
      crossElmnt.style.display = "block";
    }

    crossElmnt.addEventListener("click", displayDesktopMenuHandle);

    function displayDesktopMenuHandle() {
 
      menu.classList.remove("header__nav--small");
      menu.classList.add("header__nav--desktop");
      headerElmnt.classList.remove("fixed");

      burgerElmnt.style.display="block";
      crossElmnt.style.display="none";
    } 
  }
};
</script>

<style lang="scss">
#cross {
  display: none;
  font-size: 4rem;
}
</style>