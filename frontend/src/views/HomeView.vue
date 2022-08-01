<template>
<div>
    <HeaderLayout />
    <HomeLayout />
    <FooterLayout /> 
</div>

</template>

<script>
import HeaderLayout from "@/components/template/HeaderLayout"; 
import HomeLayout from '@/components/HomeLayout';
import FooterLayout from '@/components/template/FooterLayout';



export default{
    name: "HomeView", 
    components: {
        HeaderLayout, 
        HomeLayout,
        FooterLayout
    }
};

</script>

<style scoped>

</style>
