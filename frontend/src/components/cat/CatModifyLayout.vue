<template>
        <div class="adoption">
            <div class="adoption__left__part">
                <fieldset class="adoption__form">
                    <div class="adoption__form__pair">
                        <label class="input__name cat__label" for="lastname">Nom</label>
                        <div class="current__value" v-html="title"></div>
                        <input v-model="title"
                            class="input cat__input"
                            type="text"
                            id="lastname"
                            name="lastname"
                            placeholder="Doe"
                        />
                    </div>
                    <div class="adoption__form__pair">
                        <label class="input__name cat__label" for="sexe">Sexe</label>
                        <div class="current__value" v-html="sex_name"></div>
                        <select v-model="sex" class="input cat__input" name="sexe" id="sexe">
                            <option  v-for="sex in sexes" :key="sex.id" :value="sex.id">{{sex.name}}</option>
                        </select>
                    </div>
                    <div class="adoption__form__pair">
                        <label class="input__name cat__label" for="localisation">Localisation</label>
                        <div class="current__value" v-html="localisation"></div>
                        <input  v-model="localisation" class="input cat__input" type="text" id="localisation" name="localisation" placeholder="Paris"/>
                    </div>

                    <div class="adoption__form__pair">
                        <label class="input__name cat__label" for="department">Département</label>
                        <div class="current__value" v-html="department_name"></div>
                        <input @keyup="sendLocation" v-model="department" type="text" class="input cat__input"    name="departement" id="department">
                        <div id="home__form__list">
                            <ItemListLocation v-for="location in locations" :key="location" :name="location"    :value="location.id"
                            @choiceLocation="selectedLocation" />
                        </div>
                        
                    </div>

                    <div class="adoption__form__pair">
                        <label class="input__name cat__label" for="environment">Environnement</label>
                        <div class="current__value">
                            <ul>
                                <li v-for="catEnvironment in environment" v-bind:key="catEnvironment.id" v-html="catEnvironment.name"></li>
                            </ul>
                        </div>
                        <select v-model="environment" class="input cat__input" name="environment" id="environment">
                            <option v-for="environment in environments" :key="environment.id" :value="environment.id">{{environment.name}}</option> 
                        </select>
                    </div>

                    <div class="adoption__form__pair">
                        <label class="input__name cat__label" for="filter">Age</label>
                        <div class="current__value" v-html="age"></div>
                        <select v-model="age" class="input cat__input" name="filter" id="filter">
                            <option value="bebe">Bébé</option>
                            <option value="junior">Junior</option>
                            <option value="adulte">Adulte</option>
                            <option value="senior">Sénior</option>
                        </select>
                    </div>

                    <div class="adoption__form__pair">
                        <label class="input__name cat__label" for="vaccine">Vacciné contre</label>
                        <div class="current__value">
                            <ul>
                                <li v-for="vaccin in checkedVaccins" v-bind:key="vaccin.id" v-html="vaccin.name"></li>
                            </ul>
                        </div>
                        <div class="cat__input">
                            <div v-for="vaccinate in vaccinates" :key="vaccinate.id">
                                <input  type="checkbox" id="rage" name="rage" :value="vaccinate.id"     v-model="checkedVaccins"/>
                                <label > {{vaccinate.name}}</label>
                            </div>
                        </div>
                    </div>

                    <fieldset class="adoption__form__pair">
                        <div class="input__name cat__label">
                            <legend>
                            Votre chat est-il malade? <br />
                            <span>(si oui, préciser dans la description)</span>
                            </legend>
                        </div>
                        <div class="current__value">
                            <ul>
                                <li v-for="disease in diseases_input" :key="disease.id" v-html="disease.name"></li>
                            </ul>
                        </div>
                        <div class="cat__input">
                            <div v-for="disease in diseases" :key="disease.id">
                                <input v-model="diseases" :value="disease.id" type="checkbox" :id="disease.id"    name="sickness"/>
                                <label :for="disease.id">{{disease.name}}</label>
                            </div> 
                        </div>
                    </fieldset>
                </fieldset>

                <div class="adoption__description">
                    <label class="input__name cat__label" for="description">Description</label>
                    <div class="current__value" v-html="content"></div>
                    <textarea v-model="content" class="input adoption__description__textarea cat__input" id="description" name="description">
                    </textarea>
                </div>

                <!-- Boutons à ne faire apparaître que quand le composant est appelé par ProfilePublishedSheetsLayout  -->
                <div class="profil__adoption__buttons">
                    <button @click="updateCat" class="button__orange">Valider les modification</button>
                    <button @click="deleteCat" class="button__orange">Supprimer la fiche</button>
                </div>
            </div>

            <a href=""><div class="adoption__add__picture" v-bind:style="{'backgroundImage': 'url(' + picture + ')', 'backgroundSize': 'cover', 'backgroundPosition': 'center'}"></div></a>
        </div>
</template>

<script>

import CatService from '@/services/cat/CatService';
import FindAllService from '@/services/taxonomies/FindAllService';
import ItemListLocation from '@/components/home/ItemListLocation';
import LocationService from '@/services/cat/LocationService';

