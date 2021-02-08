<template>
    <!-- BEGIN lecture-add -->
    <div class="card text-primary bg-white" style="width: 23rem;" v-if="form.active">
        <div class="card-header clear-fix">
            <div class="col-md-10 float-left">
                Novo
            </div>
            <div class="col-md-2 float-right">
                <button type="button" class="close" aria-label="Close" 
                    @click="form.toggleActive()"
                    @toggle-edit="form.toggleActive()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div class="card-body clear-fix">
            <div class="form-group col-md-12">
                <input type="text" class="form-control" :class="{ 'border-danger' : !form.name }" v-model="form.name"
                    placeholder="Aula...">
            </div>
            <div class="form-group col-md-12">
                <input type="text" class="form-control" :class="{ 'border-danger' : !form.description }"
                    v-model="form.description" placeholder="Descrição da aula...">
            </div>
            <div class="col-md-12 my-1">
                <label class="sr-only" for="newLink">video ID</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">youtube.com/watch?v=</div>
                    </div>
                    <input type="text" class="form-control" :class="{ 'border-danger' : !form.link }"
                        v-model="form.link" placeholder="v1de01D">
                </div>
            </div>
            <div class="form-group col-md-12 clear-fix">
                <button type="button" class="btn btn-outline-primary float-right"
                    v-if="form.name && form.description && form.link" @click="form.submit()">Add</button>
            </div>
        </div>
    </div>
    <!-- END lecture-add -->
</template>

<script>
    class Form {

        constructor(data) {

            this.active = false;
            this.edit = [];
            this.data = data;

            for (let field in data) {

                this[field] = data.field;
                this.edit[field] = false;
            }
        }

        reset() {

            for (let field in this.data) {
                this[field] = '';
            }

        }

        toggleActive() {
            this.active = !this.active  ;
        }

        toggleEditField(field) {
            this.edit[field] = !this.edit[field];
        }

        // event
        submit() {
            var msg = '';
            
            for (let field in this.data) {
                msg = msg + " " + this[field];
            }

            alert(msg);
        }
        
    }

    export default {

        data() {

            return {
                form: new Form({

                    name: "",
                    description: "",
                    link: "",

                }),
            }
        },

        methods:{

            toggleAdd() {

                this.form.toggleAdd();

            },

        },


    }

</script>
