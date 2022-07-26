<template>
  <main class="cat__details">
        <section class="cat__details__container">
            <div class="cat__details__photo">
                <img src="{{picture}}" alt="Photo de chat">
            </div>
            <div class="cat__details__infos1">
                <h2>Coucou ! Mon nom est {{name}} ! Tu veux m’adopter ?</h2>
                <ul>
                    <li class="icon" id="localisation"><span class="bold">Localisation</span> : {{localisation}}</li>
                    <li class="icon" id="department"><span class="bold">Département</span> : Côtes d'Armor</li>
                    <li class="icon" id="price"><span class="bold">Prix</span> : {{price}}</li>
                    <li class="icon" id="sex"><span class="bold">Sexe</span> : {{sexe}}</li>
                    <li class="icon" id="age"><span class="bold">Âge</span> : 10 ans</li>
                    <li class="icon" id="vaccinate"><span class="bold">Vaccins</span> : {{vaccinated}}</li>
                    <li class="icon" id="disease"><span class="bold">Maladies</span> : {{diseases}}</li>
                    <li class="icon" id="environmnent"><span class="bold">Environnement</span> : {{environment}}</li>
                </ul>
            </div>
            <div class="cat__details__illustration">
                <img src="@/assets/img/purr-making-a-photo.png" alt="Illustration d'un chat que l'on prend en photo">
            </div>
            <div class="cat__details__infos2">
                <p>
                    <span class="bold">
                        Informations complémentaires :
                    </span><br>
                    Minou est un chat timide et craintif aux premiers abords, mais qui une fois la confiance instaurée est très câlin. Aucun problème avec les enfants à condition de ne pas lui faire mal. S’aventure parfois dehors (actuellement dans une maison) mais jamais très longtemps
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
                <button class="button__blue">Contacter le propriétaire</button>
            </div>

        </section>
    </main>
</template>

<script>
import CatService from '@/services/cat/CatService';
export default {
    name: "CatLayout",
    data() {
        return {
            name: null,
            picture: null,
            localisation: null,
            department: null,
            price: "Gratuit",
            sexe: null,
            age: null,
            vaccinated: null,
            diseases: null,
            environment: null,
            infos: null
        }
    },
    async mounted(){
        let id = this.$route.params.id;
        const response = await CatService.find(id);
        if(response.code){
            alert(response.message);
        } else {
            this.name = response.title.rendered;
            this.picture = response._embedded['wp:featuredmedia'][0].source_url;
            this.localisation = response._embedded['wp:term'][2][0].name;
            this.department = null;
            this.sexe = response._embedded['wp:term'][3][0].name;
            this.age = null;
            this.vaccinated = response._embedded['wp:term'][4][0].name;
            this.diseases = response._embedded['wp:term'][0][0].name;
            this.environment = response._embedded['wp:term'][1][0].name;
        }
    }
}
</script>

<style>

li{
    text-transform: capitalize;
}

</style>