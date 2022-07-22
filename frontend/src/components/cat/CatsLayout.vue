<template>
      <main class="cat__list">

        <section class="title">
            <img src="../assets/img/purr-shopping.png" alt="Un chat dans un caddie">
            <h2>Trouve ton futur compagnon félin !</h2>
        </section>

        <!-- FORMULAIRE DE FILTRE DE RECHERCHE -->

        <section class="research">
            <form action="" class="search__cat__form">
                <div>
                    <label for="department">Localisation</label><br>
                    <select name="departement" id="department">
                        <option value="" selected>Département</option>
                        <option value="Finistère">29 - Finistère</option>
                        <option value="Morbihan">56 - Morbihan</option>
                        <option value="Côtes d'Armor">22 - Côtes d'Armor</option>
                        <option value="Ille-et-Vilaine">35 - Ille-et-Vilaine</option>
                    </select>
                </div>
                <div>
                    <label for="filter">Filtre de recherche</label><br>
                    <select name="filter" id="filter">
                        <option value="anciens" selected>Du plus anciens au plus récent</option>
                        <option value="recents">Du plus récent au plus anciens</option>
                        <option value="age">Âge</option>
                    </select>
                </div>

                <button class="button__orange--papate">Je trouve mon chat</button>

            </form>
        </section>

        <!-- LISTE DES CHATS -->

        <section class="post__list">
            <div class="post__list__container">

                <article class="post">
                    <div class="post__img"></div>
                    <div class="post__content">
                        <span class="post__cat__name">Timothy</span>
                        <span class="post__cat__age">8 month</span>
                        <p class="post__cat__localisation"><span class="bold">Localisation</span>- RENNES FRANCE</p>
                    </div>  
                </article> 

                <article class="post">
                    <div class="post__img"></div>
                    <div class="post__content">
                        <span class="post__cat__name">Timothy</span>
                        <span class="post__cat__age">8 month</span>
                        <p class="post__cat__localisation"><span class="bold">Localisation</span>- RENNES FRANCE</p>
                    </div>  
                </article>

                <article class="post">
                    <div class="post__img"></div>
                    <div class="post__content">
                        <span class="post__cat__name">Timothy</span>
                        <span class="post__cat__age">8 month</span>
                        <p class="post__cat__localisation"><span class="bold">Localisation</span>- RENNES FRANCE</p>
                    </div>  
                </article>

                <article class="post">
                    <div class="post__img"></div>
                    <div class="post__content">
                        <span class="post__cat__name">Timothy</span>
                        <span class="post__cat__age">8 month</span>
                        <p class="post__cat__localisation"><span class="bold">Localisation</span>- RENNES FRANCE</p>
                    </div>  
                </article>

                <article class="post">
                    <div class="post__img"></div>
                    <div class="post__content">
                        <span class="post__cat__name">Timothy</span>
                        <span class="post__cat__age">8 month</span>
                        <p class="post__cat__localisation"><span class="bold">Localisation</span>- RENNES FRANCE</p>
                    </div>  
                </article>

                <article class="post">
                    <div class="post__img"></div>
                    <div class="post__content">
                        <span class="post__cat__name">Timothy</span>
                        <span class="post__cat__age">8 month</span>
                        <p class="post__cat__localisation"><span class="bold">Localisation</span>- RENNES FRANCE</p>
                    </div>  
                </article>

            </div>
            
            <div class="post__list__navigation">
                <a class="button__blue" href="">Précédent</a>
                <a class="button__blue" href="">Suivant</a>
            </div>

        </section>

    </main>


</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
@use "../../abstracts/variables/colors";

.cat__list {

    .title {

        width: 100vw;
        display: flex;
        flex-direction: column;
        align-items: center;

        img {
            width: 37rem;
            height: auto;
        }

        h2 {
            color: colors.$color-orange;
            font-weight: 750;
            text-align: center;
            margin-top: 4rem;
            margin-bottom: 6rem;
        }
    }

    .research {

        padding: 0 0 6rem 0;

        .search__cat__form {

            display: flex;
            flex-direction: column;
            align-items: center;

            div {
                margin-bottom: 2rem;
                width: 28rem;
                
                label {
                    color: colors.$color-orange;
                }

                select {
                    width: 100%;
                    padding: 0.7rem;
                    border-radius: 1rem;
                    margin-top: 1rem;
                    background-color: white;
                    color: colors.$color-blue;
                    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
                }
            }
        }
    }

    .post__list {

        .post__list__container {
        
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            width: 80vw;
            margin: auto;
            
            .post {
                width: 43rem;
                height: 55rem;
                margin-bottom: 5rem;
                color: white;
                background-color: colors.$color-blue;
                border-radius: 2rem;
                position: relative;
                border: 2px solid white;
                box-shadow: 6px 6px 6px colors.$color-blue;
            
                .post__img{
                    width: 100%;
                    height: 50rem;
                    background-image: url(../img/chat_1.jpg);
                    background-repeat: no-repeat;
                    background-size: cover;
                    border-radius: 2rem 2rem 0 0;
                }
            
                .post__content {
                
                    .post__cat__name,
                    .post__cat__age {
                        position: absolute;
                    }
                
                    .post__cat__name {
                        font-size: 4rem;
                        bottom: 6rem;
                        left: 1rem;
                    }
                
                    .post__cat__age {
                    right: 1rem;
                    bottom: 6rem;
                    }
                
                    .post__cat__localisation {
                        font-size: 1.3rem;
                        font-weight: 300;
                        margin: 1.5rem;
                    
                        .bold {
                            font-weight: bold;
                            text-transform: uppercase;
                        }
                    }
                }            
            }
        }

        .post__list__navigation {
            width: 80vw;
            margin: 0 auto 5rem auto;
            display: flex;
            justify-content: space-between;
        }
    }
}

// A partir de 1024px (format desktop)
@media (min-width : 1024px) {

    .cat__list {

        .research {

            width: 80%;
            margin: auto;
            padding: 0 2rem 0 2rem;

            .search__cat__form {

                display: flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;

                div {
                    margin-bottom: 2rem;
                    width: 33%;
                }
            }

            button {
                width: 30%;
            }
        }
    }
}

// A partir de 1440px (format desktop)
@media (min-width : 1440px) {

    .cat__list {

        .research {

            width: 80%;
            margin: auto;
            padding: 0 2rem 0 2rem;

            .search__cat__form {

                display: flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;

                div {
                    margin-bottom: 2rem;
                    width: 37%;
                }
            }

            button {
                width: 22%;
            }
        }
    }
}


</style>