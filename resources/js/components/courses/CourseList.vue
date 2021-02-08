<template>
    <div class="container">
        <div class="row">
            <course-card v-for="course in courses" 
                    v-bind:key="course.id"
                    :name="course.name"
                    :description="course.description"
                    :id="course.id"
                    :lectures="course.lectures">
            </course-card>
        </div>
    </div>
</template>


<script>
    export default {
        props: {
                name: String,
                description: String,
                id: Number,
                lectures: Array,            
        },

        data() {
            return {
                courses: [],
            }
        },
        mounted() {
            axios.get('/course-list').then(response => this.courses = response.data);
            console.log('courses mounted');
        },
        methods: {},
    }

</script>


/* <div class="container">
    <div class="course">
        <div class="row">
            <div class="col-8 ">
                <div v-for="course in courses" v-bind:key="course.id">
                    <h1> {{course.name}} </h1>
                    <h3> {{course.description}} </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="courses-detail">
        <slot></slot>
    </div>
</div>
*/
