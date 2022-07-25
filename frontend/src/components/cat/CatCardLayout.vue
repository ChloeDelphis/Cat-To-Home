<template>
  <article class="post">
      <div class="post__img"></div>
      <div class="post__content">
          <span class="post__cat__name">Timothy</span>
          <span class="post__cat__age">8 month</span>
          <p class="post__cat__localisation"><span class="bold">Localisation</span>- RENNES FRANCE</p>
      </div>  
  </article>
</template>

<script>
export default {
    name: "CatCardLayout",
    // Definit des propriétés qui sont fournis par le parent
    props: {
        name: String,
        age: String,
        picture: String,
        id: Number,
        localisation: String
    }

}
</script>

<style scoped lang="scss" >
</style>