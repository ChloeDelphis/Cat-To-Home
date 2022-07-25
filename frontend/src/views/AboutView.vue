<template>
  <header-layout />
  <about-layout />
  <footer-layout />
</template>

<script>
import HeaderLayout from "@/components/template/HeaderLayout.vue";
import AboutLayout from "@/components/supports/AboutLayout.vue";
import FooterLayout from "@/components/template/FooterLayout.vue";

export default {
  name: "AboutView",
  components: {
    HeaderLayout,
    AboutLayout,
    FooterLayout,
  },
};
</script>

<style scoped>
</style>
