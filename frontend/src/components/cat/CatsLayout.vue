<template>
      <main class="cat__list">

        <section class="title">
            <img src="../../assets/img/purr-shopping.png" alt="Un chat dans un caddie">
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

                <CatCardLayout
                v-bind:localisation="cat._embedded['wp:term'][2][0].name"
                v-bind:name="cat.title.rendered" 
                v-bind:picture="cat._embedded['wp:featuredmedia'][0].source_url"
                v-for="cat in cats" v-bind:key="cat.title" /> 

            </div>
            
            <div class="post__list__navigation">
                <a class="button__blue" href="">Précédent</a>
                <a class="button__blue" href="">Suivant</a>
            </div>

        </section>

    </main>


</template>

<script>
import CatCardLayout from "@/components/cat/CatCardLayout";
import CatService from "@/services/cat/CatService";
export default {
    name: "CatsLayout",
    components: {
        CatCardLayout
    },
    async mounted() {
        // contient la liste des fiches adoption renvoyée par notre API
        this.cats = await CatService.findAll();
        console.log(this.cats);
    },
    data() {
        return {
            cats: []
        }
    }
}
</script>

<style lang="scss" scoped>
</style>