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
          v-if="
            this.$store.getters.getToken &&
            this.$store.getters.getRole !== 'adopter'
          "
          class="header__nav__don button__orange--papate"
          :to="{ name: 'cat_add' }"
          >Je donne un chat</router-link
        >

        <router-link
          v-on:click="sendMessage"
          v-if="!this.$store.getters.getToken"
          class="header__nav__don button__orange--papate"
          :to="{ name: 'login' }"
          >Je donne un chat</router-link
        >

        <router-link class="header__nav__menu header__nav__menu__hover" :to="{ name: 'about' }"
          >À propos</router-link
        >
        <router-link class="header__nav__menu header__nav__menu__hover" :to="{ name: 'cats' }"
          >Les chats</router-link
        >
        <router-link class="header__nav__menu header__nav__menu__hover" :to="{ name: 'contact' }"
          >Contact</router-link
        >

        <router-link
          v-if="!this.$store.getters.getToken"
          id="mon_espace"
          class="header__nav__menu"
          :to="{ name: 'login' }"
          >Mon Espace</router-link
        >
        <router-link :to="{ name: 'login' }"
          class="header__nav__menu header__nav__menu__hover"
          v-if="this.$store.getters.getToken"
          v-on:click="disconnect"
          >Déconnexion</router-link
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
    async sendMessage(){
      this.$store.commit('setMessage', 'Vous devez être connecté pour pouvoir ajouter un chat.');
    },

    disconnect() {
      // On execute la mutation qui va supprimer le token dans le store et dans le sessionStorage
      this.$store.dispatch("deleteUser");
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

      burgerElmnt.style.display = "block";
      crossElmnt.style.display = "none";
    }
  },
};
</script>

<style lang="scss">
.header__nav__menu {
  position: relative;
}

.header__nav__menu::after {
  content: "";
  position: absolute;
  background: #e16441;
  height: 2px;
  width: 0%;
  left: 0;
  bottom: -0.3rem;
  transform-origin: right;
  transition: 0.3s cubic-bezier(0.65, 0.05, 0.36, 1);
}

.header__nav__menu:hover::after {
  width: 100%;
  transform: scale(1);
}

#cross {
  display: none;
  font-size: 4rem;
}

#mon_espace {
  color: #E16441;
}

#mon_espace:hover {
  color: #586FCD;
}
</style>