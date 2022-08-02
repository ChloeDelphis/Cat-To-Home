<template>
  <main>
    <h2 class="adoption__title">Crée la fiche adoption de ton chat</h2>
    <section class="adoption">
      <div class="adoption__left__part">
        <fieldset class="adoption__form">
          <div class="adoption__form__pair">
            <label class="input__name" for="lastname">Nom</label>
            <input
              v-model="title"
              class="input"
              type="text"
              id="lastname"
              name="lastname"
              placeholder="Doe"
            />
          </div>
          <div class="adoption__form__pair">
            <label class="input__name" for="sexe">Sexe</label>
            <select v-model="sex" class="input" name="sexe" id="sexe">
              <option v-for="sex in sexes" :key="sex.id" :value="sex.id">
                {{ sex.name }}
              </option>
            </select>
          </div>

          <div class="adoption__form__pair">
            <label class="input__name" for="city">Ville</label>
            <input
              v-model="city"
              class="input"
              type="text"
              id="city"
              name="city"
            />
          </div>

          <!-- imput département  -->
          <div class="adoption__form__pair">
            <label class="input__name" for="department">Département</label>
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

          <div class="adoption__form__pair">
            <label class="input__name" for="environment">Environnement</label>
            <select
              v-model="environment"
              class="input"
              name="environment"
              id="environment"
            >
              <option
                v-for="environment in environments"
                :key="environment.id"
                :value="environment.id"
              >
                {{ environment.name }}
              </option>
            </select>
          </div>

          <div class="adoption__form__pair">
            <label class="input__name" for="filter">Age</label>
            <select v-model="age" class="input" name="filter" id="filter">
              <option value="bebe">Bébé</option>
              <option value="junior">Junior</option>
              <option value="adulte">Adulte</option>
              <option value="senior">Sénior</option>
            </select>
          </div>

          <fieldset class="adoption__form__pair">
            <div class="input__name">
              <legend>
                Votre chat est-il malade? <br />
                <span>(si oui, préciser dans la déscription)</span>
              </legend>
            </div>
            <div v-for="disease in diseases" :key="disease.id">
              <input
                v-model="disease_input"
                :value="disease.id"
                type="radio"
                :id="disease.id"
                name="sickness"
              />
              <label :for="disease.id">{{ disease.name }}</label>
            </div>
          </fieldset>

          <div class="adoption__form__pair">
            <label class="input__name" for="vaccine">Vacciné contre</label>
            <div v-for="vaccinate in vaccinates" :key="vaccinate.id">
              <input
                type="checkbox"
                :id="vaccinate.id"
                name="vaccinate"
                :value="vaccinate.id"
                v-model="checkedVaccins"
              />
              <label :for="vaccinate.id"> {{ vaccinate.name }}</label>
            </div>
          </div>
        </fieldset>

        <div class="adoption__description">
          <label class="input__name" for="description">Description</label>
          <textarea
            v-model="content"
            class="input adoption__description__textarea"
            id="description"
            name="description"
          >
          </textarea>
        </div>

        <!-- Boutons à ne faire apparaître que quand le composant est appelé par ProfilePublishedSheetsLayout  -->
        <div
          v-if="this.$route.name === 'profile'"
          class="profil__adoption__buttons"
        >
          <button class="button__orange" type="submit">
            Valider les modification
          </button>
          <button class="button__orange" type="submit">
            Supprimer la fiche
          </button>
        </div>
      </div>

      <!-- Bouton pour ajouter une photo -->
      <div class="adoption__add__picture">
        <div class="image__upload">
          <label for="featured_image">
            <img
              class="image__upload__appareil"
              src="../../assets/icones/Vector(13).png"
            />
          </label>
          <input
            type="file"
            id="featured_image"
            name="featured_image"
            @change="previewPictureAdd"
            accept=".png, .jpg, .jpeg"
          />
        </div>
        <img
          class="image__upload__preview none"
          :src="preview_picture"
          alt=""
          id="image"
        />
      </div>
    </section>

    <section v-if="this.$route.name === 'cat_add'" class="information">
      <div class="information__content">
        <h2 class="information__content__title">Adoption Responsable</h2>
        <div class="information__content__paragraphe">
          <p>
            Adopter un animal (chien, chat, cheval, lapin, hamster, souris etc…)
            est un acte sérieux et une démarche qui se doit responsable. C’est
            un engagement financier et personnel afin d’offrir bien-être et
            santé à l’animal. En tant qu’être vivant, chaque animal, quelle que
            soit son espèce, mérite du temps, de l’attention et de l’amour!
            L’adoption implique tous les membres d’une famille qui s’engagent à
            respecter et à prendre soin de leur compagnon.
          </p>
          <br />
          <p>
            Avoir un animal est une grande responsabilité au quotidien. Pour
            éviter tout désagrément et impact négatif, il est impératif de
            choisir un animal en fonction de votre caractère et de votre mode de
            vie. <br />
            Rappelez-vous qu’un animal a un coût jusqu’à la fin de sa vie:
            vétérinaire, nourriture, vacances… Ces obligations vous engagent sur
            plusieurs années, c’est pourquoi il est important de ne pas les
            oublier et de ne pas les minimiser. <br />
            Adopter est une décision qui prend du temps et un acte réfléchi.
            L’adoption responsable fera le bonheur de votre animal et aussi… le
            vôtre!
          </p>
        </div>
        <div class="information__content__regulatory">
          <div class="information__content__regulatory__checkbox">
            <div class="input__name__checkbox">
              <input
                v-model="permissions1"
                type="checkbox"
                id="permission1"
                name="permission1"
                value="permission1"
              />
              <label for="permission1">
                Je m'engage à céder mon animal gratuitement.</label
              >
            </div>
            <div class="input__name__checkbox">
              <input
                v-model="permissions2"
                type="checkbox"
                id="permission2"
                name="permission2"
                value="permission2"
              />
              <label for="permission2">
                J'atteste de la validité des informations renseigner.</label
              >
            </div>
          </div>
          <div class="button__adoption__add">
            <button
              v-on:click="sendNewCat"
              type="submit"
              class="button__orange"
              id="send"
            >
              Valider la création de la fiche
            </button>
          </div>
          <div>
            <p v-for="error in errors" v-bind:key="error">{{ error }}</p>
          </div>
        </div>
        <img
          class="img__cat__information"
          src="../../assets/img/purr-cat-21.png"
          alt=""
        />
      </div>
    </section>
  </main>
