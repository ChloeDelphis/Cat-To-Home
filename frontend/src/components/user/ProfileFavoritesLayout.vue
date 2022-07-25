<template>
  <section class="post__list">
    <h2>Mes coups de coeur</h2>
    <div class="post__list__container">
      <CatCardLayout />
      <CatCardLayout />
      <CatCardLayout />
      <CatCardLayout />
      <CatCardLayout />
    </div>

    <!-- Boutons présents dans la maquette et l'inté mais peut-être à ne faire apparaître que si le nombre de résultats est supérieur à 9<div class="post__list__navigation">
      <a class="button__blue" href="">Précédent</a>
      <a class="button__blue" href="">Suivant</a>
    </div> -->
  </section>
</template>

<script>
import CatCardLayout from "@/components/cat/CatCardLayout.vue";

export default {
  name: "ProfileFavoritesLayout",
  components: {
    CatCardLayout,
  },
};
</script>

<style lang="scss">
</style>
