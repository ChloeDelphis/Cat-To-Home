<template>
  <div class="heart__container" v-on:click="favoriteAddRemove">
    <img
      v-if="favorite"
      class="heart heart-filled"
      src="../../assets/icones/coeur_plein.png"
      alt="icône coeur plein"
    />
    <img
      v-else
      class="heart heart-empty"
      src="../../assets/icones/coeur_vide.png"
      alt="icône coeur vide"
    />
  </div>
</template>

<script>
import FavoriteService from "@/services/favorite/FavoriteService";

export default {
  name: "HeartLayout",

  data() {
    return {};
  },

  // Definit des propriétés qui sont fournies par le parent
  props: {
    favorite: Boolean,
    id: Number,
  },

  methods: {
    async favoriteAddRemove(event) {
      // On empêche d'aller sur la page détail
      event.preventDefault();

      // Si le chat fait partie des favoris
      if (this.favorite) {
        console.log("le chat " + this.id +" fait partie des favoris ");

        const response = await FavoriteService.removeFromFavorites({
          cat_id: this.id,
        });
        if (response.code === 200) {
          console.log(
            "le chat "+ this.id + " a bien été retiré des favoris"
          );
          this.$emit('update');
        } else {
          console.log("le chat n'a pas pu être retiré des favoris");
        }

        // Si le chat ne fait pas partie des favoris
      } else {
        console.log("le chat"  + this.id +" ne fait pas partie des favoris ");
        const response = await FavoriteService.addToFavorites({
          cat_id: this.id,
        });
        // En cas de réussite
        if (response.code === 200) {
          console.log(
            "le chat avec l'id " + this.id + " a bien été ajouté aux favoris"
          );
          this.$emit('update');
        } else {
          console.log("le chat n'a pas pu être ajouté aux favoris");
        }
      }
    },
  },
};
</script>

<style scoped lang="scss" >
</style>