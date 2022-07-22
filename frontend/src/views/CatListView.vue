<template>
    
    <div>
        <HeaderLayout/>
        <CatsLayout/>
        <FooterLayout/>
    </div>

</template>

<script>
import HeaderLayout from "@/components/template/HeaderLayout";
import CatsLayout from "@/components/cat/CatsLayout";
import FooterLayout from "@/components/template/FooterLayout";

export default {
  name: 'CatListView',
  components: {
    HeaderLayout,
    FooterLayout,
    CatsLayout
  },
}



</script>

