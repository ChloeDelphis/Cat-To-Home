<template>
    <main class="cat__list">

        <section class="title">
            <img src="../../assets/img/purr-shopping.png" alt="Un chat dans un caddie">
            <h2>Trouve ton futur compagnon félin !</h2>
        </section>

        <!-- FORMULAIRE DE FILTRE DE RECHERCHE -->

        <section class="research">
            <div class="search__cat__form">
                <div>
                    <label for="department">Localisation</label><br>
                    <input @keyup="sendLocation" v-model="location_input" type="text" class="input input--selection"
                        name="departement" id="department">
                    <div id="home__form__list">
                        <ItemListLocation v-for="location in locations" :key="location" :name="location"
                             @choiceLocation="selectedLocation" />
                    </div>
                    <!-- <select name="departement" id="department">
                        <option value="" selected>Département</option>
                        <option value="Finistère">29 - Finistère</option>
                        <option value="Morbihan">56 - Morbihan</option>
                        <option value="Côtes d'Armor">22 - Côtes d'Armor</option>
                        <option value="Ille-et-Vilaine">35 - Ille-et-Vilaine</option>
                    </select> -->
                </div>
                <div>
                    <label for="filter">Filtre de recherche</label><br>
                    <select v-model="order" name="filter" id="filter" class="input">
                        <option value="desc" selected>Du plus anciens au plus récent</option>
                        <option value="asc">Du plus récent au plus anciens</option>
                        <option value="birthDate">Âge</option>
                    </select>
                </div>

                <button @click="searchCats" class="button__orange--papate">Je trouve mon chat</button>

            </div>
        </section>

        <!-- LISTE DES CHATS -->

        <section class="post__list">
            <div class="post__list__container">

                <CatCardLayout v-bind:id="cat.id" v-bind:localisation="cat._embedded['wp:term'][2][0].name"
                    v-bind:name="cat.title.rendered" v-bind:picture="cat._embedded['wp:featuredmedia'][0].source_url"
                    v-for="cat in catsList" v-bind:key="cat.title" />

            </div>

            <div class="post__list__navigation">
                <a class="button__blue" href="">Précédent</a>
                <a class="button__blue" href="">Suivant</a>
            </div>

        </section>

    </main>


</template>

<script>
import LocationService from '@/services/taxonomies/LocationService';
import ItemListLocation from '@/components/home/ItemListLocation';
import CatCardLayout from "@/components/cat/CatCardLayout";
import CatService from "@/services/cat/CatService";
export default {
    name: "CatsLayout",
    components: {
        CatCardLayout,
        ItemListLocation
    },
    async mounted() {
        // Récupere la liste complètes de chats s'il n'y a pas de param order
        if (this.order === '') {
            this.cats = await CatService.findAll();
        } else {
            this.cats = await CatService.findAllByOrder(this.order);
        }
    },
    methods: {
        // Récupere la liste des départements en fonction de se qu'il est tapé dans l'input
        async sendLocation() {
            this.locations = [];
            document.querySelector('#home__form__list').style.height = '0';

            if (this.location_input != '') {
                const response = await LocationService.findAll();
                document.querySelector('#home__form__list').style.height = '12rem';
                response.forEach(location => {
                    if (location.name.toLowerCase().includes(this.location_input.toLowerCase())) {
                        this.locations.push(location.name)
                    }
                });
                // this.locations = response.data
            }
        },
        // Récupere le département selectionné par l'utilisateur et l'ajoute à l'input
        selectedLocation(event) {
            const choiceLocation = event.currentTarget.textContent;
            this.location_input = choiceLocation
            this.locations = [];
            document.querySelector('#home__form__list').style.height = '0';
        },
        // Permet de lancer la recherche en fonction des filtres selectionnés
        async searchCats() {
            if (this.order !== '' && this.location_input !== '') {
                this.cats = [];
                this.cats = await CatService.findAllByOrder(this.order);
                this.location = this.location_input;
            }
        }
    },
    computed: {
        // Filtre les fiches à afficher selon la localisation
        catsList() {
            return this.cats.filter((cat) => {
                if (this.location === '') {
                    return true
                } else if (cat._embedded['wp:term'][2][0].name === this.location) {
                    return true;
                } else {
                    return false;
                }
            })
        }
    },
    data() {
        return {
            cats: [],
            location_input: '',
            locations: [],
            location: this.$route.params.location ?? '',
            order: this.$route.params.order ?? ''
        }
    }
}
</script>

<style lang="scss">
.research {
    #home__form__list {
        width: auto;
        position: relative;
        z-index: 999;
        bottom: 22px;
        overflow: scroll;
    }
}
</style>