export default {
    name: "CatModifyLayout",

    components: {
        ItemListLocation
    },

    props:{
        initialId: Number
    },

    data() {
        return {
            errors: [],

            // Informations about the cat
            id: this.initialId,

            title: null,
            sex: null,
            sex_name: null,
            localisation: null,
            department: null,
            departement_name: null,
            environment: null,
            age: null,
            checkedVaccins: [],
            diseases_input: null,
            content: null,
            picture: null,

            // taxonomies

            environments: null,
            sexes: null,
            vaccinates: [],
            locations: [],
            diseases: []
        }
    },

    async mounted() {

        // Récupération des données concernant le chat
        let id = this.id;
        const response = await CatService.find(id);
        console.log(response);
        if(response.code) {
            alert(response.message)
        } else {
            this.title = response.title.rendered;
            this.sex = response._embedded['wp:term'][3][0];
            this.sex_name = response._embedded['wp:term'][3][0].name;
            this.localisation = response.meta.city;
            this.department = response._embedded['wp:term'][2][0];
            this.department_name = response._embedded['wp:term'][2][0].name;
            this.environment = response._embedded['wp:term'][1];
            this.age = response.meta.age;
            this.checkedVaccins = response._embedded['wp:term'][4];
            this.diseases_input = response._embedded['wp:term'][0];
            this.content = response.content.rendered.replace(/(<([^>]+)>)/ig, "");
            this.picture = response._embedded['wp:featuredmedia'][0].source_url;
        }

        // Récupération des taxonomies

        this.environments = await FindAllService.findAllEnvironment();
        this.sexes = await FindAllService.findAllSex();
        this.vaccinates = await FindAllService.findAllVaccinate();
        this.diseases = await FindAllService.findAllDisease();
        
        // Objet Javascript pour dynamiser le formulaire 

        const catForm = {

            init: function() {

                const inputLabelArray = document.querySelectorAll(".cat__label");

                inputLabelArray.forEach(function(inputLabelElmnt) {

                    inputLabelElmnt.addEventListener('click', catForm.displayInput);
                });
                    
            },

            displayInput: function(event) {

                event.preventDefault();

                const inputLabel = event.currentTarget;

                const currentValue = inputLabel.nextSibling;
                const input = currentValue.nextSibling;

                currentValue.style.display="none";
                input.style.display="block";
        
            }
        }
        
        document.addEventListener('DOMContentLoaded', catForm.init());

    },
    
    methods: {
        async updateCat() {
             this.errors = [];
             // Validation du contenu du formulaire
             if(!this.title) {
                 this.errors.push("Title cannot be empty");
             }
             if(!this.sex) {
                 this.errors.push("Sex cannot be empty");
             }
             if(!this.localisation) {
                 this.errors.push("Localisation cannot be empty");
             }
             if(!this.department) {
                 this.errors.push("Department cannot be empty");
             }
             if(!this.environment) {
                 this.errors.push("Environment cannot be empty");
             }
             if(!this.age) {
                 this.errors.push("Date cannot be empty");
             }
             if(!this.diseases) {
                 this.errors.push("Diseases cannot be empty");
             }
             if(!this.content) {
                 this.errors.push("Content cannot be empty");
             }
             if(this.errors.length === 0) {
                // console.log(this.title)
                 let params = {
                     "title": this.title,
                     "sex": this.sex.id,
                     "location": this.localisation.id,
                     "departement": this.department.id,
                     "environment": this.environment[0].id,
                     "meta": {"age": this.age, "city": this.localisation},
                     "vaccinate": this.checkedVaccins.id,
                     "diseases": this.diseases.id,
                     "content": this.content,
                     "status": 'publish'
                 }
                 switch (this.$store.getters.getRole) {
                  case 'owner':
                    params.status = "publish"
                    break;
                 }
                 const response = await CatService.update(this.id, params);
                 // Reception de la réponse et affichage
                 if(response.id) {
                   this.$router.push({name: 'profile'});
                 } else {
                     alert(response.message);
                 }
            }
        },

        async deleteCat() {
            const response = await CatService.delete(this.id);
            if(response.id) {
              this.$router.push({name: 'profile'});
            } else {
                alert(response.message);
            }
        },

        // input departement

        async sendLocation() {
            this.locations = [];
            document.querySelector('#home__form__list').style.height = '0';

            if (this.department != '') {
                const response = await LocationService.find(this.department);
                console.log(response);
                document.querySelector('#home__form__list').style.height = '12rem';
                response.forEach(location => {
                    if (location.nom.toLowerCase().includes(this.department.toLowerCase())) {
                        this.locations.push(location.nom)
                    }
                });
            }
        
        },

        selectedLocation(event) {
            const choiceLocation = event.currentTarget.textContent;
            this.department = choiceLocation
            this.locations = [];
            document.querySelector('#home__form__list').style.height = '0';
        }
    },
}
</script>

<style lang="scss" scoped>

.cat__label {
    font-weight: bold;
}

.current__value {
    display: block;
    font-style: italic;
    position: relative;
    left: 2rem;
}

.cat__input {
    display: none;
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

</style>