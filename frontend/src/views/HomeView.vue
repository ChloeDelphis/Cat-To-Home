<template>
<div>
   <HeaderLayout />

<HomeLayout>

<FooterLayout /> 
</div>

</template>

<script>
import HeaderLayout from "@/components/template/HeaderLayout"; 
<<<<<<< HEAD
import HomeLayout from '../components/supports/HomeLayout.vue';
import FooterLayout from '../components/template/FooterLayout.vue';


=======
import FooterLayout from "@/components/template/HeaderLayout"; 
>>>>>>> page-creation-sheet

export default{
    name: "HomeView", 
    components: {
        HeaderLayout, 
        HomeLayout,
        FooterLayout,
    }
};

</script>

<style scoped>

</style>
