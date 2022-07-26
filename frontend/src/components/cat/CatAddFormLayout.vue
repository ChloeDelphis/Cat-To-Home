<template>
  <section class="adoption">
    <div class="adoption__left__part">
      <fieldset class="adoption__form">
        <div class="adoption__form__pair">
          <label class="input__name" for="lastname">Nom</label>
          <input v-model="title"
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
            <option value="" selected>Sexe</option>
            <option value="male">Mâle</option>
            <option value="female">Femelle</option>
            <option value="unknown">Inconnu</option>
          </select>
        </div>
        <div class="adoption__form__pair">
          <label class="input__name" for="localisation">Localisation</label>
          <input  v-model="localisation" class="input" type="text" id="localisation" name="localisation" placeholder="Paris"
          />
        </div>
        <div class="adoption__form__pair">
          <label class="input__name" for="department">Département</label>
          <select v-model="department" class="input" name="department" id="department">
            <option value="" selected>Département</option>
            <option value="Finistère">29 - Finistère</option>
            <option value="Morbihan">56 - Morbihan</option>
            <option value="Côtes d'Armor">22 - Côtes d'Armor</option>
            <option value="Ille-et-Vilaine">35 - Ille-et-Vilaine</option>
          </select>
        </div>

        <div class="adoption__form__pair">
          <label class="input__name" for="environment">Environnement</label>
          <select v-model="environment" class="input" name="environment" id="environment">
            <option value="" selected>Environnement</option>
            <option value="interieur">Interieur</option>
            <option value="exterieur">Exterieur</option>
          </select>
        </div>

        <div class="adoption__form__pair">
          <label class="input__name" for="age">Date de naissance</label>
          <input v-model="date" class="input" type="date" id="age" name="age" min="2000-01-01" max="20-12-31"/>
        </div>

        <div class="adoption__form__pair">
          <label class="input__name" for="vaccine">Vacciné contre</label>
          <div>
            <input  type="checkbox" id="rage" name="rage" value="vaccine1" v-model="checkedVaccins"/>
            <label for="vaccine1"> La rage</label>
          </div>
          <div>
            <input  type="checkbox" id="coryza" name="coryza" value="vaccine2" v-model="checkedVaccins"/>
            <label for="vaccine2"> Le coryza du chat</label>
          </div>
          <div>
            <input  type="checkbox" id="typhus" name="typhus" value="vaccine3" v-model="checkedVaccins"/>
            <label for="vaccine3"> Le typhus félin</label>
          </div>
        </div>

        <fieldset class="adoption__form__pair">
          <div class="input__name">
            <legend>
              Votre chat est-il malade? <br />
              <span>(si oui, préciser dans la déscription)</span>
            </legend>
          </div>
          <div>
            <input v-model="diseases" type="radio" id="yes" name="sickness" value="yes" />
            <label for="yes">Oui</label>
          </div>
          <div>
            <input v-model="diseases" type="radio" id="no" name="sickness" value="no" />
            <label for="no">Non</label>
          </div>
          <div>
            <input v-model="diseases" type="radio" id="unknown" name="sickness" value="unknown" />
            <label for="unknown">Ne sais pas</label>
          </div>
        </fieldset>
      </fieldset>

      <div class="adoption__description">
        <label class="input__name" for="description">Description</label>
        <textarea v-model="content" class="input adoption__description__textarea" id="description" name="description">
        </textarea>
      </div>
      <button v-on:click="sendNewCat" type="submit" class="button__orange" > Valider la création de la fiche</button>

      <!-- Boutons à ne faire apparaître que quand le composant est appelé par ProfilePublishedSheetsLayout  -->
      <div v-if="this.$route.name === 'profile'" class="profil__adoption__buttons">
        <button class="button__orange" type="submit">
          Valider les modification
        </button>
        <button class="button__orange" type="submit">Supprimer la fiche</button>
      </div>
    </div>

    <div class="adoption__add__picture">
      <a href=""><img src="../../assets/icones/Vector(13).png" alt="" /></a>
    </div>
  </section>
</template>

<script>
import NewCat from '@/services/cat/NewCat';
export default {
  name: "CatAddFormLayout",
   
   data() {
        return {
            errors: [],
            title: null,
            sex: null,
            localisation: null,
            department: null,
            environment: null,
            date: null,
            checkedVaccins: [],
            diseases: null,
            content: null,
        }
    },
    methods: {
        async sendNewCat() {
             this.errors = [];
             // Validation du contenu du formulaire
             if(!this.title) {
                 this.errors.push("Title cannot be empty");
             }
             if(!this.sex) {
                 this.errors.push("sex cannot be empty");
             }
             if(!this.localisation) {
                 this.errors.push("localisation cannot be empty");
             }
             if(!this.department) {
                 this.errors.push("department cannot be empty");
             }
             if(!this.environment) {
                 this.errors.push("environment cannot be empty");
             }
             if(!this.date) {
                 this.errors.push("date cannot be empty");
             }
             if(!this.content) {
                 this.errors.push("content cannot be empty");
             }
             if(this.errors.length === 0) {
                console.log(this.title)
                 let params = {
                     "title": this.title,
                     "content": this.content,
                     "status": 'draft'
                 }
                 switch (this.$store.getters.getRole) {
                  case 'owner':
                    params.status = "draft"
                    break;
                 }
                 const response = await NewCat.create(params);
                 // Reception de la réponse et affichage
                 if(response.id) {
                   this.$router.push({name: 'home'});
                 } else {
                     alert(response.message);
                 }
            }
        }
    },
};
</script>

<style>
</style>