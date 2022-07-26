<template>
  <div>
    <div id="give">
      <a class="button__orange--papate" href="#">Je donne un chat</a>
    </div>

    <section class="section__profil__adoption">
      <h2>Mes fiches adoption</h2>

      <CatAddFormLayout />
    </section>
  </div>
</template>

<script>
import CatAddFormLayout from "../cat/CatAddFormLayout";
export default {
  name: "ProfilePublishedSheetsLayout",
  components: {
    CatAddFormLayout,
  },
};
</script>

<style lang="scss">
</style>