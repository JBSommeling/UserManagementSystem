<template>
  <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ fields['title'] }}</div>

                <div class="card-body">
                    <form method="POST" @submit.prevent="submit">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ fields['email']}}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control is-invalid" name="email" value="" required autocomplete="email" autofocus>
                                <span class="invalid-feedback" role="alert">
                                    <strong>Error hier</strong>
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
        fields: "",
    },
    methods: {
        submit() {
            axios.post
        }
    }
}
</script>

<style>

</style>