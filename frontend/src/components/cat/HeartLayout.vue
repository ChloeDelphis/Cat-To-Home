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

      // On sélectionne l'élément message qui est lié au clic
      // (utile quand la fonction est appelée depuis la liste des chats et où il y a autant d'éléments message que de chartes)
      let currentT = event.currentTarget;
      console.log("current target " + currentT);
      let parentElmt = currentT.parentNode;
      console.log("parent target " + parentElmt);
      let msgElmt = parentElmt.querySelector("#message");
      console.log(msgElmt);

      // Si le chat fait partie des favoris
      if (this.favorite) {
        console.log("le chat " + this.name + " fait partie des favoris ");

        const response = await FavoriteService.removeFromFavorites({
          cat_id: this.id,
        });
        if (response.code === 200) {
          console.log(
            "le chat " + this.name + " a bien été retiré des favoris"
          );
          this.$emit("update");
          // On fait apparaître le message sur l'interface utilisateur
          msgElmt.classList.toggle("hidden");
          console.log(msgElmt);
          msgElmt.textContent = this.name + " a été retiré de vos favoris";
          // On le fait disparaître au bout de 2 secondes
          setTimeout(() => { msgElmt.classList.toggle("hidden") }, 2000);
        } else {
          console.log("le chat n'a pas pu être retiré des favoris");
        }

        // Si le chat ne fait pas partie des favoris
      } else {
        console.log(
          "le chat " + this.name + " ne fait pas partie des favoris "
        );
        const response = await FavoriteService.addToFavorites({
          cat_id: this.id,
        });
        // En cas de réussite
        if (response.code === 200) {
          console.log(
            "le chat " + this.name + " a bien été ajouté aux favoris"
          );
          this.$emit("update");
          // On fait apparaître le message sur l'interface utilisateur
          msgElmt.classList.toggle("hidden")
          msgElmt.textContent = this.name + " a bien été ajouté à vos favoris";
          // On le fait disparaître au bout de 2 secondes
          setTimeout(() => { msgElmt.classList.toggle("hidden") }, 2000);
        } else {
          console.log("le chat n'a pas pu être ajouté aux favoris");
        }
      }
    },

    // displayMessage(event) {
    //   // On sélectionne le bon élément message
    //   let currentTarget = event.currentTarget;
    //   console.log("current target " + currentTarget);
    //   let parentElmt = currentTarget.parentNode
    //   console.log("parent target " + parentElmt);
    //   let msgElmt = parentElmt.querySelector("#message");
    //   console.log(msgElmt);
    //   // On lui ajoute / retire la classe hidden
    //   msgElmt.classList.toggle("hidden");
    // },
  },
};
</script>

<style scoped lang="scss" >
</style>