<template>
  <div>
    <HeaderLayout />
    <RegistrationFormLayout />
    <FooterLayout />
  </div>
</template>

<script>
import FooterLayout from "../components/template/FooterLayout";
import HeaderLayout from "../components/template/HeaderLayout";
import RegistrationFormLayout from "@/components/user/RegistrationFormLayout";

export default {
  name: "RegistrationView",
  components: {
    HeaderLayout,
    RegistrationFormLayout,
    FooterLayout,
  },
};
</script>

<style scoped>
</style>
