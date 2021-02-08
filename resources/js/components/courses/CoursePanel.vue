<template>
    <div class="container">
        <div class="course">
            <div class="row">
                <course-video-frame :courseName="course.name"
                                    :courseDescription="course.description"
                                    :videoLink="videoLink"> </course-video-frame>
                
                <course-lectures-panel :lectures="course.lectures"
                                       :courseName="course.name" @lecture-selected="updateVideoLink($event)"> </course-lectures-panel>
            </div>
        </div>
    </div>
</template>

<script>
    import CourseVideoFrame from './CourseVideoFrame.vue';
    import CourseLecturesPanel from './CourseLecturesPanel.vue';

    export default {
        components: {
            CourseVideoFrame,
            CourseLecturesPanel
        },
        props: {
            id: Number,
            lectures: [],
            courseName: String,
        },

        data() {
            return {
                course: {},
                videoLink: '',
            }
        },

        methods:{
            updateVideoLink(event){
                this.videoLink = event.link;
            }
        },

        created() {
            this.lectures = this.course.lectures;
        },

        mounted() {
            axios.get('/course-list/' + this.id)
                .then(response => this.course = response.data);

            console.log('course mounted');
        },
    }

</script>
