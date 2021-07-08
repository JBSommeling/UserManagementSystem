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
                        <div class="form-group row">
                            <label for="answer" class="col-md-4 col-form-label text-md-right">{{ fields['answer'] }}</label>

                            <div class="col-md-6">
                                <input id="answer" type="text" class="form-control" :class="{'is-invalid' : this.errors}" name="answer" v-model="answer" required autocomplete="answer" autofocus>
                                <span v-if="errors" class="invalid-feedback" role="alert">
                                    <strong v-for="(error, index) in errors" key="index">{{ error }}</strong>
                                </span>
                            </div>
                        </div>
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
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ fields['email']}}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" :class="{'is-invalid' : this.errors}" name="email" v-model="email" required autocomplete="email" autofocus>
                                <span v-if="errors" class="invalid-feedback" role="alert">
                                    <strong v-for="(error, index) in errors" key="index">{{ error }}</strong>
                                </span>
                            </div>
                        </div>
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
export default {
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