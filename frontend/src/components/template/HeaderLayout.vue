<template>
      <header class="header">

        <h1>
            <a href="#"><img class="header__logo" src="../assets/logo/Logo.png" alt="logoCatToHome">
            </a>
        </h1>
        <nav class="header__nav">

            <div class="header__nav--mobtab">
                <a href="#">|||</a>
            </div>

            <!-- pour faire apparaître le menu en mode mobile et tablette :
                Ajouter la classe header__nav--small à la div ci-dessous
            Ajouter la classe fixed à l'élément header  -->

            <div class="header__nav--desktop">
                <a class="header__nav__don button__orange--papate" href="#">
                    Je donne un chat</a>
                <a class="header__nav__menu" href="#">À propos</a>
                <a class="header__nav__menu" href="#">Les chats</a>
                <!-- <a class="header__nav__menu" href="#">Inscription</a>
                <a class="header__nav__menu" href="#">Connexion</a>
                <a class="header__nav__menu" href="#">Déconnexion</a> -->

                <a class="header__nav__menu" href="#">Contact</a>
                <a class="header__nav__profile" href="#"><img class="header__nav__profile--icon"
                        src="../assets/icones/profil.png" alt="icône vers profil utilisateur"><span
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
@use "../../abstracts/variables/colors";
@use "../../abstracts/variables/font";


// Créé en mobile-first
// On veut que le menu burger soit visible
// En format mobile et tablette
// Pour afficher le menu sur ce format
// On ajoute la classe header__nav--small
// A l'élément qui a la classe header__nav--desktop


// le menu classique est visible en laptop à 1024px

.fixed{
    position: fixed;
    top : 0%;
    left: 0%;
    width: 100vw;
}

.header {

    background-color: colors.$color-bg1;
    padding: 2rem 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;

    &__logo {
        width: 10rem;
    }

    &__nav {

        &--desktop {
            display: none;
        }

        &--small{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: fixed;
            background-color: colors.$color-bg1;
            width: 100vw;
            height: 100vh;
            top : 8rem;
            left: 0rem;
        }
        
        &__don{
            padding: 2rem;
            margin-bottom: 2rem;
            color: white;
        }

        &__menu{
            padding : 2rem;
            color: colors.$color-blue;

        }

        &__profile{
            padding : 2rem;
            &--text{
                color: colors.$color-orange;
            }

            &--icon{
            display: none;
        }
    }

        &--mobtab {
            font-size: 2rem;
            font-weight: 700;
            transform: rotate(90deg);
            
            a{
                color: colors.$color-blue;
            }

        }
    }
}


@media (min-width : 767px) {

    // A partir de 767px (format tablette) on va afficher 
    // le logo en plus grand...
    .header {

        padding: 2rem 4rem;

        &__logo {
            width: 15rem;
        }
    }

}


@media (min-width : 1024px) {
    // A partir de 1024px (format laptop) on va afficher
    // Le menu complet et retirer le burger
    // L'icône profil et retirer le texte "profil"



    .header {

        padding: 2rem 4rem;

        &__nav {

            &__logo {
                width: 20rem;
            }

            &--desktop {
                display: flex;
                align-items: center;
            }

            &__menu:hover{
                color: colors.$color-orange;
            }

            &__don{
                color: white;
                padding: 1rem;
                margin-right: 6rem;
                margin-bottom: 0rem;
            }

            &__menu {
                padding: 1rem;
            }

            &__profile {
                padding: 1rem;

                &--text {
                    display: none;
                }

                &--icon {
                    display: inline;
                    width: 3rem;
                    
                }
            }

            &--mobtab {
                display: none;
            }
        }
    }

}

@media (min-width : 1440px) {

    // A partir de 1440px
    // on veut décaler le bouton don de chat
    .header {

        &__nav{

            &__don{
                margin-right: 8rem;
            }
        
            &__menu {
            padding: 2rem;
            }
        }
    }
}
</style>