<template>
    <router-link :to="{name: 'cat', params: {id: id}}" >
      <article class="post">
          <!--Image à ajouter en v-if si le composant est appelé par une page spécifique (profil adoptant) <img class="hearth" src="../../assets/icones/coeur.png" alt="" /> -->

          <div class="post__img" v-bind:style="'background-image:url(' + picture + ')'">
            <heart-layout/>
          </div>
          <div class="post__content">
              <span class="post__cat__name" v-html="name"></span>
              <span class="post__cat__age" v-html="age"></span>
              <p class="post__cat__localisation"><span class="bold">Localisation - </span><span v-html="localisation"></span></p>
          </div>  
      </article>
    </router-link>

</template>

<script>
import HeartLayout from "@/components/cat/HeartLayout.vue";

export default {
  // components: { FavoritesLayout },
  name: "CatCardLayout",
  components: {
    HeartLayout
  },
  // Definit des propriétés qui sont fournies par le parent
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