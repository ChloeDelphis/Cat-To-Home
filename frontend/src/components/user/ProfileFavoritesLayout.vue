<template>
  <section class="post__list">
    <h2>Mes coups de coeur</h2>
    <div class="post__list__container">
      <cat-card-layout
        v-for="cat in favoriteCats"
        v-bind:key="cat['post_info'].post_title"
        v-bind:id="cat['post_info'].ID"
        v-bind:name="cat['post_info'].post_title"
        v-bind:localisation="cat['taxonomies_info'][4].name"
        v-bind:picture="cat['source_url']"
        v-bind:userFavorites="favoriteCats"
      />
    </div>

    <!-- Boutons présents dans la maquette et l'inté mais peut-être à ne faire apparaître que si le nombre de résultats est supérieur à 9<div class="post__list__navigation">
      <a class="button__blue" href="">Précédent</a>
      <a class="button__blue" href="">Suivant</a>
    </div> -->
  </section>
</template>

<script>
import CatCardLayout from "@/components/cat/CatCardLayout.vue";
import FavoriteService from "@/services/favorite/FavoriteService";

export default {
  name: "ProfileFavoritesLayout",
  components: {
    CatCardLayout,
  },

  data() {
    return {
      favoriteCats: [],
    };
  },

  async mounted() {
    this.favoriteCats = await FavoriteService.findAll();
  },
};
</script>

<style lang="scss">
</style>
