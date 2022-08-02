<template>
    <router-link :to="{name: 'cat', params: {id: id}}" >
      <article class="post">
          <!--Image à ajouter en v-if si le composant est appelé par une page spécifique (profil adoptant) <img class="hearth" src="../../assets/icones/coeur.png" alt="" /> -->

          <div class="post__img" v-bind:style="'background-image:url(' + picture + ')'">
            <heart-layout/>
          </div>
          <div class="post__content">
              <span class="post__cat__name" v-html="name"></span>
              <span class="post__cat__age" v-html="age"></span>
              <p class="post__cat__localisation"><span class="bold">Localisation - </span><span v-html="localisation"></span></p>
          </div>  
      </article>
    </router-link>

</template>

<script>
import HeartLayout from "@/components/cat/HeartLayout.vue";

export default {
  // components: { FavoritesLayout },
  name: "CatCardLayout",
  components: {
    HeartLayout
  },
  // Definit des propriétés qui sont fournies par le parent
  props: {
    name: String,
    age: String,
    picture: String,
    id: Number,
    localisation: String,
  },
};
</script>

<style scoped lang="scss" >

 @media screen and (max-width: 480px) {

      .post {
          width: 25rem;
     }
 }
   @media screen and (min-width: 480px) {

      .post {
          width: 35rem;
      }
  }

.post {
                height: 45rem;
                color: white;
                background-color: #586FCD;
                border-radius: 2rem;
                position: relative;
                border: 2px solid white;
                margin: 0 1rem ;
            
                .post__img{
                    width: 100%;
                    height: 40rem;
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
                        text-transform: uppercase;
                    
                        .bold {
                            font-weight: bold;
                        }
                    }
                }            
            }
</style>