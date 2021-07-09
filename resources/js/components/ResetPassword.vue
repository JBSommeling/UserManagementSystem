<template>
  <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ fields['title'] }}</div>

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
            // Eem validation in de controller maken met email en antwoord. Deze moeten samen kloppen. Daarna kun je wachtwoord wijzigen.
        }
    }
}
</script>

<style>

</style>