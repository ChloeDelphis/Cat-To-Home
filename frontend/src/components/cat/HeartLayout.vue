<template>
  <div class="heart__container" v-on:click="toggleFavorites">
    <img
      class="heart heart-empty"
      src="../../assets/icones/coeur_vide.png"
      alt="coeur vide"
    />
    <img
      class="heart heart-filled hidden"
      src="../../assets/icones/coeur_plein.png"
      alt="coeur vide"
    />
  </div>
</template>

<script>
export default {
  name: "HeartLayout",
  // Definit des propriétés qui sont fournies par le parent
  props: {
    id: Number,
  },

  methods: {
    toggleFavorites(event) {
        // On enpêche que le clic entraîne un changement de page (car l'image dans laquelle est contenu l'icône coeur est un lien)
        event.preventDefault();
        // On sélectionne les 2 éléments qui ont la classe coeur
        let cible = event.currentTarget;
        let imgElmts = cible.querySelectorAll(".heart");
        // Pour chaucn d'entre eux on toggle la classe hidden
        imgElmts.forEach( el =>{
            el.classList.toggle("hidden");
        })
    },
  },
};
</script>

<style scoped lang="scss" >
</style>