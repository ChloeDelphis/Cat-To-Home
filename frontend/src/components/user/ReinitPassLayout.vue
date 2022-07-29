<template>
  <main class="main">
        <h1>Vous avez oublié votre mot de passe ?</h1>
        <div class="container__inputs">
            <input type="text" v-model="password" class="input form__items" placeholder="nouveau mot de passe">
            <input type="text" v-model="passConfirm" class="input form__items" placeholder="confirmer mot de passe">
            <button @click="setNewPassword" class="button__orange form__items">Valider</button>
        </div>
        <div v-if="linkExpired">
            <p class="link__expired">Ce lien a expiré, merci de recommencer la réinitialisation de votre mot de passe.</p>
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
            token_db: null,
            token_url: this.$route.query.token,
            email_db: null,
            exp_date_db: null,
            linkExpired: null
        }
    },
    async mounted() {
        const response = await UserService.findForResetPass(this.$route.query.key);
        if (response.id) {
            this.token_db = response.meta.reset_token;
            this.email_db = response.meta.reset_email;
            this.exp_date_db = response.meta.exp_date; 

            if (Date.parse(this.exp_date_db) >= this.currentDate && this.token_db === this.token_url) { // Date.parse() transforme un string en milliseconde depuis le 01/01/1970
                this.linkExpired = false;
            } else {
                this.linkExpired = true;
                const form_items = document.querySelectorAll('.form__items');
                form_items.forEach(item => {
                    item.disabled = true;
                    item.classList.add('disabled');
                });
            }
        }
        console.log(response);
    },
    methods: {
        setNewPassword() {
            this.errors = [];

            if (!this.password) {
                this.errors.push('Le mot de passe ne doit pas être vide');
            }
            if (!this.passConfirm) {
                console.log('ici');
                this.errors.push('La confirmation du mot de passe ne doit pas être vide');
            }
            if (this.password && this.passConfirm && this.passConfirm !== this.password) {
                this.errors.push('Les mots de passes doivent être identiques');
            }

            if (this.errors.length === 0) {
                console.log('ok');
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