<template>
  <div>
    <HeaderLayout />
    <MentionsLegales />
    <FooterLayout />
  </div>
</template>

<script>
import FooterLayout from "@/components/template/FooterLayout";
import MentionsLegales from "@/components/supports/MentionsLegales.vue";
import HeaderLayout from "@/components/template/HeaderLayout";

export default {
  name: "ConnexionView",
  components: {
    HeaderLayout,
    MentionsLegales,
    FooterLayout,
  },
};
</script>

<style scoped>
</style>
