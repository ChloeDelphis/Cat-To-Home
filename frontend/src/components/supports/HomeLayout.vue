<template>
  <main>
        <section class="home home__response__reverse">
            <div class="home__bloc__text">
                <h2 class="home__title">Tu cherches a donner ou adopter un chat ? Tu es au bon endroit ! </h2>
                <p class="home__paragraph">Cat To Home est un site web dédié à la sensibilisation au problème de
                    l’abandon d’animaux et se veut être une solution complémentaire aux refuges pour permettre
                    l’adoption d’un animal et mettant en relation des particuliers propriétaires d’animaux et des
                    personnes souhaitant en adopter.</p>
                <a class="button__orange--papate" href="">Je donne un chat</a>
            </div>
            <div class="home__img">
                <img class="cat__one" src="../assets/img/IMG_CAT1.png" alt="">
            </div>
        </section>

        <!-- Formulaire de recherche -->
        <section class="home home__response bg__orange">
            <div class="home__img">
                <img src="../assets/img/IMG_CAT2.png" alt="Chat tenu par des bras sortant d'un vortex">
            </div>
            <div class="home__bloc__text">
                <h2 class="home__title">Trouve ton futur compagnon félin !</h2>
                <form class="home__form" action="">
                    <label class="home__form__label" for="department">Localisation</label>
                    <select class="input" name="departement" id="department">
                        <option value="" selected>Département</option>
                        <option value="Finistère">29 - Finistère</option>
                        <option value="Morbihan">56 - Morbihan</option>
                        <option value="Côtes d'Armor">22 - Côtes d'Armor</option>
                        <option value="Ille-et-Vilaine">35 - Ille-et-Vilaine</option>
                    </select>
                    <br>
                    <label class="home__form__label" for="filter">Filtre de recherche</label>
                    <select class="input" name="filter" id="filter">
                        <option value="anciens" selected>Du plus anciens au plus récent</option>
                        <option value="recents">Du plus récent au plus anciens</option>
                        <option value="age">Âge</option>
                    </select>
                    <button class="button__orange--papate" type="submit">Je trouve mon chat</button>
                </form>
            </div>
        </section>

        <!-- Carrousel -->
        <section>
            <h2 class="home__title home__title__carrousel">Il attendent un foyer depuis longtemps...!</h2>
            <div class="home">
                <a href=""><img class="arrow" src="../assets/icones/fleche_gauche.png" alt=""></a>
                 
                <!-- composant cards -->
                
                <a href=""><img class="arrow" src="../assets/icones/fleche_droite.png" alt=""></a>
            </div>

        </section>

        <section class="home home__response bg__blue">
            <div class="home__img">
                <img src="../assets/img/IMG_CAT3.png" alt="">
            </div>
            <div class="home__bloc__text">
                <h2 class="home__title home__title__abandonment">L’abandon en France</h2>
                <p class="home__paragraph">Selon des estimations, ce serait chaque année plus de 100 000 animaux
                    abandonnés en France, dont 60 000 d’entre eux durant la période estivale.
                    L’année 2021 a notamment connu un record d’abandon d’animaux, surtout les chats et les nouveaux
                    animaux de compagnie (NACs).
                    « Le recueil aurait augmenté de 25 % sur le mois de juin 2021 par rapport à 2019. En cause, les
                    achats irresponsables et impulsifs d’animaux durant les différents confinements, afin de pouvoir
                    sortir ou s’occuper. Une fois la vie normale reprise, les animaux sont abandonnés car ils ont besoin
                    de trop de temps et de ressources » déplore la porte-parole de l’association de défense des droits
                    des animaux.
                </p>
            </div>
        </section>

        <section class="home home__response">
            <div class="home__bloc__text">
                <h2 class="home__title">Les limites des refuges</h2>
                <p class="home__paragraph">Chaque année la fourrière confie à la SPA en moyenne 46 000 animaux. Cela
                    représente 3600 par mois, pour 7000 places au total. Hors la règle pour les fourrières régies par
                    les collectivités territoriales, c’est que les animaux qu’elles ne peuvent plus confier à des
                    associations doivent être euthanasiés.</p>
            </div>
            <div class="home__img">
                <img src="../assets/img/IMG_CAT4.png" alt="">
            </div>
        </section>

    </main>

</template>

<script>
export default {
name: "HomeLayout",
}
</script>

<style scoped lang="scss">

@use '../../abstracts/variables/colors';
@use "../../abstracts/variables/font";

@media screen and (max-width: 768px) {
    .home {

        &__response {
            flex-direction: column;
            padding: 2rem 0;

            &__reverse {
                flex-direction: column-reverse;
                margin-left: 2em;
                margin-right: 2rem;
            }
        }

        .post__none {
            display: none;
        }
    }
}


.home {
    color: colors.$color-blue;
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    padding: 6rem 0;


    &__title__carrousel {
        padding: 0 2rem;
        text-align: center;
    }

    &__bloc__text {
        max-width: 40rem;
        margin: 5% 5%;
    }

    &__title,
    &__paragraph {
        margin-bottom: 4rem;
    }

    &__img {
        text-align: center;

        img {
            width: 80%;
        }

        &__cat {
            width: 20rem;
        }
    }

    &__form {
        display: flex;
        flex-direction: column;
        width: 100%;

        &__label {
            margin-bottom: 1rem;
        }

        .button__orange--papate {
            margin-top: 5rem;
            width: 24rem;
        }
    }

    &__title {
        margin-top: 10rem;
        color: colors.$color-blue;
        &__abandonment {
        color: white;
    }
    }
}

.bg__blue {
    background-color: colors.$color-blue;
    color: white;
}

.bg__orange {
    background-color: colors.$color-bg2;
}
</style>