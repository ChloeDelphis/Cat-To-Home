<template>
    <main class="main">
        <h1>Vous avez oublié votre mot de passe ?</h1>
        <div class="container__inputs">
            <input type="text" v-model="password" class="input form__items" placeholder="nouveau mot de passe">
            <input type="text" v-model="passConfirm" class="input form__items" placeholder="confirmer mot de passe">
            <button @click="setNewPassword" class="button__orange form__items">Valider</button>
        </div>
        <div v-if="errors == 'linkExpired' || errors == 'wrongToken'">
            <p class="link__expired">Ce lien a expiré et/ou est faux, merci de recommencer la réinitialisation de votre
                mot de passe.
            </p>
        </div>
        <div v-if="errors == 'failChangePass'">
            <p class="link__expired">La réinitialisation du mot de passe n'a pas pu être éffectuée, merci de recommencer
            </p>
        </div>
    </main>
</template>

<script>
import UserService from '@/services/user/UserService';
export default {
    name: "ReinitPassLayout",
    data() {
        return {
            errors: [],
            password: null,
            passConfirm: null,
            currentDate: new Date().getTime(), // On transforme la current date en timestamps
            token_url: this.$route.query.token,
        }
    },
    methods: {
        async setNewPassword() {
            this.errors = [];

            if (!this.password) {
                this.errors.push('Le mot de passe ne doit pas être vide');
            }
            if (!this.passConfirm) {
                this.errors.push('La confirmation du mot de passe ne doit pas être vide');
            }
            if (this.password && this.passConfirm && this.passConfirm !== this.password) {
                this.errors.push('Les mots de passes doivent être identiques');
            }

            if (this.errors.length === 0) {
                const response = await UserService.findForResetPass(this.$route.query.key);
                if (response.id) {
                    if (Date.parse(response.meta.exp_date) >= this.currentDate) { // Date.parse() transforme un string en milliseconde depuis le 01/01/1970
                        if (response.meta.reset_token === this.token_url) {
                            const reset_pass = await UserService.resetPass({
                                "email": response.meta.reset_email,
                                "password": this.password
                            });
                            if (reset_pass.code === 200) {
                                this.$router.push({ name: 'login' });
                            } else {
                                this.errors.push('failChangePass');
                            }
                        } else {
                            this.errors.push('wrongToken');
                        }
                    } else {
                        this.errors.push('linkExpired');
                    }
                }

            }
        }
    }
}
</script>

<style scoped lang="scss">
.main {
    margin-bottom: 13.8rem;

    h1 {
        text-align: center;
        margin: 5rem 0;
    }

    .container__inputs {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

        .input {
            margin-bottom: 2rem;
        }
    }

    .link__expired {
        text-align: center;
        margin-top: 2rem;
        margin-bottom: -4rem;
    }

    .disabled {
        opacity: 0.5;
    }
}
</style>