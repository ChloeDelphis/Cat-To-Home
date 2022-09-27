<template>
        <div class="adoption">
            <div class="adoption__left__part">
                <fieldset class="adoption__form">

                    <!-- Name input -->

                    <div class="adoption__form__pair">
                        <label class="input__name cat__label pen" for="lastname">Nom</label>
                        <div class="current__value" v-html="title"></div>
                        <input v-model="title"
                            class="input cat__input"
                            type="text"
                            id="lastname"
                            name="lastname"
                            placeholder="Doe"
                        />
                    </div>

                    <!-- Sex input -->

                    <div class="adoption__form__pair">
                        <label class="input__name cat__label pen" for="sexe">Sexe</label>
                        <div class="current__value" v-html="sex_name"></div>
                        <select @change="getIdSex" class="input cat__input" name="sexe" id="sexe">
                            <option  v-for="sex in sexes" :key="sex.id" :value="sex.id" :selected="(sex_name == sex.name) ? true : false">{{sex.name}}</option>
                        </select>
                    </div>

                    <!-- City input -->

                    <div class="adoption__form__pair">
                        <label class="input__name cat__label pen" for="localisation">Localisation</label>
                        <div class="current__value" v-html="localisation"></div>
                        <input  v-model="localisation" class="input cat__input" type="text" id="localisation" name="localisation" placeholder="Paris"/>
                    </div>

                    <!-- Department input -->

                    <div class="adoption__form__pair">
                        <label class="input__name cat__label pen" for="department">Département</label>
                        <div class="current__value" v-html="department_name"></div>
                        <input @keyup="sendLocation" v-model="department_name" type="text" class="input cat__input" id="department">
                        <div id="home__form__list">
                            <ItemListLocation v-for="location in locations" :key="location.id" :name="location" :value="location.id"
                            @choiceLocation="selectedLocation" />
                        </div>
                    </div>

                    <!-- Environement input -->

                    <div class="adoption__form__pair">
                        <label class="input__name cat__label pen" for="environment">Environnement</label>
                        <div class="current__value" v-html="environment_name"></div>
                        <select @change="getIdEnvironment" class="input cat__input" name="environment" id="environment">
                            <option v-for="environment in environments" :key="environment.id" :value="environment.id" :selected="(environment_name == environment.name) ? true : false">{{environment.name}}</option> 
                        </select>
                    </div>

                    <!-- Age input -->

                    <div class="adoption__form__pair">
                        <label class="input__name cat__label pen" for="filter">Age</label>
                        <div class="current__value" v-html="age"></div>
                        <select v-model="age" class="input cat__input" name="filter" id="filter">
                            <option value="bebe">Bébé</option>
                            <option value="junior">Junior</option>
                            <option value="adulte">Adulte</option>
                            <option value="senior">Sénior</option>
                        </select>
                    </div>

                    <!-- Vaccin input -->

                    <div class="adoption__form__pair">
                        <label class="input__name cat__label pen" for="vaccine">Vacciné contre</label>
                        <div class="current__value">
                            <ul>
                                <li v-for="vaccin in vaccinates" v-bind:key="vaccin" ><span v-if="vaccins_id.includes(vaccin.id)"    v-html="vaccin.name"></span></li>
                            </ul>
                        </div>
                        <div class="cat__input">
                            <div v-for="vaccinate in vaccinates" :key="vaccinate.id">
                                <input type="checkbox" :id="vaccinate.name" name="vaccin" :value="vaccinate.id" :checked="(vaccins_id.includes(vaccinate.id))" v-model="vaccins_id" /> 
                                <label :for="vaccinate.name"> {{vaccinate.name}} </label>
                            </div>
                        </div>
                    </div>

                    <!-- Disease input -->

                    <fieldset class="adoption__form__pair">
                        <div class="input__name cat__label">
                            <legend class="pen">
                            Votre chat est-il malade ? <br />
                            <span>(si oui, préciser dans la description)</span>
                            </legend>
                        </div>
                        <div class="current__value" v-html="disease_name"></div>
                        <div class="cat__input">
                            <div v-for="disease in diseases" :key="disease.id">
                                <input type="radio" @change="getIdDisease" :value="disease.id"  :id="disease.name" name="sickness" :checked="(disease_name == disease.name) ? true : false" v-model="disease_name"/>
                                <label :for="disease.name">{{disease.name}}</label>
                            </div> 
                        </div>
                    </fieldset>
                </fieldset>

                <!-- Description input -->

                <div class="adoption__description">
                    <label class="input__name cat__label pen" for="description">Description</label>
                    <div class="current__value" v-html="content"></div>
                    <textarea v-model="content" class="input adoption__description__textarea cat__input" id="description" name="description">
                    </textarea>
                </div>

                <div class="profil__adoption__buttons">
                    <button @click="updateCat" class="button__orange">Valider les modification</button>
                    <button @click="confirmDeleteCat" class="button__orange">Supprimer la fiche</button>
                </div>

            </div>

            <!-- Update picture input -->

            <div>
                <div class="adoption__add__picture" v-bind:style="{'backgroundImage': 'url(' + picture + ')',   'backgroundSize': 'cover', 'backgroundPosition': 'center'}"></div>
                <br>
                <label for="uploadPicture">Pour changer la photo, cliquez ici : </label><br>    
                <input @change="uploadPicture" id="uploadPicture" name="uploadPicture" type="file" accept=".png, .jpg, .jpeg">
            </div>
        </div>
