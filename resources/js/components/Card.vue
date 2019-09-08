<template>
    <card class="card card relative metric px-6 py-4 relative card-panel card-panel">
        <div class="flex mb-4"><h3 class="mr-3 text-base text-80 font-bold">
            {{ name }}
        </h3></div>
        <input v-model="currentValue" type="text" class="w-full form-control form-input form-input-bordered">
        <button @click="updateConfig()" class="btn btn-default btn-primary mt-4">
            Update
        </button>
        <button @click="resetConfig()" class="btn btn-default btn-danger mt-4">
            Reset
        </button>
    </card>
</template>

<script>
    export default {
        props: [
            'card',
        ],
        data() {
            return {
                key: '',
                name:'',
                defaultValue:'',
                currentValue:'',
                type:''
            }
        },
        methods: {
            updateConfig() {
                Nova.request().post('/nova-vendor/cache-config', {
                    'value': this.currentValue,
                    'key': this.key,
                    'default': this.defaultValue,
                    'type':this.type
                })
                    .then(response => {
                        this.$toasted.show('Config Updated Successfully !!', {type: 'success'})
                    })
                    .catch(error => {
                        if(error.response.status === 422){
                            this.$toasted.show('Oops!! Validation Failed', {type: 'error'})
                        }else{
                            this.$toasted.show('Oops!! Failed to Update Config', {type: 'error'})
                        }
                    })
            },
            resetConfig() {
                let vm = this;
                Nova.request().delete('/nova-vendor/cache-config',
                    { data:{
                    'key': this.key,
                    'default': this.defaultValue,
                }})
                    .then(response => {
                        this.$toasted.show('Config Reset Successfully !!', {type: 'success'});
                        vm.currentValue = vm.defaultValue;
                    })
                    .catch(error => {
                        this.$toasted.show('Oops!! Config to Reset', {type: 'error'})
                    })
            }
        },

        mounted() {
            this.key = this.card.key;
            this.name = this.card.name;
            this.defaultValue = this.card.defaultValue;
            this.currentValue = this.card.currentValue;
            this.type = this.card.type;
        },
    }
</script>
