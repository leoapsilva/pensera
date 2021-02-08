<template>
    <div class="col-4 clearfix">
        <div class="card bg-white" style="width: 25rem;">
            <div class="card-header col-md-12">
                <div class="col-md-10 float-left">
                    <h5>{{courseName}}</h5>
                </div>
                <div class="col-md-2 float-left">
                    <h4> <span class="badge badge-primary" v-bind="episodes"></span></h4>
                </div>
            </div>
            <div class="card-body">

                <!-- <lecture-add>  </lecture-add> -->
                <lecture-edit   :id="id"
                                :name="name"
                                :description="description"
                                :link="link"> </lecture-edit>
                <lecture-list   :lectures="lectures" 
                                @lecture-selected="selectLecture($event)"> </lecture-list>

            </div>
        </div>
    </div>
</template>

<script>
    import LectureEdit from './LectureEdit.vue'
    import LectureAdd from './LectureAdd.vue'
    import LectureList from './LectureList.vue'

    export default {
        components: {   LectureEdit,
                        LectureAdd,
                        LectureList
                    },
        props: {
            id: Number,
            lectures: Array,
            courseName: String,
            lectures: Array,
            episodes: Number,   
        },

        data() {
            return {
                error: [],
                name: '',
                description: '',
                link: '' 
            }
        },

        methods: {
            selectLecture(event){
                this.id = event.id;
                this.name = event.name;
                this.description = event.description,
                this.link = event.link;
                this.$emit('lecture-selected', event);
            }

        },

        created() {
        },

        mounted() {
        },
    }
                        

</script>
