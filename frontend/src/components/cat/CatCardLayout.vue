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
    name: "CatCard",
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
    .post__list__container {
        
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        width: 80vw;
        margin: auto;
        
        .post {
            width: 43rem;
            height: 55rem;
            margin-bottom: 5rem;
            color: white;
            background-color: colors.$color-blue;
            border-radius: 2rem;
            position: relative;
            border: 2px solid white;
            box-shadow: 6px 6px 6px colors.$color-blue;
        
            .post__img{
                width: 100%;
                height: 50rem;
                background-image: url(../img/chat_1.jpg);
                background-repeat: no-repeat;
                background-size: cover;
                border-radius: 2rem 2rem 0 0;
            }
        
            .post__content {
            
                .post__cat__name,
                .post__cat__age {
                    position: absolute;
                }
            
                .post__cat__name {
                    font-size: 4rem;
                    bottom: 6rem;
                    left: 1rem;
                }
            
                .post__cat__age {
                right: 1rem;
                bottom: 6rem;
                }
            
                .post__cat__localisation {
                    font-size: 1.3rem;
                    font-weight: 300;
                    margin: 1.5rem;
                
                    .bold {
                        font-weight: bold;
                        text-transform: uppercase;
                    }
                }
            }            
        }
    }
</style>