<template>
  <div>
    <form action="">
            <section class="adoption">
                <div class="adoption__left__part">
                    <fieldset class="adoption__form">
                        <div class="adoption__form__pair">
                            <label class="input__name" for="lastname">Nom</label>
                            <input class="input" type="text" id="lastname" name="lastname" placeholder="Doe">
                        </div>
                        <div class="adoption__form__pair">
                            <label class="input__name" for="sexe">Sexe</label>
                            <select class="input" name="sexe" id="sexe">
                                <option value="" selected>Sexe</option>
                                <option value="male">Mâle</option>
                                <option value="female">Femelle</option>
                                <option value="unknown">Inconnu</option>
                            </select>
                        </div>
                        <div class="adoption__form__pair">
                            <label class="input__name" for="localisation">Localisation</label>
                            <input class="input" type="text" id="localisation" name="localisation" placeholder="Paris">
                        </div>
                        <div class="adoption__form__pair">
                            <label class="input__name" for="department">Département</label>
                            <select class="input" name="departement" id="department">
                                <option value="" selected>Département</option>
                                <option value="Finistère">29 - Finistère</option>
                                <option value="Morbihan">56 - Morbihan</option>
                                <option value="Côtes d'Armor">22 - Côtes d'Armor</option>
                                <option value="Ille-et-Vilaine">35 - Ille-et-Vilaine</option>
                            </select>
                        </div>

                        <div class="adoption__form__pair">
                            <label class="input__name" for="environment">Environnement</label>
                            <select class="input" name="environment" id="environment">
                                <option value="" selected>Environnement</option>
                                <option value="">Interieur</option>
                                <option value="">Exterieur</option>
                            </select>
                        </div>

                        <div class="adoption__form__pair">
                            <label class="input__name" for="age">Date de naissance</label>
                            <input class="input" type="date" id="age" name="age" min="2000-01-01" max="20-12-31">
                        </div>

                        <div class="adoption__form__pair">
                            <label class="input__name" for="vaccine">Vacciné contre</label>
                            <div>
                                <input type="checkbox" id="vaccine1" name="vaccine1" value="vaccine1">
                                <label for="vaccine1"> La rage</label>
                            </div>
                            <div>
                                <input type="checkbox" id="vaccine2" name="vaccine2" value="vaccine2">
                                <label for="vaccine2"> Le coryza du chat</label>
                            </div>
                            <div>
                                <input type="checkbox" id="vaccine3" name="vaccine3" value="vaccine3">
                                <label for="vaccine3"> Le typhus félin</label>
                            </div>
                        </div>

                        <fieldset class="adoption__form__pair">
                            <div class="input__name">
                                <legend> Votre chat est-il malade? <br> <span>(si oui, préciser dans la
                                        déscription)</span>
                                </legend>
                            </div>
                            <div>
                                <input type="radio" id="yes" name="sickness" value="yes">
                                <label for="yes">Oui</label>
                            </div>
                            <div>
                                <input type="radio" id="no" name="sickness" value="no">
                                <label for="no">Non</label>
                            </div>
                            <div>
                                <input type="radio" id="unknown" name="sickness" value="unknown">
                                <label for="unknown">Ne sais pas</label>
                            </div>
                        </fieldset>
                    </fieldset>

                    <div class="adoption__description">
                        <label class="input__name" for="description">Description</label>
                        <textarea class="input adoption__description__textarea" id="description" name="description"> </textarea>
                    </div>
                </div>

                <div class="adoption__add__picture">
                    <a href=""><img src="../../assets/icones/Vector (13).png" alt=""></a>
                </div>

            </section>

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
                            <button class="button__orange">Valider la création de la fiche</button>
                        </div>
                    </div>
                    <img class="img__cat__information" src="../../assets/img/purr-cat-21.png" alt="">
                </div>

            </section>
        </form>
  </div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
</style>