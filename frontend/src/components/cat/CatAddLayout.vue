<template>
    <main>
        <h2 class="adoption__title">Créé la fiche adoption de ton chat</h2>
            <CatAddFormLayout />


            <section class="information">
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
                    </div>
                    <img class="img__cat__information" src="../../assets/img/purr-cat-21.png" alt="">
                </div>
            </section>
    </main>

</template>

<script>
import CatAddFormLayout from './CatAddFormLayout';
export default {
    name: "CatAddLayout",
    components: { 
        CatAddFormLayout 
    },

}
</script>

<style lang="scss" scoped>
</style>