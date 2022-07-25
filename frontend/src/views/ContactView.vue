<template>
  <div>
    <HeaderLayout />
    <ContactForm />
    <FooterLayout />
  </div>
</template>

<script>
import FooterLayout from "@/components/template/FooterLayout";
import ContactForm from "@/components/supports/ContactForm";
import HeaderLayout from "@/components/template/HeaderLayout";

export default {
  name: "ContactView",
  components: {
    HeaderLayout,
    ContactForm,
    FooterLayout,
  },
};
</script>

<style scoped>
</style>