</template>



<script>

import CatService from '@/services/cat/CatService';
import FindAllService from '@/services/taxonomies/FindAllService';
import ItemListLocation from '@/components/home/ItemListLocation';
import LocationGouvService from '@/services/cat/LocationGouvService';
import LocationService from '@/services/taxonomies/LocationService';
import NewCat from '@/services/cat/NewCat';

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
            sex_name: null,
            sex_id: null,
            localisation: null,
            departments: null,
            department_name: null,
            department_id: null,
            environment_name: null,
            environment_id: null,
            age: null,
            checkedVaccins: [],
            vaccins_id: [],
            disease_id: null,
            disease_name: null,
            content: null,
            picture: null,

            // Feature image

            picture_file: null,
            preview_picture: '',
            message: null,

            // taxonomies

            environments: null,
            sexes: [],
            vaccinates: [],
            locations: [],
            diseases: []
        }
    },


    async created() {

        // Getting cat's data using the AJAX request in CatService.js taking the cat ID as a parameter
        let id = this.id;
        const response = await CatService.find(id);
        if(response.code) {
            alert(response.message)
        } else {
            this.title = response.title.rendered;
            this.sex_name = response._embedded['wp:term'][3][0].name;
            this.sex_id = response._embedded['wp:term'][3][0].id.toString();
            this.localisation = response.meta.city;
            this.department_name = response._embedded['wp:term'][2][0].name;
            this.environment_name = response._embedded['wp:term'][1][0].name;
            this.environment_id = response._embedded['wp:term'][1][0].id;
            this.age = response.meta.age;
            this.checkedVaccins = response._embedded['wp:term'][4];
            this.disease_id = response._embedded['wp:term'][0][0].id.toString();
            this.disease_name = response._embedded['wp:term'][0][0].name;
            this.content = response.content.rendered.replace(/(<([^>]+)>)/ig, "").replace(/&rsquo;/gm, "'").replace(/&nbsp;/gm, " ");
            this.picture = response._embedded['wp:featuredmedia'][0].source_url;
            
            this.checkedVaccins.forEach(vaccin => {
                this.vaccins_id.push(vaccin.id)
            });
        }

        // Getting taxonomies using the findAll AJAX requests in FindAllService.js
        // Getting the list of the french departments from an public government API using AJAX request in LocationService.js
        this.environments = await FindAllService.findAllEnvironment();
        this.sexes = await FindAllService.findAllSex();
        this.vaccinates = await FindAllService.findAllVaccinate();
        this.diseases = await FindAllService.findAllDisease();
        this.departments = await LocationService.findAll();
        
        // JavaScript object which dynamize the modification form of the cat data allowing to display the inputs when we click ont the labels
        const catForm = {

            /**
             * Setting eventListeners on the form's labels
             */
            init: function() {

                const inputLabelArray = document.querySelectorAll(".cat__label");
                const inputArray = document.querySelectorAll(".cat__input")

                inputLabelArray.forEach(function(inputLabelElmnt) {

                    inputLabelElmnt.addEventListener('click', catForm.displayInput);
                });

                inputArray.forEach(function(inputElmnt) {

                    inputElmnt.addEventListener('blur', catForm.hideInput);
                });

                inputArray.forEach(function(inputElmnt) {

                    inputElmnt.addEventListener('change', catForm.hideInput);
                });

                inputArray.forEach(function(inputElmnt) {

                    inputElmnt.addEventListener('keydown', catForm.hideInputOnKeyDown);
                });
                    
            },

            /**
             * Method to display the inputs
             */
            displayInput: function(event) {

                event.preventDefault();

                const inputLabel = event.currentTarget;

                const currentValue = inputLabel.nextSibling;
                const input = currentValue.nextSibling;

                currentValue.style.display="none";
                input.style.display="block";
                input.focus();
        
            },
            
            /**
             * Method to hide the input when we press Enter key 
             */
            hideInputOnKeyDown: function(event) {

                if(event.code === 'Enter') {
                    catForm.hideInput(event)
                }
            },

            /**
             * Method to hide the input when we click outside the inputs
             */
            hideInput: function(event) {

                event.preventDefault();

                const input = event.currentTarget;
                const currentValue = input.previousSibling;

                input.style.display="none";
                currentValue.style.display="block";
            }
        }
        
        document.addEventListener('DOMContentLoaded', catForm.init());

    },
    
    methods: {

        /**
         * method to separate the value and the text of the sex input to store them in 2 separate variables
         */
        getIdSex(event) {
            const element = event.currentTarget;
            this.sex_name = element.options[element.selectedIndex].text;
            this.sex_id = element.value;
        },

        /**
         * method to separate the value and the text of the environment input to store them in 2 separate variables
         */
        getIdEnvironment(event) {
            const element = event.currentTarget;
            this.environment_name = element.options[element.selectedIndex].text;
            this.environment_id = element.value;
        },

        /**
         * method to separate the value and the text of the disease input to store them in 2 separate variables
         */
        getIdDisease(event) {
            const element = event.currentTarget;
            const label = element.nextSibling;
            this.disease_name = label.textContent;
            this.disease_id = element.value;
        },

        /**
         * Method to update the cat's data with the values entered in the form's inputs
         */
        async updateCat() {
             this.errors = [];
             // Checking if the inputs are empty
             if(!this.title) {
                 this.errors.push("Title cannot be empty");
             }
             if(!this.sex_name) {
                 this.errors.push("Sex cannot be empty");
             }
             if(!this.localisation) {
                 this.errors.push("Localisation cannot be empty");
             }
             if(!this.department_name) {
                 this.errors.push("Department cannot be empty");
             }
             if(!this.environment_name) {
                 this.errors.push("Environment cannot be empty");
             }
             if(!this.age) {
                 this.errors.push("Date cannot be empty");
             }
             if(!this.disease_name) {
                 this.errors.push("Diseases cannot be empty");
             }
             if(!this.content) {
                 this.errors.push("Content cannot be empty");
             }
             if(this.errors.length === 0) {

                 /**
                  * Checking if the value of department input exists ine the BDD
                  */
                if (this.department_name !== "") {
                    let verifLocation = false;
                    let departmentId = "";
                    this.departments.forEach((department) => {
                        if (department.name === this.department_name) {
                            verifLocation = true;
                            departmentId = department.id;
                        }
                    });
                    /**
                    * If it doesn't, we create it in the BDD 
                    */
                    if (!verifLocation) {

                        // upload of the new department with the post_id
                        const createLocation = await NewCat.createLocation(this.id, {
                            name: this.department_name,
                        });
                        if (createLocation.id) {
                            departmentId = createLocation.id;
                        }
                    }
                    // Then we connect the department_id to the post
                    if (departmentId) {  
                        this.department_id = departmentId;
                    }
                }

                const idVaccin = [];
                this.vaccins_id.forEach(vaccin => {
                    idVaccin.push(vaccin);
                });

                // initialization of parameters fot the cat update request
                let params = {
                     "title": this.title,
                     "sex": this.sex_id,
                     "location": this.department_id,
                     "environment": this.environment_id,
                     "meta": {"age": this.age, "city": this.localisation},
                     "vaccinate": idVaccin,
                     "disease": this.disease_id,
                     "content": this.content,
                 }

                const updateCat = await CatService.update(this.id, params);
                
                if(this.picture_file !== null) {
                    // upload image in the backend with the post_id
                    const updatePicture = await NewCat.uploadPicture(this.id, this.picture_file.name,   {headers: {"Content-Type": "image/jpeg"}}, this.picture_file)
                    // adding picture_id in the post
                    if (updatePicture.id) {
                        const addPicturedMedia = await NewCat.addFeaturedMedia(this.id, {
                            "featured_media": updatePicture.id
                        })
                        if (addPicturedMedia.id) {
                            this.message = "L'image a bien été enregistrée"
                        }
                    }
                }
                // Reception de la réponse et affichage
                if(updateCat.id || this.message !== '') {
                    this.$router.go();
                } 
                else {
                    alert(updateCat.message);
                }

            } 
        },

        /**
         * Method to display à validation popup before to delete a cat
         */
        confirmDeleteCat() {
            let answer = window.confirm("Êtes-vous sur de vouloir supprimer cette fiche ?")
            if(answer) {
                this.deleteCat();
            }
        },

        /**
         * Method to delete a cat using his id as a parameter
         */
        async deleteCat() {
            const response = await CatService.delete(this.id);
            if(response.id) {
              this.$router.go();
            } else {
                alert(response.message);
            }
        },

        /**
         * Method to display the list of the french department when the user fills the inpu
         */
        async sendLocation() {
            this.locations = [];
            document.querySelector('#home__form__list').style.height = '0';

            if (this.department_name != '') {
                const response = await LocationGouvService.find(this.department_name);
        
                document.querySelector('#home__form__list').style.height = '12rem';
                response.forEach(location => {
                    if (location.nom.toLowerCase().includes(this.department_name.toLowerCase())) {
                        this.locations.push(location.nom)
                    }
                });
            }
        
        },

        /**
         * Method to store the name of the selected department 
         */
        selectedLocation(event) {
            const choiceLocation = event.currentTarget.textContent;
            this.department_name = choiceLocation;
            this.locations = [];
            document.querySelector('#home__form__list').style.height = '0';
        },

        /**
         * Method to upload à new picture of the cat, checking the size of it before to store in a variable
         */
        uploadPicture(event) {
            if(event.target.files[0].size > 2097152) {
                alert("Le fichier est trop volumineux, il ne doit pas dépasser 2MB")
            } else {
                this.picture_file = event.target.files[0];
                this.preview_picture = URL.createObjectURL(this.picture_file);
            }
        },
    },
}
</script>



<style lang="scss" scoped>

.cat__label {
    font-weight: bold;
}

.pen::before{
        content: url("../../assets/icones/pen.png");
        margin-right: 1rem;
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

    position: relative;

    #home__form__list {

        background-color: white;
        border-bottom-right-radius: 1rem;
        border-bottom-left-radius: 1rem;
        position: absolute ;
        width:90%;
        top: 9rem;
        max-height: 15rem;
        overflow: auto;
        box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.25);
        z-index: 1;
    
    }
    

  #home__form__list::-webkit-scrollbar {
    display: none;
  }

  .input {
    margin-bottom: 1rem;
  }
  .input__departement__select{
        color: #586FCD;
    }
}

#confirmDelete {

    display: none;
    position: absolute;
    top: 50%;
    left: 50%;
}

</style>