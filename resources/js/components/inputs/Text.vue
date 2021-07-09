<template>
  <div class="form-group row">
        <label for="answer" class="col-md-4 col-form-label text-md-right">{{ this.label }}</label>

        <div class="col-md-6">
            <input :id="this.name" :type="this.type" class="form-control" :class="{'is-invalid' : this.errors}" :name="this.name" v-model="inputVal" required :autocomplete="this.name" autofocus>
            <span v-if="errors" class="invalid-feedback" role="alert">
                <strong v-for="(error, index) in this.errors" :key="index">{{ error }}</strong>
            </span>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        label: String,
        errors: '',
        name: String,
        type: 'text'
    },
    data() {
        return {
            value: '',
        }
    },
    computed: {
        inputVal: {
            get() {
                return this.value;
            },
            set(val) {
                this.$emit('input', val);
            }
        }
    }
}
</script>

<style>

</style>