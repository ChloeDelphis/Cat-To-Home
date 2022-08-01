<template>
  <router-link :to="{ name: 'cat', params: { id: id } }">
    <article class="post">
      <div
        class="post__img"
        v-bind:style="'background-image:url(' + picture + ')'"
      >
        <!-- On appelle le composant heartlayout seulement si on est connecté en tant qu'adoptant -->
        <heart-layout
          v-if="
            this.$store.getters.getToken &&
            this.$store.getters.getRole === 'adopter'
          "
        />
      </div>
      <div class="post__content">
        <span class="post__cat__name" v-html="name"></span>
        <span class="post__cat__age">8 month</span>
        <p class="post__cat__localisation">
          <span class="bold">Localisation - </span
          ><span v-html="localisation"></span>
        </p>
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
    HeartLayout,
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