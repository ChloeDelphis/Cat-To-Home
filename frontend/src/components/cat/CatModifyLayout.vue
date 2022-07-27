<template>
        <div class="adoption">
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
                        <input  v-model="localisation" class="input" type="text" id="localisation" name="localisation" placeholder="Paris"/>
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
                            <option value="5">Interieur</option>
                            <option value="6">Exterieur</option>
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
                            <span>(si oui, préciser dans la description)</span>
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
                    <p class="display"></p>
                    <textarea v-model="content" class="input adoption__description__textarea" id="description" name="description">
                    </textarea>
                </div>

                <!-- Boutons à ne faire apparaître que quand le composant est appelé par ProfilePublishedSheetsLayout  -->
                <div class="profil__adoption__buttons">
                    <button class="button__orange" type="submit">Valider les modification</button>
                    <button class="button__orange" type="submit">Supprimer la fiche</button>
                </div>
            </div>

            <div class="adoption__add__picture">
            <a href=""><img src="../../assets/icones/Vector(13).png" alt="" /></a>
            </div>
        </div>
</template>

<script>

import CatService from '@/services/cat/CatService';

export default {
    name: "CatAModifyLayout",

    props:{
        initialId: Number
    },

    data() {
        return {
            errors: [],
            id: this.initialId,
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

    async mounted() {
        let id = this.id;
        const response = await CatService.find(id);
        console.log(response);
        if(response.code) {
            alert(response.message)
        } else {
            this.title = response.title.rendered;
            this.sex = response._embedded['wp:term'][3][0].name;
            this.localisation = response._embedded['wp:term'][2][0].name;
            this.environment = response._embedded['wp:term'][1];
            this.date = response.meta.birthDate;
            this.checkedVaccins = response._embedded['wp:term'][4];
            this.diseases = response._embedded['wp:term'][0].name;
            this.content = response.content.rendered;
        }
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
             if(!this.date) {
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
                     "sex": this.sex,
                     "location": this.localisation,
                     "departement": this.department,
                     "environment": this.environment,
                     "date": this.date,
                     "vaccinate": this.checkedVaccins,
                     "diseases": this.diseases,
                     "content": this.content,
                     "status": 'publish'
                 }
                 switch (this.$store.getters.getRole) {
                  case 'owner':
                    params.status = "publish"
                    break;
                 }
                 const response = await CatService.update(params);
                 // Reception de la réponse et affichage
                 if(response.id) {
                   this.$router.push({name: 'home'});
                 } else {
                     alert(response.message);
                 }
            }
        }
    },
}
</script>

<style lang="scss" scoped>
</style>