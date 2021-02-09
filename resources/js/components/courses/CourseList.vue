<template>
    <div class="container">
        <tabs name="bla">
            <tab name="Courses" :selected="true">
                <div class="row">
                    <course-card v-for="course in courses" v-bind:key="course.id" :name="course.name"
                        :description="course.description" :id="course.id" :lectures="course.lectures">
                    </course-card>
                </div>
            </tab>
            <tab name="New">
                <div class="row col-md-12">
                    <!-- BEGIN -->
                    <div class="col-md-4 clearfix">
                        <div class="card text-primary bg-white">
                            <div class="card-header clear-fix">
                                <div class="col-md-10 float-left">
                                    Novo
                                </div>
                            </div>
                            <div class="card-body clear-fix">
                                <div class="form-group col-md-12">
                                    <input type="text" class="form-control" :class="{ 'border-danger' : newName == '' }"
                                        v-model="newName" placeholder="Curso...">
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" class="form-control"
                                        :class="{ 'border-danger' : newDescription == '' }" v-model="newDescription"
                                        placeholder="Descrição do curso...">
                                </div>
                                <div class="form-group col-md-12 clear-fix">
                                    <button type="button" class="btn btn-outline-primary float-right"
                                        v-if="newName != '' && newDescription != ''" @click="addCourse()">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END -->
                </div>
            </tab>
        </tabs>
    </div>
</template>


<script>
    export default {
        props: {
            name: String,
            description: String,
            id: Number,
            lectures: Array,
            user_id: Number,
        },

        data() {
            return {
                courses: [],
                error: [],

                // Fields to add a course
                newName: '',
                newDescription: '',

            }
        },
        mounted() {
            axios.get('/courses-list').then(response => this.courses = response.data);
            console.log('courses mounted');
        },

        methods: {
            addCourse: async function (e) {
                var newCourse = {
                    "name": this.newName,
                    "description": this.newDescription,
                    "lectures": [],
                    "professor_id": '1',
                    "id": this.courses.length+1,
                };

                this.courses.push(newCourse);
                this.courses.length;
                this.clearEditCourseFields();

                axios.post('/courses', {
                        "name": newCourse.name,
                        "description": newCourse.description,
                        "professor_id": this.user_id,

                    })
                    .then(res => {
                        commit('CREATE_COURSE', res.data)
                    }).catch(err => {
                        console.log(err)
                    });
            },

            clearEditCourseFields() {
                this.newName = '';
                this.newDescription = '';
                this.newLink = '';
            },
        },
    }

</script>
