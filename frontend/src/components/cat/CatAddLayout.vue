<template>
    <main>
        <h2 class="adoption__title">Créé la fiche adoption de ton chat</h2>
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


        <section v-if="this.$route.name === 'cat_add'" class="information">
            <div class="information__content">
                <h2 class="information__content__title">
                        Informations réglementaires
                </h2>
                <div class="information__content__paragraphe">
                    <p> She shook her head, and shook it again, as if trying to
                            clear it, which is what she was trying to
                            do.
                            They did not realize that because of the quasi-reciprocal and circular nature of all
                            Improbability
                            calculations, anything that was Infinitely Improbable was actually very likely to happen
                            almost
                            immediately. If beauty is in the eye of the beholder, then the beholder won’t be a Vogon,
                            because
                            even
                            Vogons know how ugly they are. Think of something crazy, or if that’s too taxing just throw
                            random
                            adjectives and nouns together. He smiled the smile that Zaphod had wanted to hit and this
                            time
                            Zaphod
                            hit it.
                    </p>
                    <br>
                    <p>
                            I don’t want to buy a ticket, I just want to buy the zoo. The shorter man noticed the new
                            arrivals;
                            it
                            was pretty likely that he would, as one of them was shouting at him. Where do you stand on
                            the
                            whole
                            Babel fish argument? He learned to communicate with birds and discovered that their
                            conversation
                            was
                            fantastically boring. It was all to do with wind speed, wingspans, power-to-weight ratios
                            and a
                            fair
                            bit
                            about berries. “Zaphod! I am so happy to see you.”
                    </p>
                </div>
                <div class="information__content__regulatory">
                    <div class="information__content__regulatory__checkbox">
                        <div class="input__name__checkbox">
                            <input type="checkbox" id="permission1" name="permission1" value="permission1">
                            <label for="permission1"> She shook her head, and shook it again</label>
                        </div>
                        <div class="input__name__checkbox">
                            <input type="checkbox" id="permission2" name="permission2" value="permission2">
                            <label for="permission2"> She shook her head, and shook it again</label>
                        </div>
                        <div class="input__name__checkbox">
                            <input type="checkbox" id="permission3" name="permission3" value="permission3">
                            <label for="permission3"> She shook her head, and shook it again</label>
                        </div>
                        <div class="input__name__checkbox">
                            <input type="checkbox" id="permission4" name="permission4" value="permission4">
                            <label for="permission4"> She shook her head, and shook it again</label>
                        </div>
                    </div>
                        <div class=" button__adoption__add">
                            <button v-on:click="sendNewCat" type="submit" class="button__orange" > Valider la création de la fiche</button>
                        </div>
                        <div>
                        <p v-for="error in errors" v-bind:key="error">{{error}}</p>
                        </div>
                    </div>
                    <img class="img__cat__information" src="../../assets/img/purr-cat-21.png" alt="">
                </div>
        </section>
    </main>

</template>

<script>
import NewCat from '@/services/cat/NewCat';

export default {
    name: "CatAddLayout",

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
                console.log(this.title)
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
}
</script>

<style lang="scss" scoped>
</style>