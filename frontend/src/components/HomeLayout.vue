<template>
  <main>
    <section class="home home__response__reverse">
      <div class="home__bloc__text">
        <h2 class="home__title">
          Tu cherches à donner ou adopter un chat ? Tu es au bon endroit !
        </h2>
        <p class="home__paragraph">
          Cat To Home est un site web dédié à la sensibilisation au problème de
          l’abandon d’animaux et se veut être une solution complémentaire aux
          refuges pour permettre l’adoption d’un animal et mettant en relation
          des particuliers propriétaires d’animaux et des personnes souhaitant
          en adopter.
        </p>
        <router-link
          class="button__orange--papate"
          v-bind:to="{ name: 'cat_add' }"
          v-if="
            this.$store.getters.getToken &&
            this.$store.getters.getRole !== 'adopter'
          "
          >Je donne un chat</router-link
        >
        <router-link
          v-on:click="sendMessage"
          class="button__orange--papate"
          v-bind:to="{ name: 'login' }"
          v-if="!this.$store.getters.getToken"
          >Je donne un chat</router-link
        >
      </div>
      <div class="home__img">
        <img class="cat__one" src="../assets/img/IMG_CAT1.png" alt="" />
      </div>
    </section>

    <!-- Formulaire de recherche -->
    <section class="home home__response bg__orange">
      <div class="home__img">
        <img
          src="../assets/img/IMG_CAT2.png"
          alt="Chat tenu par des bras sortant d'un vortex"
        />
      </div>
      <div class="home__bloc__text">
        <h2 class="home__title">Trouve ton futur compagnon félin !</h2>
        <form class="home__form" action="/cats">
          <label class="home__form__label" for="department">Localisation</label>
          <div class="relative">
            <input
              @keyup="sendLocation"
              v-model="location_input"
              type="text"
              class="input"
              name="departement"
              id="department"
            />
            <div id="home__form__list">
              <ItemListLocation
                v-for="location in locations"
                :key="location"
                :name="location"
                @choiceLocation="selectedLocation"
              />
            </div>
          </div>
          <label class="home__form__label" for="filter">Trier</label>
          <select v-model="order" class="input" name="filter" id="filter">
            <option value="desc">Du plus anciens au plus récent</option>
            <option value="asc">Du plus récent au plus anciens</option>
          </select>
          <label class="home__form__label" for="age">Filtre par age</label>
          <select v-model="age" class="input" name="filter" id="age">
            <option value="tout_age">Tout âge</option>
            <option value="bebe">Bébé</option>
            <option value="junior">Junior</option>
            <option value="adulte">Adulte</option>
            <option value="senior">Sénior</option>
          </select>
          <router-link
            class="button__orange--papate"
            v-bind:to="{
              name: 'cats',
              params: { ordre: order, localisation: location_input, age: age },
            }"
          >
            Je trouve mon chat</router-link
          >
        </form>
      </div>
    </section>

    <!-- Carrousel -->
    <section class="product">
      <h2 class="home__title home__title__carrousel">
        Il attendent un foyer depuis longtemps...!
      </h2>
      <a class="pre-btn"
        ><img class="arrow" src="../assets/icones/fleche_gauche.png" alt=""
      /></a>
      <a class="nxt-btn"
        ><img class="arrow" src="../assets/icones/fleche_droite.png" alt=""
      /></a>
      <div class="product-container">
        <CatCardLayout
          v-bind:localisation="cat._embedded['wp:term'][2][0].name"
          v-bind:picture="cat._embedded['wp:featuredmedia'][0].source_url"
          v-bind:id="cat.id"
          v-bind:name="cat.title.rendered"
          v-bind:age="cat.meta.age"
          v-for="cat in cats"
          v-bind:key="cat.id"
          v-on:update="reload"
          v-bind:userFavoriteCatsId="userFavoriteCatsId"
        />
      </div>
    </section>

    <section class="home home__response bg__blue">
      <div class="home__img">
        <img src="../assets/img/IMG_CAT3.png" alt="" />
      </div>
      <div class="home__bloc__text">
        <h2 class="home__title home__title__abandonment">
          L’abandon en France
        </h2>
        <p class="home__paragraph">
          Selon des estimations, ce serait chaque année plus de 100 000 animaux
          abandonnés en France, dont 60 000 d’entre eux durant la période
          estivale. L’année 2021 a notamment connu un record d’abandon
          d’animaux, surtout les chats et les nouveaux animaux de compagnie
          (NACs). « Le recueil aurait augmenté de 25 % sur le mois de juin 2021
          par rapport à 2019. En cause, les achats irresponsables et impulsifs
          d’animaux durant les différents confinements, afin de pouvoir sortir
          ou s’occuper. Une fois la vie normale reprise, les animaux sont
          abandonnés car ils ont besoin de trop de temps et de ressources »
          déplore la porte-parole de l’association de défense des droits des
          animaux.
        </p>
      </div>
    </section>

    <section class="home home__response">
      <div class="home__bloc__text">
        <h2 class="home__title">Les limites des refuges</h2>
        <p class="home__paragraph">
          Chaque année la fourrière confie à la SPA en moyenne 46 000 animaux.
          Cela représente 3600 par mois, pour 7000 places au total. Hors la
          règle pour les fourrières régies par les collectivités territoriales,
          c’est que les animaux qu’elles ne peuvent plus confier à des
          associations doivent être euthanasiés.
        </p>
      </div>
      <div class="home__img">
        <img src="../assets/img/IMG_CAT4.png" alt="" />
      </div>
    </section>
  </main>
