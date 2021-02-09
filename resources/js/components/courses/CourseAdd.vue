<template>

</template>
<script>
    export default {
        props: {
            name: String,
            description: String,
            id: Number,
        },

        data() {
            return {
                courses: [],

                // Fields to add a lecture
                newName: '',
                newDescription: '',

            }
        },
        mounted() {},
        methods: {
            addCourse: function (e) {
                var newCourse = {
                    "name": this.newName,
                    "description": this.newDescription,
                };

                if (this.newName == '') {
                    this.error.push({
                        'name': true
                    });
                }
                if (this.newDescription == '')
                    this.error.push({
                        'description': true
                    });

                if (this.newLink == '')
                    this.error.push({
                        'link': true
                    });

                console.log(this.error);

                if (this.error.length == 0) {
                    this.courses.push(newCourse);
                    console.log(newCourse);

                    axios.post('/courses', {
                            "name": newCourse.name,
                            "description": newCourse.description,

                        })
                        .then(res => {
                            commit('CREATE_COURSE', res.data)
                        }).catch(err => {
                            console.log(err)
                        });
                }

            },
        }

</script>
