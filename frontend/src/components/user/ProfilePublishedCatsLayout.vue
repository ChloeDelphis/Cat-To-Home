<template>
  <div>
    <div id="give">
      <router-link
        v-if="
          this.$store.getters.getToken &&
          this.$store.getters.getRole !== 'adopter'
        "
        class="button__orange--papate"
        :to="{ name: 'cat_add' }"
        >Je donne un chat</router-link
      >
    </div>

    <section class="section__profil__adoption">
      <h2>Mes fiches adoption</h2>

      <cat-modify-layout
        v-for="cat in cats"
        v-bind:key="cat.id"
        v-bind:initialId="cat.id"
      />
    </section>
  </div>
</template>

<script>
import CatModifyLayout from "@/components/cat/CatModifyLayout";
import CatService from "@/services/cat/CatService";

export default {
  name: "ProfilePublishedCatsLayout",

  components: {
    CatModifyLayout,
  },

  data() {
    return {
      cats: [],
    };
  },

  async mounted() {
    let id = sessionStorage.getItem("userId");
    const response = await CatService.findByOwnerId(id);
    console.log(response);
    this.cats = response;
    console.log(this.cats);
  },
};
</script>

<style lang="scss">
</style>