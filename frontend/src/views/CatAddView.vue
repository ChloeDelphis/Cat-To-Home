<template>
  <div>
    <headerLayout />
    <CatAddLayout />
    <FooterLayout />
  </div>
</template>

<script>
import HeaderLayout from "@/components/template/HeaderLayout";
import FooterLayout from "@/components/template/FooterLayout";
import CatAddLayout from "@/components/cat/CatAddLayout";

export default {
  name: "CatAddView",
  components: {
    HeaderLayout,
    FooterLayout,
    CatAddLayout,
  },
};
</script>

<style scoped>
</style>
