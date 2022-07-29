<template>
  <section class="post__list">
    <h2>Mes coups de coeur</h2>
    <div class="post__list__container">
      <CatCardLayout

      />
    </div>

    <!-- Boutons présents dans la maquette et l'inté mais peut-être à ne faire apparaître que si le nombre de résultats est supérieur à 9<div class="post__list__navigation">
      <a class="button__blue" href="">Précédent</a>
      <a class="button__blue" href="">Suivant</a>
    </div> -->
  </section>
</template>

<script>
// import LocationService from "@/services/taxonomies/LocationService";
// import ItemListLocation from "@/components/home/ItemListLocation";
// import CatCardLayout from "@/components/cat/CatCardLayout.vue";
import FavoriteService from "@/services/favorite/FavoriteService";

export default {
  name: "ProfileFavoritesLayout",
  components: {
    // CatCardLayout,
    // ItemListLocation,
  },

  data() {
    return {
      favoriteCats: [],
    };
  },

  async mounted() {
    console.log("mounted");
    this.favoriteCats = await FavoriteService.findAll();
    console.log(this.favoriteCats);
    console.log(this.favoriteCats.post_info.ID);
  },
};
</script>

<style lang="scss">
</style>