</template>

<script>
import LocationService from "@/services/taxonomies/LocationService";
import CatService from "@/services/cat/CatService";
import CatCardLayout from "@/components/cat/CatCardLayout";
import ItemListLocation from "@/components/home/ItemListLocation";
import FavoriteService from "@/services/favorite/FavoriteService";

export default {
  name: "HomeLayout",

  components: {
    CatCardLayout,
    ItemListLocation,
  },

  data() {
    return {
      location_input: null,
      locations: [],
      order: null,
      age: null,
      cats: [],
      favoriteCats: [],
      userFavoriteCatsId: [],
    };
  },
  async mounted() {
    this.cats = await CatService.findAllForHomepage();
    this.favoriteCatsId();

    // carousel
    const productContainers = [
      ...document.querySelectorAll(".product-container"),
    ];
    const nxtBtn = [...document.querySelectorAll(".nxt-btn")];
    const preBtn = [...document.querySelectorAll(".pre-btn")];

    productContainers.forEach((item, i) => {
      nxtBtn[i].addEventListener("click", () => {
        item.scrollLeft += 350;
      });

      preBtn[i].addEventListener("click", () => {
        item.scrollLeft -= 350;
      });
    });
  },

  methods: {
    async sendMessage() {
      this.$store.commit(
        "setMessage",
        "Vous devez être connecté pour pouvoir donner un chat."
      );
    },

    async sendLocation() {
      this.locations = [];
      document.querySelector("#home__form__list");

      if (this.location_input != "") {
        const response = await LocationService.findAll();

        document.querySelector("#home__form__list");
        response.forEach((location) => {
          if (
            location.name
              .toLowerCase()
              .includes(this.location_input.toLowerCase())
          ) {
            this.locations.push(location.name);
          }
        });
      }
    },
    selectedLocation(event) {
      const choiceLocation = event.currentTarget.textContent;
      this.location_input = choiceLocation;
      this.locations = [];
      document.querySelector("#home__form__list");
    },

    // FAVORITES

    // Le $emit est parti de HeartLayout
    // Il est passé par CatCardLayout (grâce à v-bind="$attrs" )
    // Il est remonté jusqu'à HomeLayout où on demande
    // Une mise à jour de userFavoriteCatsId
    // En appelant la fonction favoriteCatsId()
    reload() {
      this.favoriteCatsId();
      console.log(this.userFavoriteCatsId);
    },

    // Récupère un tableau qui contient les id des chats préférés de l'utilisateur connecté
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
  },
};
</script>

<style lang="scss" scoped>
@media screen and (max-width: 480px) {
  .product-container {
    padding: 0 8vw;
  }
  .arrow {
    display: none;
  }
}

@media screen and (min-width: 480px) {
  .product-container {
    padding: 0 10vw;
  }
  .arrow {
    width: 8vh;
  }
}

.product {
  position: relative;
  overflow: hidden;
  margin-bottom: 15rem;

  h2 {
    margin-bottom: 10rem;
  }
}
.product-container {
  display: flex;
  overflow-x: auto;
  scroll-behavior: smooth;
}

.product-container::-webkit-scrollbar {
  display: none;
}

.pre-btn,
.nxt-btn {
  border: none;
  width: 10vw;
  height: 45rem;
  position: absolute;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  z-index: 8;
}

.pre-btn {
  left: 0rem;
  background: linear-gradient(270deg, rgba(255, 255, 255, 0) 0%, #f3f2e7 100%);
}

.nxt-btn {
  right: 0;
  background: linear-gradient(90deg, rgba(255, 255, 255, 0) 0%, #f3f2e7 100%);
}

.pre-btn img,
.nxt-btn img {
  opacity: 0.2;
}

.pre-btn:hover img,
.nxt-btn:hover img {
  opacity: 1;
}

.input {
  margin-bottom: 1rem;
}
</style>