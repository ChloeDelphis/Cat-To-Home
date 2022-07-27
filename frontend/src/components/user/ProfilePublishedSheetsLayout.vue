<template>
  <div>
    <div id="give">
      <a class="button__orange--papate" href="#">Je donne un chat</a>
    </div>

    <section class="section__profil__adoption">
      <h2>Mes fiches adoption</h2>

      <cat-modify-layout
      v-for="cat in cats" v-bind:key="cat.id"
      v-bind:initialId="cat.id"
      />
      
    </section>
  </div>
</template>

<script>

import CatModifyLayout from "../cat/CatModifyLayout";
import CatService from '@/services/cat/CatService';

export default {
  name: "ProfilePublishedSheetsLayout",

  components: {
    CatModifyLayout,
  },

  data(){
    return {
      cats: []
    }
  },

  async mounted(){

    let id = this.$route.params.id;
    const response = await CatService.findByOwnerId(id);
    console.log(response);
    this.cats = response;
    console.log(this.cats);
  }
};
</script>

<style lang="scss">
</style>