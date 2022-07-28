<template>
  <div>
    <HeaderLayout />
    <ReinitPassLayout />   
    <FooterLayout />
  </div>
</template>

<script>
import FooterLayout from "../components/template/FooterLayout";
import HeaderLayout from "../components/template/HeaderLayout";
import ReinitPassLayout from "@/components/user/ReinitPassLayout";

export default {
  name: "RegistrationView",
  components: {
    HeaderLayout,
    FooterLayout,
    ReinitPassLayout
},
};
</script>

<style scoped>

</style>