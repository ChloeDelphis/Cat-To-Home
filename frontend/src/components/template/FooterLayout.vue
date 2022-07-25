<template>
    <footer class="footer">
        <div class="footer__visuals">
            <img class="footer__visuals__logo" src="../../assets/logo/Logo-white.png" alt="Logo Cat To Home blanc">

            <div class="footer__visuals__social-media">
                <a class="footer__visuals__social-media__item" href="#"> <img src="../../assets/icones/insta.png"
                        alt="logo insta">
                </a>
                <a class="footer__visuals__social-media__item" href="#"> <img src="../../assets/icones/facebook.png"
                        alt="loho facebook">
                </a>
                <a class="footer__visuals__social-media__item" href="#"> <img src="../../assets/icones/twitter.png"
                        alt="logo twitter">
                </a>
                <a class="footer__visuals__social-media__item" href="#"> <img src="../../assets/icones/tiktok.png"
                        alt="logo tiktok">
                </a>
            </div>
        </div>
        <nav class="footer__nav">
            <div class="footer__nav__left">
                <a class="footer__nav__item" href="#">Homepage</a>
                <a class="footer__nav__item" href="#">À propos</a>
                <a class="footer__nav__item" href="#">Contact</a>
            </div>
            <div class="footer__nav__right">
                <router-link class="footer__nav__item" v-bind:to="{name: 'cats'}">Les chats</router-link>
                <a class="footer__nav__item" href="#">Inscription</a>
                <a class="footer__nav__item" href="#">Connexion</a>
                <!-- <a class="footer__nav__item" href="#">Déconnexion</a> -->
                <a class="footer__nav__item" href="#">Mentions Légales</a>
            </div>
        </nav>
    </footer>
</template>

<script>
export default {

}
</script>

<style lang="scss">
</style>