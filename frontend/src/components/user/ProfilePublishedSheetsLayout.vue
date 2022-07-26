<template>
  <div>
    <div id="give">
      <a class="button__orange--papate" href="#">Je donne un chat</a>
    </div>

    <section class="section__profil__adoption">
      <h2>Mes fiches adoption</h2>

      <CatAddFormLayout />

      <!-- Boutons à ne faire apparaître que quand le composant est appelé par ProfilePublishedSheetsLayout  -->
      <div class="profil__adoption__buttons">
        <button class="button__orange" type="submit">
          Valider les modification
        </button>
        <button class="button__orange" type="submit">Supprimer la fiche</button>
      </div>
      
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