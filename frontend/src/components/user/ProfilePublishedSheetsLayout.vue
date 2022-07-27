<template>
  <div>
    <div id="give">
      <a class="button__orange--papate" href="#">Je donne un chat</a>
    </div>

    <section class="section__profil__adoption">
      <h2>Mes fiches adoption</h2>

      <CatAddLayout />
      
    </section>
  </div>
</template>

<script>
import CatAddLayout from "../cat/CatAddLayout";
export default {
  name: "ProfilePublishedSheetsLayout",
  components: {
    CatAddLayout,
  },
};
</script>

<style lang="scss">
</style>