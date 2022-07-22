<template>
  <main>

        <section class="inscription">

            <img class="inscription__img" src="../../assets/img/illu_cat_laptop.png"
                alt="chat sur un écran d'ordinateur">

            <div class="inscription__form">
                <h2 class="inscription__form__title">Inscription</h2>

                <fieldset class="inscription__form__fieldset">
                    <div class="left">
                        <div class="inscription__form__fieldset__field">
                            <label for="name">Nom *</label><br>
                            <input class="inscription__form__fieldset__field__input input" type="text">
                        </div>
                        <div class="inscription__form__fieldset__field">
                            <label for="surname">Prénom *</label><br>
                            <input class="inscription__form__fieldset__field__input input" type="text">
                        </div>
                        <div class="inscription__form__fieldset__field">
                            <label for="pseudo">Pseudo</label><br>
                            <input class="inscription__form__fieldset__field__input input" type="text">
                        </div>
                        <div class="inscription__form__fieldset__field">
                            <label for="birth">Date de naissance *</label><br>
                            <input class="inscription__form__fieldset__field__input input" type="date">
                        </div>
                        <div class="inscription__form__fieldset__field">
                            <label for="email">Adresse e-mail *</label><br>
                            <input class="inscription__form__fieldset__field__input input" type="text">
                        </div>
                    </div>

                    <div class="right">
                        <div class="inscription__form__fieldset__field">
                            <label for="email">Confirmer adresse e-mail *</label><br>
                            <input class="inscription__form__fieldset__field__input input" type="text">
                        </div>
                        <div class="inscription__form__fieldset__field">
                            <label for="password">Mot de passe *</label><br>
                            <input class="inscription__form__fieldset__field__input input" type="password">
                        </div>
                        <div class="inscription__form__fieldset__field">

                            <label for="password">Confirmer mot de passe *</label><br>
                            <input class="inscription__form__fieldset__field__input input" type="password">
                        </div>
                        <div class="inscription__form__fieldset__field">

                            <div>
                                <input type="radio" name="status" value="status">
                                <label for="owner">Je souhaite <span>donner</span> un chat</label>
                            </div>


                            <div>
                                <input type="radio" name="status" value="status">

                                <label for="adoptant">Je souhaite <span class="bold">adopter</span> un chat</label>

                            </div>
                        </div>

                        <button class="inscription__form__button button__orange">Je valide mon inscription</button>

                    </div>

                </fieldset>


            </div>




        </section>

  </main>
</template>

<script>
export default {};
</script>

<style lang="scss">
</style>