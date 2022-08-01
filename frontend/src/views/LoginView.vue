<template>
  <div>
    <HeaderLayout />
    <LoginFormLayout />
    <FooterLayout />
  </div>
</template>

<script>
import FooterLayout from "@/components/template/FooterLayout";
import LoginFormLayout from "@/components/user/LoginFormLayout";
import HeaderLayout from "@/components/template/HeaderLayout";

export default {
  name: "LoginView",
  components: {
    HeaderLayout,
    LoginFormLayout,
    FooterLayout,
  },
};
</script>

<style scoped>
</style>
