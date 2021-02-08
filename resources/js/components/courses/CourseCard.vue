<template>
    <div class="col-md-4 clearfix">
        <div class="card">
            <div class="card-header col-md-12">
                <div class="col-md-10 float-left">
                    <h5 class="card-title">{{name}}</h5>
                </div>
                <div class="col-md-2 float-left">
                    <h4> <span class="badge badge-primary"> {{lectures.length}}</span></h4>
                </div>
            </div>
            <div class="card-body clear-fix">
                <p class="card-text">{{description}}</p>
                <a :href="href" class="btn btn-primary float-right">Começar</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        props: {
            id: 0,
            name: '',
            description:  '',
            lectures: Array,
        },

        data() {
            return {
            }
        },

        created() {
        },

        methods: {
            mounted() {
                console.log('course mounted');
            },
        },
        computed: {
            href() {
                return '/courses/' + this.id;
            },
        }
    }

</script>
