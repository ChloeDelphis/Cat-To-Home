<template>
      <footer class="footer">
        <div class="footer__visuals">
            <img class="footer__visuals__logo" src="../assets/logo/Logo-white.png" alt="Logo Cat To Home blanc">

            <div class="footer__visuals__social-media">
                <a class="footer__visuals__social-media__item" href="#"> <img src="../assets/icones/insta.png"
                        alt="logo insta">
                </a>
                <a class="footer__visuals__social-media__item" href="#"> <img src="../assets/icones/facebook.png"
                        alt="loho facebook">
                </a>
                <a class="footer__visuals__social-media__item" href="#"> <img src="../assets/icones/twitter.png"
                        alt="logo twitter">
                </a>
                <a class="footer__visuals__social-media__item" href="#"> <img src="../assets/icones/tiktok.png"
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
                <a class="footer__nav__item" href="#">Les chats</a>
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
@use "../../abstracts/variables/colors";
@use "../../abstracts/variables/font";

.footer {
    background-color: colors.$color-orange;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 5rem 1.5rem;

    a{
        &:hover{
            color: colors.$color-blue;
        }
    }

    &__visuals {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;


        &__logo {
            width: 70%;
            margin-bottom: 1rem;
        }

        &__social-media {
            padding: 2rem;
            display: flex;
            width: 80%;
            justify-content: space-around;
            align-items: center;

            img {
                width: 80%;
            }
        }

    }

    &__nav {
        display: flex;
        flex-direction: column;
        align-items: center;

        &__left {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        &__right {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        &__item {
            text-decoration: none;
            color: white;
            padding: 0.5rem;
        }
    }
}

@media (min-width : 425px) {
    .footer{

        font-size: 1.5rem;
    }
}



@media (min-width : 767px) {
    // A partir de 767px (format tablette) on va afficher 

    .footer {
        padding: 3rem 4rem;
        flex-direction: row;
        justify-content: space-between;

        &__visuals {

            align-items: center;
            flex-basis: 40%;

        }

        &__nav {
            flex-direction: row;


            &__left {
                align-items: flex-start;
                padding-right: 2rem;
            }

            &__right {
                align-items: flex-start;
                padding-left: 2rem;
            }
        }


    }

}

@media (min-width : 1024px) {
    .footer {
        font-size: 2rem;
    }
}


@media (min-width : 1440px) {
    // A partir de 1440px (format laptop L) on va afficher
    // Des paddings adaptatifs


    .footer {
        padding-right: 10%;
        padding-left: 10%;

        &__nav {
            flex-basis: 50%;
            justify-content: flex-end;

            &__left {
                padding-right: 20%;
            }
        }

    }


}
</style>