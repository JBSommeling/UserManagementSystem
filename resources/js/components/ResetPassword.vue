<template>
  <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ fields['title'] }}</div>
                <div v-if="allowed" class="card-body">
                    <form method="POST" @submit.prevent="changePassword">
                            <text-input
                                :errors="this.errors"
                                :label="fields['password']"
                                :name="'password'"
                                v-model="password"
                                :type="'password'"
                            ></text-input>

                            <text-input
                                :label="fields['password_confirm']"
                                :name="'password-confirm'"
                                v-model="password_confirm"
                                :type="'password'"
                            ></text-input>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ fields['submit'] }}
                                    </button>                               
                                </div>
                            </div>
                        </form>
                </div>
                <div v-else>
                    <div v-if="this.question" class="card-body">
                        <div class="row">
                            <p class="col-12">{{ this.question }}</p>
                        </div>
                    
                        <form method="POST" @submit.prevent="submitAnswer">
                            <text-input
                                :errors="this.errors"
                                :label="fields['answer']"
                                :name="'answer'"
                                v-model="answer"
                                :type="'text'"
                            ></text-input>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ fields['submit'] }}
                                    </button>                               
                                </div>
                            </div>
                        </form>
                    </div>

                    <div v-else class="card-body">
                        <form method="POST" @submit.prevent="submitEmail">
                            <text-input
                                :errors="this.errors"
                                :label="fields['email']"
                                :name="'email'"
                                v-model="email"
                                :type="'text'"
                            ></text-input>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ fields['submit'] }}
                                    </button>                               
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Text from './inputs/Text.vue'

export default {
    components: {
        TextInput: Text,
    },
    props: {
        fields: Object,
    },

    data() {
        return {
            email: '',
            question: '',
            answer: '',
            errors: '',
            allowed: '',

            password: '',
            password_confirm: '',
        }
    },

    methods: {
        /**
         * Method to submit and validate email. If true, the question will be
         * retrieved.
         */
        submitEmail() {
            this.errors = '';
            axios.post(`/api/email/validate`, { email: this.email })
            .catch(err => {
                return this.errors = err.response.data.errors.email 
            })
            .then(data => this.question = data.data);
        },

        /**
         * Method to submit the answer to the question. If the question is legit, the user is able to 
         * edit the password.
         */
        submitAnswer() {
            this.errors = '';
            axios.post(`/api/password/compare`, {answer: this.answer, email: this.email})
            .catch(err => this.errors = err.response.data.errors.answer)
            .then(allowance => {
                this.allowed = allowance.data;
                if (this.allowed == false)
                    this.errors = this.fields['answer_not_found'];
            });        
        },

        /**
         * Method submit the new password to the Api.
         */
        changePassword() {
            this.errors = '';
            axios.post(`/api/password/reset`, { 
                    password: this.password, 
                    password_confirmation: this.password_confirm, 
                    email: this.email,
                    answer: this.answer,
                })
            .then(data => window.location.href = '/?message=password_changed')
            .catch(err => 
                {
                    // Show error if access is forbidden
                    if (err.response.status == 403)
                     window.location.href = '/403';
                    
                    // else just give error if any.
                    this.errors = err.response.data.errors.password;
                });
        }
    }
}
</script>

<style>

</style>