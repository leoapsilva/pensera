<template>
    <!-- BEGIN lecture-list -->
    <div class="list-group" id="list-tab" role="tablist"
        style="overflow:scroll;max-height: 250px;-webkit-overflow-scrolling: touch;">

        <div v-for="lecture in lectures" v-bind:key="lecture.id" class="col-md-12 clearfix">
            <lecture    :name="lecture.name"
                        :description="lecture.description"
                        :link="lecture.link"
                        :selected="selected"
                        :id="lecture.id"
                        :selectedId="selectedId"
                        @lecture-selected="selectLecture"> </lecture>
        </div>
    </div>
    <!-- END lecture-list -->
</template>

<script>
    import Lecture from './Lecture.vue';
    export default {
        components:{
            Lecture,
        },

        props: {
            lectures: Array,
            selectedId: 0
        },

        data() {

            return {
                selected: 0,
            }
        },
        
        methods: {

            selectLecture($event) {
                this.selected = $event.id;
                this.lectures.forEach(lecture => {
                    lecture.selected = (lecture.id == this.selectedId);
                });
                this.$emit('lecture-selected', $event);
            },

            addLecture: function(e) {
                var newLecture = {
                    "id": this.nextLecture,
                    "name": this.newName,
                    "description": this.newDescription,
                    "link": this.newLink,
                    "active": true,
                };

                if (this.newName == '') {
                    this.error.push({ 'name': true });
               }
                    
                if (this.newDescription == '')
                    this.error.push({ 'description': true });

                if (this.newLink == '')
                    this.error.push({ 'link': true });

                console.log(this.error);
 
                if (this.error.length == 0)
                {
                    this.lectures.push(newLecture);
                    this.selectLecture(newLecture);
                    this.nextLecture++;
                    this.toggleAddLecture();
                    this.clearEditLectureFields();
                    this.error = [];
                }
           },

           /**
            * Next step:
            * Using https://www.npmjs.com/package/youtube-player
            * Listen event of video finished then:
            *   - Jump to the next
            *   - Mark as seen
            *   - Update student progress
            * 
            * Leo - 01/02/2020
            * 
            onYouTubeIframeAPIReady() {
                    this.player = new YT.Player('player', {
                    videoId: this.selectLecture.link,
                    events: {
                        'onStateChange': function(evt){
                            if(evt.data == 0){
                                window.external.Test('Video finished!!');
                            }
                        }
                    }
                })
            },
            */

            deleteLecture: async function(id) {
                this.nextLecture--;
                var index = this.lectures.map(function(e) { return e.id; }).indexOf(id);
                this.lectures.splice(index, 1);
                if (index + 1 > this.lectures.length) {
                    this.selectLecture(this.lectures[index - 1]);
                }
                else{
                    this.selectLecture(this.lectures[index]);
                }
                
            },

            toggleAddLecture() {
                this.LectureEdit.toggleEdit();
                this.LectureAdd.toggleAdd();
            },
        }, 


    }

</script>
