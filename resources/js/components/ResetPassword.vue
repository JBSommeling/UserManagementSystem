<template>
  <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Reset Password</div>

                <div class="card-body">
                    <form method="POST">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-mail Adress</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control is-invalid" name="email" value="" required autocomplete="email" autofocus>
                                <span class="invalid-feedback" role="alert">
                                    <strong>Bericht hier</strong>
                                </span>
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
    }
}
</script>

<style>

</style>