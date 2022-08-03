<template>
  <section class="post__list">
    <h2>Mes coups de coeur</h2>
    <div class="post__list__container">
      <!-- On fait apparaître le message ci-dessous si l'utilisateur n'a pas de chats favoris -->
      <p v-if="!this.favoriteCats.length" class="post__list__container__info">
        Ajoutez des chats à vos favoris pour les voir apparaître ici
      </p>
      <cat-card-layout
        v-for="cat in favoriteCats"
        v-bind:key="cat['post_info'].post_title"
        v-bind:id="cat['post_info'].ID"
        v-bind:name="cat['post_info'].post_title"
        v-bind:localisation="cat['location'][0].name"
        v-bind:picture="cat['source_url']"
        v-on:update="reload"
        v-bind:userFavoriteCatsId="userFavoriteCatsId"
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
      userFavoriteCatsId: [],
    };
  },

  async mounted() {
    this.favoriteCats = await FavoriteService.findAll();
    this.favoriteCatsId();
  },

  methods: {
    async reload() {
      this.favoriteCats = await FavoriteService.findAll();
      this.favoriteCatsId();
      console.log(this.userFavoriteCatsId);
    },

    // Récupère un tableau qui contient les id des chats préférés de l'utilisateur connecté
    async favoriteCatsId() {
      this.userFavoriteCatsId = [];
      // Pour chaque entrée des favoris on extrait l'IDet on l'ajoute au tableau userFavoriteCatsId
      this.favoriteCats.forEach((el) =>
        this.userFavoriteCatsId.push(el["post_info"].ID)
      );
      console.log(this.userFavoriteCatsId);
    },
  },
};
</script>

<style lang="scss">
</style>
