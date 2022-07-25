<template>

    <router-link :to="{name: 'cat'}" >
      <article class="post">
          <!--Image à ajouter en v-if si le composant est appelé par une page spécifique (profil adoptant) <img class="hearth" src="../../assets/icones/coeur.png" alt="" /> -->

          <div class="post__img" v-bind:style="'background-image:url(' + picture + ')'"></div>
          <div class="post__content">
              <span class="post__cat__name" v-html="name"></span>
              <span class="post__cat__age">8 month</span>
              <p class="post__cat__localisation"><span class="bold">Localisation - </span><span v-html="localisation"></span></p>
          </div>  
      </article>
    </router-link>

</template>

<script>
export default {
  name: "CatCardLayout",
  // Definit des propriétés qui sont fournis par le parent
  props: {
    name: String,
    age: String,
    picture: String,
    id: Number,
    localisation: String,
  },
};
</script>

<style scoped lang="scss" >
</style>