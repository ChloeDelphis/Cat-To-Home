<template>
  <main class="cat__details">
        <section class="cat__details__container">
            <div class="cat__details__photo">
              <!-- On appelle le composant heartlayout seulement si on est connecté en tant qu'adoptant -->
                <img class="cat__details__photo__cat-photo" v-bind:src="picture" alt="Photo de chat">
                <heart-layout
                  v-if="
                    this.$store.getters.getToken &&
                    this.$store.getters.getRole === 'adopter'
                  "
                  v-bind:name="this.name"
                  v-bind:id="id"
                  v-on:update="reload"
                  v-bind:favorite="isFavorite"
                />
            </div>
            <div class="cat__details__infos1">
                <h2 class="cat__details__infos1__title">Coucou ! Mon nom est <span v-html="name"></span> ! Tu veux m’adopter ?</h2>
                <ul>
                    <li class="icon" id="localisation"><span class="bold">Localisation</span> : {{localisation}}</li>
                    <li class="icon" id="department"><span class="bold">Département</span> : {{department}}</li>
                    <li class="icon" id="price"><span class="bold">Prix</span> : {{price}}</li>
                    <li class="icon" id="sex"><span class="bold">Sexe</span> : {{sexe}}</li>
                    <li class="icon" id="age"><span class="bold">Âge</span> : {{age}}</li>
                    <li class="icon" id="vaccinate"><span class="bold">Vaccins</span> : <span class="result" v-for="vaccin in vaccinated" v-bind:key="vaccin.name" v-html="vaccin.name"></span></li>
                    <li class="icon" id="disease"><span class="bold">Maladies</span> : <span class="result" v-for="disease in diseases" v-bind:key="disease.name" v-html="disease.name"></span></li>
                    <li class="icon" id="environmnent"><span class="bold">Environnement</span> : <span class="result" v-for="environment in environments" v-bind:key="environment.name" v-html="environment.name"></span></li>
                </ul>
            </div>
            <div class="cat__details__illustration">
                <img class="cat__details__illustration-illu" src="@/assets/img/purr-making-a-photo.png" alt="Illustration d'un chat que l'on prend en photo">
            </div>
            <div class="cat__details__infos2">
                <p>
                    <span class="bold">
                        Informations complémentaires :
                    </span><br>
                    <span v-html="infos"></span>
                </p>
                <p>
                    <span class="bold">Informations réglementaires :</span><br>
                    <ul>
                        <li>Seuls les animaux identifiés et âgés de plus de huit semaines peuvent être donnés ;</li>
                        <li>Le donneur doit également fournir un certificat vétérinaire au nouveau propriétaire ;</li>
                        <li>L'annonce doit clairement indiquer la notion "GRATUIT";</li>
                        <li>Le donneur certifie avoir l'âge légal en accord avec les lois de son pays;</li>
                    </ul>
                </p>
                <button v-if="this.$store.getters.getToken" v-on:click="displayContactInfos" class="button__blue">Contacter le propriétaire</button>
                <div class="contact__information">
                    <ul>
                        <li v-if="allowPhone === true">Téléphone : {{phoneNumber}} </li>
                        <li v-if="allowEmail === true">Adresse e-mail : {{email}}</li>
                    </ul>
                </div>
            </div>

        </section>
    </main>
</template>

<script>
import CatService from "@/services/cat/CatService";
import UserService from "@/services/user/UserService";
import HeartLayout from "@/components/cat/HeartLayout.vue";
import FavoriteService from "@/services/favorite/FavoriteService";

export default {
  components: { HeartLayout },
  name: "CatLayout",
  data() {
    return {
      // informations about the cat
      name: null,
      picture: null,
      localisation: null,
      department: null,
      price: "Gratuit",
      sexe: null,
      age: null,
      vaccinated: [],
      diseases: [],
      environments: [],
      infos: null,
      id: parseInt(this.$route.params.id),

      // information about the owner
      authorId: null,
      phoneNumber: null,
      email: null,
      allowPhone: null,
      allowEmail: null,

      // favorite infos
      userFavoriteCatsId: [],
    };
  },

  async mounted() {

    this.favoriteCatsId();
    this.getInfo();   

  },

  computed: {

    isFavorite() {
      for (const el of this.userFavoriteCatsId) {
        if (el === this.id) {
          return true;
        }
      }
      return false;
    },
  },

  methods: {
    
    /**
     *  Récupération of the cat's informations
     */
    async getInfo(){

      let id = this.$route.params.id;
      const catResponse = await CatService.find(id);

      if (catResponse.code) {

        alert(catResponse.message);

      } else {
        this.name = catResponse.title.rendered;
        this.picture = catResponse._embedded["wp:featuredmedia"][0].source_url;
        this.localisation = catResponse.meta.city;
        this.department = catResponse._embedded["wp:term"][2][0].name;
        this.sexe = catResponse._embedded["wp:term"][3][0].name;
        this.age = catResponse.meta.age;
        this.vaccinated = catResponse._embedded["wp:term"][4];
        this.diseases = catResponse._embedded["wp:term"][0];
        this.environments = catResponse._embedded["wp:term"][1];
        this.infos = catResponse.content.rendered;
        //  Getting the author_id of the current post (cat)
        this.authorId = catResponse.author;
      }

      // Récupération of the owner's informations
      if (this.$store.getters.getToken !== null) {

        const userResponse = await UserService.find(this.authorId);
        
        if (userResponse.code) {

          alert(userResponse.message);

        } else {

          this.phoneNumber = userResponse.meta.phone;
          this.email = userResponse.email;
          this.allowPhone = userResponse.meta.allowPhone;
          this.allowEmail = userResponse.meta.allowEmail;

        }
      }
    },

    /**
     * Method to display contact infos of the cat's owner
     */
    async displayContactInfos() {
      const contactInfosElmnt = document.querySelector(".contact__information");
      contactInfosElmnt.style.display = "block";
    },

    // Récupère un tableau qui contient les id des
    // chats préférés de l'utilisateur connecté
    async favoriteCatsId() {
      this.userFavoriteCatsId = [];
      // On demande la liste des favoris de l'utilisteur
      this.userFavoriteCats = await FavoriteService.findAll();
      // Pour chaque entrée des favoris on extrait l'IDet on l'ajoute au tableau userFavoriteCatsId
      this.userFavoriteCats.forEach((el) =>
        this.userFavoriteCatsId.push(el["post_info"].ID)
      );
      console.log(this.userFavoriteCatsId);
    },

    // Recharger la recherche des favoris
    reload(){
      this.favoriteCatsId()
      console.log(this.userFavoriteCatsId);
    }
  }
};
</script>

<style lang="scss">
.cat__details__infos1 {
  li {
    text-transform: capitalize;

    .result {
      margin-right: 1rem;
    }
  }
}

.contact__information {
  width: auto;
  display: none;
  margin-bottom: 5rem;

  ul {
    li {
      float: inline-block;
      width: 32rem;
    }
  }
}
</style>