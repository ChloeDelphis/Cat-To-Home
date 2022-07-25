<template>
      <header class="header">

        <h1>
            <router-link :to="{name: 'home'}"><img class="header__logo" src="../../assets/logo/Logo.png" alt="logoCatToHome">
            </router-link>
        </h1>
        <nav class="header__nav">

            <div class="header__nav--mobtab">
                <a href="#">|||</a>
            </div>

            <!-- pour faire apparaître le menu en mode mobile et tablette :
                Ajouter la classe header__nav--small à la div ci-dessous
            Ajouter la classe fixed à l'élément header  -->

            <div class="header__nav--desktop">
                <router-link class="header__nav__don button__orange--papate" :to="{name: 'cat_add'}">
                    Je donne un chat</router-link>
                <a class="header__nav__menu" href="#">À propos</a>
                <router-link class="header__nav__menu" v-bind:to="{name: 'cat_list'}">Les chats</router-link>
                <!-- <a class="header__nav__menu" href="#">Inscription</a>
                <a class="header__nav__menu" href="#">Connexion</a>
                <a class="header__nav__menu" href="#">Déconnexion</a> -->

                <a class="header__nav__menu" href="#">Contact</a>
                <a class="header__nav__profile" href="#"><img class="header__nav__profile--icon"
                        src="../../assets/icones/profil.png" alt="icône vers profil utilisateur"><span
                        class="header__nav__profile--text">Profil</span></a>
            </div>

        </nav>

    </header>

</template>

<script>
export default {

}
</script>

<style lang="scss">
</style>