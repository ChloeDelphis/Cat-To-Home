<template>
  <div id="message" class="hidden"></div>
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
    name: String,
    favorite: Boolean,
    id: Number,
  },

  methods: {
    async favoriteAddRemove(event) {
      // On empêche d'aller sur la page détail
      event.preventDefault();

      // Si le chat fait partie des favoris
      if (this.favorite) {
        console.log("le chat " + this.name + " fait partie des favoris ");

        const response = await FavoriteService.removeFromFavorites({
          cat_id: this.id,
        });
        if (response.code === 200) {
          console.log("le chat " + this.name + " a bien été retiré des favoris");
          // On fait apparaître le message sur l'interface utilisateur
          this.displayMessage(event);
          // // On le fait disparaître au bout de 2 secondes
          // setTimeout(this.displayMessage, 2000);
          // const msgEmlt = event.currentTarget.querySelector("#message");
          // msgEmlt.innerHTML = this.name + " a été retiré de vos favoris";
          this.$emit("update");
        } else {
          console.log("le chat n'a pas pu être retiré des favoris");
        }

        // Si le chat ne fait pas partie des favoris
      } else {
        console.log("le chat " + this.name + " ne fait pas partie des favoris ");
        const response = await FavoriteService.addToFavorites({
          cat_id: this.id,
        });
        // En cas de réussite
        if (response.code === 200) {
          console.log(
            "le chat " + this.name + " a bien été ajouté aux favoris"
          );
          // On fait apparaître le message sur l'interface utilisateur
          this.displayMessage(event);
          // // On le fait disparaître au bout de 2 secondes
          // setTimeout(this.displayMessage, 2000);
          // const msgEmlt = event.currentTarget.querySelector("#message");
          // msgEmlt.innerHTML = this.name + " a bien été ajouté à vos favoris";

          this.$emit("update");
        } else {
          console.log("le chat n'a pas pu être ajouté aux favoris");
        }
      }
    },

    displayMessage() {

      const msgEmlt = document.querySelector("#message");
      msgEmlt.classList.toggle("hidden");
      setTimeout(document.querySelector("#message").classList.toggle("hidden"), 2000);
    },
  },
};
</script>

<style scoped lang="scss" >

</style>