</template>

<script>
import NewCat from "@/services/cat/NewCat";
import LocationService from "@/services/cat/LocationService";
import FindAllService from "@/services/taxonomies/FindAllService";
import ItemListLocation from "@/components/home/ItemListLocation";

export default {
  name: "CatAddLayout",
  components: {
    ItemListLocation,
  },

  data() {
    return {
      // Recuperation des valeurs mise dans la fiche
      errors: [],
      title: null,
      sex: null,
      city: null,
      location_input: null,
      environment: null,
      age: null,
      checkedVaccins: [],
      disease_input: null,
      content: null,

      // Recuperation taxonomies
      environments: [],
      vaccinates: [],
      sexes: [],
      locations: [],
      diseases: [],

      picture_file: null,
      preview_picture: "",

      // Permission d'adoption
      permissions1: null,
      permissions2: null,
    };
  },
  async mounted() {
    this.environments = await FindAllService.findAllEnvironment();
    this.sexes = await FindAllService.findAllSex();
    this.vaccinates = await FindAllService.findAllVaccinate();
    this.diseases = await FindAllService.findAllDisease();
  },

  methods: {
    previewPictureAdd(event) {
      // Previsualisation de l'image
      this.picture_file = event.target.files[0];
      this.preview_picture = URL.createObjectURL(this.picture_file);
      // fait apparaitre la balise image en supprimant la class none
      const image = document.querySelector("#image");
      image.classList.remove("none");
    },

    async sendNewCat() {
      this.errors = [];
      // Validation du contenu du formulaire
      if (!this.title) {
        this.errors.push("Le nom n'est pas renseigner.");
      }
      if (!this.sex) {
        this.errors.push("Le sexe n'est pas renseigner.");
      }
      if (!this.city) {
        this.errors.push("La ville n'est pas renseigner.");
      }
      if (!this.location_input) {
        this.errors.push("Le département n'est pas renseigner.");
      }
      if (!this.age) {
        this.errors.push("L'âge n'est pas renseigner.");
      }
      if (!this.disease_input) {
        this.errors.push("La maladie n'est pas renseigner.");
      }
      if (!this.content) {
        this.errors.push("La descritpion est vide.");
      }
      if ((!this.permissions1, !this.permissions1)) {
        this.errors.push("Vous n'avez pas accepté les termes.");
      }
      if (this.errors.length === 0) {
        let params = {
          title: this.title,
          sex: this.sex,
          meta: { age: this.age, city: this.city },
          environment: this.environment,
          vaccinate: this.checkedVaccins,
          disease: this.disease_input,
          content: this.content,
          status: "publish",
        };
        switch (this.$store.getters.getRole) {
          case "owner":
            params.status = "publish";
            break;
        }
        // Permet de changer le curseur du bouton en mode wait
        const boutonSend = document.querySelector("#send");
        boutonSend.classList.add("wait");
        const response = await NewCat.create(params);
        // Reception de la réponse et affichage
        if (response.id) {
          const postId = response.id;
          // upload image dans le backend avec l'id du post
          const createPicture = await NewCat.uploadPicture(
            postId,
            this.picture_file.name,
            {
              headers: { "Content-Type": "image/jpeg" },
            },
            this.picture_file
          );
          // ajout de l'id de l'image dans le post créer
          if (createPicture.id) {
            const updatePostImage = await NewCat.addFeaturedMedia(postId, {
              featured_media: createPicture.id,
            });
            if (updatePostImage) {
              // upload departement dans le backend avec l'id du post
              const createLocation = await NewCat.uploadLocation(postId, {
                name: this.location_input,
              });
              // ajout de l'id du departement dans le post créer
              if (createLocation.id) {
                const updatePostLocation = await NewCat.addLocation(postId, {
                  location: createLocation.id,
                });
                if (updatePostLocation) {
                  this.$router.push({ name: "home" });
                  alert("Post ajouté avec succès");
                }
              }
            }
          }
        } else {
          alert(response.message);
        }
      }
    },

    // input localisation
    async sendLocation() {
      this.locations = [];
      document.querySelector("#home__form__list").style.height = "0";

      if (this.location_input != "") {
        const response = await LocationService.find(this.location_input);
        // console.log(response);
        document.querySelector("#home__form__list").style.height = "12rem";
        response.forEach((location) => {
          if (
            location.nom
              .toLowerCase()
              .includes(this.location_input.toLowerCase())
          ) {
            this.locations.push(location.nom);
          }
        });
      }
    },
    selectedLocation(event) {
      const choiceLocation = event.currentTarget.textContent;
      this.location_input = choiceLocation;
      this.locations = [];
      document.querySelector("#home__form__list").style.height = "0";
    },
  },
};
</script>

<style lang="scss" scoped>
@media screen and (min-width: 480px) {
  .image__upload {
    &__preview {
      height: 35rem;
    }
  }
}

@media screen and (max-width: 480px) {
  .image__upload {
    &__preview {
      height: 20rem;
    }
  }
}

.adoption__add__picture {
  position: relative;
}

.image__upload {
  z-index: 1;

  input {
    display: none;
  }
  &__preview {
    position: absolute;
    width: 100%;
    border-radius: 2rem;
    object-fit: cover;
  }

  &__appareil {
    cursor: pointer;
  }
}

.adoption__form__pair {
  #home__form__list {
    overflow-x: auto;
  }

  #home__form__list::-webkit-scrollbar {
    display: none;
  }

  .input {
    margin-bottom: 1rem;
  }
}

.none {
  display: none;
}

.wait {
  cursor: wait;
}
</style>