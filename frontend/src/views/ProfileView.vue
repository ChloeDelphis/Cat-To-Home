<template>
  <div>
    <HeaderLayout />
    <ProfileLayout />

    <FooterLayout />
  </div>
</template>

<script>
import FooterLayout from "@/components/template/FooterLayout.vue";
import ProfileLayout from "@/components/user/ProfileLayout";
import HeaderLayout from "@/components/template/HeaderLayout.vue";

export default {
  name: "ProfileView",
  // props: {
  //   id: Number,
  //   lastname: String,
  //   firstname: String,
  //   pseudo: String,
  //   birth: String,
  //   email: String,
  // },
  components: {
    HeaderLayout,
    FooterLayout,
    ProfileLayout,
  },
};
</script>

<style scoped>
</style>
