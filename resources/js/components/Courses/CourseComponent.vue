<template>
    <div class="container">
        <div class="course">
            <div class="row">
                <div class="col-8 ">
                    <h1> {{this.courseName}} </h1>
                    <h3> {{this.courseDescription}} </h3>
                    <div class="tab-content" id="nav-tabContent">

                        <!-- Refactory to a component! -->
                        <!-- BEGIN lecture-video-component -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" :src="lectureSRC" allowfullscreen> </iframe>
                        </div>
                        <!-- 
                            The solution using just one iframe is faster for the first video.
                            Loading: 24 requisitions, 1.8MB transferred, 4.3MB resources, 5.19s for 6 videos.

                            But it refreshes the iframe every time the user select a new lecture.
                            The solution below prefetches all the videos on iframe, making 
                            faster switching among lectures.
                            Loading: 84 requests, 6.0MB transferred, 15.7MB resources, 16.75s for 6 videos.                                    

                            Leo -- 29/01/2021.
                        -->

                        <!-- <div v-for="lecture in lectures" v-bind:key="lecture.id" class="tab-pane fade show"
                                :class="{ 'active': lecture.active }" :id="lecture.active" role="tabpanel"
                                aria-labelledby="list-home-list">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" :src="lecture.src" allowfullscreen> </iframe>
                                </div>
                        </div>-->
                    </div>
                    <!-- END lecture-video-component -->
                    <!-- Refactory to a component! -->
                </div>

                <div class="col-4 clearfix">
                    <div class="card bg-white" style="width: 25rem;">
                        <div class="card-header col-md-12">
                            <div class="col-md-10 float-left">
                                <h5>{{courseName}}</h5>
                            </div>
                            <div class="col-md-2 float-left">
                                <h4> <span class="badge badge-primary"> {{newLectures.length}}</span></h4>
                            </div>
                        </div>
                        <div class="card-body">

                            <!-- Refactory to a component! -->
                            <!-- BEGIN lecture-new-component -->
                            <div class="card text-primary bg-white" style="width: 23rem;" v-if="addLectureActive">
                                <div class="card-header clear-fix">
                                    <div class="col-md-10 float-left">
                                        Novo
                                    </div>
                                    <div class="col-md-2 float-right">
                                        <button type="button" class="close" aria-label="Close"
                                            @click="toggleAddLecture()">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body clear-fix">
                                    <div class="form-group col-md-12">
                                        <input  type="text" 
                                                class="form-control" 
                                                :class="{ 'border-danger' : newName == '' }"
                                                v-model="newName" 
                                                placeholder="Aula..." >
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input  type="text" 
                                                class="form-control" 
                                                :class="{ 'border-danger' : newDescription == '' }"
                                                v-model="newDescription"
                                                placeholder="Descrição da aula...">
                                    </div>
                                    <div class="col-md-12 my-1">
                                        <label class="sr-only" for="newLink">video ID</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">youtube.com/watch?v=</div>
                                            </div>
                                            <input  type="text" 
                                                    class="form-control"
                                                    :class="{ 'border-danger' : newLink == '' }"
                                                    v-model="newLink"
                                                    placeholder="v1de01D" >
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 clear-fix">
                                        <button type="button" 
                                                class="btn btn-outline-primary float-right"
                                                v-if="newName != '' && newDescription != '' && newLink != ''"
                                                @click="addLecture()">Add</button>
                                    </div>
                                </div>
                            </div>
                            <!-- END lecture-new-component -->
                            <!-- Refactory to a component! -->

                            <!-- Refactory to a component! -->
                            <!-- BEGIN lecture-edit-component -->
                            <!-- Lecture Name: Edit card -->
                            <div class="card text-white bg-primary clearfix" style="width: 25rem;" v-if="!addLectureActive">
                                <div class="card-header col-md-12">
                                    <div class="col-md-10">
                                        Toque no texto para editar.<br>
                                        Toque fora ou tab para confirmar.
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-outline-light float-right"
                                            @click="toggleAddLecture()">+</button>
                                    </div>
                                </div>

                                <div class="card-body">

                                    <div class="lecture-edit">
                                        <!-- Lecture Name: Toggle edit -->
                                        <div class="col-md-12">
                                            <h3 class="card-title text-white" v-if="!editLectureName"
                                                @click="toggleEditLectureName()">{{selectedLecture.name}}</h3>
                                        </div>

                                        <!-- Lecture Name: Edit -->
                                        <div class="row clearfix" v-if="editLectureName">
                                            <div class="col-md-9">
                                                <input  type="text" class="form-control" 
                                                        v-model="selectedLecture.name"
                                                        v-html="selectedLecture.name"
                                                        @blur="updateLecture(selectedLecture.id, 'name')">
                                            </div>
                                            
                                            <!-- Lecture Name: Disable edit -->
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-outline-light float-left"
                                                    @click="updateLecture(selectedLecture.id, 'name')">Ok</button>
                                            </div>
                                        </div>

                                        <!-- Adjust paragraph -->
                                        <p v-if="editLectureName || editLectureDescription"></p>

                                        <!-- Lecture Description: Toggle edit -->
                                        <div class="col-md-12">
                                            <p class="card-text lead" v-if="!editLectureDescription"
                                                @click="toggleEditLectureDescription()">{{selectedLecture.description}}</p>
                                        </div>

                                        <!-- Lecture Name: Edit  -->
                                        <div class="row clearfix" v-if="editLectureDescription">
                                            <div class="col-md-9">
                                                <input  type="text" class="form-control"
                                                        v-model="selectedLecture.description" 
                                                        v-html="selectedLecture.description"
                                                        @blur="updateLecture(selectedLecture.id, 'description')">
                                            </div>
                                            <!-- Lecture Name: Disable edit -->
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-outline-light float-left"
                                                    @click="updateLecture(selectedLecture.id, 'description')">Ok</button>
                                            </div>
                                        </div>

                                        <!-- Adjust paragraph -->
                                        <p v-if="editLectureDescription || editLectureLink"></p>

                                        <!-- Lecture Link: Toggle edit -->
                                        <div class="col-md-12">
                                            <p class="card-text lead" v-if="!editLectureLink"
                                                @click="toggleEditLectureLink()">
                                                <span class="border-bottom border-light">
                                                    youtube.com/{{selectedLecture.link}}
                                                </span
                                            ></p>
                                        </div>
                                        
                                        <!-- Lecture Link: Toggle edit -->
                                        <div class="row cleafix" v-if="editLectureLink">
                                            <div class="input-group col-md-9">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">youtube.com/</div>
                                                </div>
                                                <input  type="text" class="form-control" 
                                                        v-model="selectedLecture.link"
                                                        @blur="updateLecture(selectedLecture.id, 'link')"
                                                        placeholder="v1de01D">
                                            </div>

                                            <!-- Lecture Link: Disable edit -->
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-outline-light float-left"
                                                    v-if="editLectureLink"
                                                    @click="updateLecture(selectdLecture.id, 'link')">Ok</button>
                                            </div>
                                        </div>
                                    </div> 
                                    <!-- END lecture-edit-component -->
                                    <!-- Refactory to a component! -->

                                </div>
                            </div>
                        </div>

                        <!-- Refactory to a component! -->
                        <!-- BEGIN lectures-component -->
                        <div class="list-group" id="list-tab" role="tablist"
                            style="overflow:scroll;max-height: 250px;-webkit-overflow-scrolling: touch;">

                            <div v-for="lecture in newLectures" v-bind:key="lecture.id" class="col-md-12 clearfix">
                                <div class="col-md-10 float-left">
                                    <a role="tab" class="list-group-item list-group-item-action"
                                        :class="{ 'active': lecture.name == lectureName }" :id="lecture.id"
                                        :href="lecture.href" :aria-controls="lecture.ariaControls"
                                        @click="selectLecture(lecture)">{{lecture.name}}</a>
                                </div>
                                <div class="col-md-2 float-right">
                                    <button type="button" class="btn btn-outline-primary bg-light "
                                        @click="deleteLecture(lecture.id)">-</button>
                                </div>
                            </div>
                        </div>
                        <!-- END lectures-component -->
                        <!-- Refactory to a component! -->

                    </div>
                </div>
            </div>
        </div>

        <div class="course-detail">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            name: {
                string: ''
            },
            description: {
                string: ''
            },
            id: {
                number:''
            }
        },
        data() {
            return {
                //courses array
                courses: [],
                
                // Array of VueComponents - comes at first render
                lectures: [],

                // Array of Objects - created based on lectures
                newLectures: [],
                // Lecture id counter
                nextLecture: 0,

                courseName: this.name,
                courseDescription: this.description,
                courseId: this.id,

                // Selected Lecture - current Lecture 
                selectedLecture: [],

                //Error array
                error: [],

                // Trocar para selected
                lectureName: '',
                lectureDescription: '',
                lectureLink: '',
                lectureSRC: '',

                // Fields to add a lecture
                newName: '',
                newDescription: '',
                newLink: '',

                // Flags to enable editing a lecture
                editLectureName: false,
                editLectureDescription: false,
                editLectureLink: false,
                addLectureActive: false,

                //YT
                player:'',
            }
        },
        created() {
            this.lectures = this.$children;
            this.nextLecture = this.lectures.length + 1;
        },

        mounted() {

            this.lectures.forEach(lecture => {
                this.newLectures.push({
                    "id": lecture.id,
                    "name": lecture.name,
                    "description": lecture.description,
                    "link": lecture.link,
                    "course_id": this.courseId,
                    "active": lecture.active
                });
                this.nextLecture++;
            });
            this.lectures.forEach(lecture => {
                if (lecture.active) {
                    this.lectureName = lecture.name;
                    this.lectureDescription = lecture.description;
                }
            });
            this.lectureLink = this.newLectures[0].link;
            this.selectedLecture = this.newLectures[0];
            this.selectLecture(this.selectedLecture);
        },

        methods: {
            selectLecture(selectedLecture) {
                this.lectureName = selectedLecture.name;
                this.lectureDescription = selectedLecture.description;
                this.lectureLink = selectedLecture.link;
                this.lectureId = selectedLecture.id;
                this.lectures.forEach(lecture => {
                    lecture.active = (lecture.name == selectedLecture.name);
                });
                this.selectedLecture = selectedLecture;
                this.setLectureSRC();
            },
            setLectureSRC() {
                this.lectureSRC = 'https://www.youtube.com/embed/' + this.lectureLink + '?rel=0'
                // When using YT.player add --> &enablejsapi=1
            },

            addLecture: function(e) {
                var newLecture = {
                    "name": this.newName,
                    "description": this.newDescription,
                    "link": this.newLink,
                    "course_id": this.courseId,
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
                    this.newLectures.push(newLecture);
                    this.selectLecture(newLecture);
                    this.nextLecture++;
                    this.toggleAddLecture();
                    this.clearEditLectureFields();
                    this.error = [];
                    console.log(newLecture);

                    axios.post('/lecture',
                                {          "name":  newLecture.name,
                                            "description": newLecture.description,
                                            "link": newLecture.link,
                                            "course_id": this.courseId,
                                    
                            })
                        .then(res => {
                            commit('CREATE_LECTURE', res.data)
                        }).catch(err => {
                        console.log(err)
                    });
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

            deleteLecture(id) {
                this.nextLecture--;
                var index = this.newLectures.map(function(e) { return e.id; }).indexOf(id);
                this.newLectures.splice(index, 1);
                if (index + 1 > this.newLectures.length) {
                    this.selectLecture(this.newLectures[index - 1]);
                }
                else{
                    this.selectLecture(this.newLectures[index]);
                }
                
                axios.delete('/lecture/'+id)
                .then(res => {
                    commit('DELETE_LECTURE', res.data)
                }).catch(err => {
                console.log(err)
                });
            },

            doUpdateLecture: async function(id) {
                var updatedLecture = {  
                    "id": id,
                    "name":  this.selectedLecture.name,
                    "description": this.selectedLecture.description,
                    "link": this.selectedLecture.link,
                    "course_id": this.courseId,
                                };

                axios.put('/lecture/'+updatedLecture.id, updatedLecture)
                    .then(res => {
                        commit('UPDATE_LECTURE', res.data)
                    }).catch(err => {
                    console.log(err)
                    });
            },

            updateLecture(id, field) {
                
                var index = this.lectures.map(function(e) { return e.id; }).indexOf(id);

                if(field == 'name')  
                    this.toggleEditLectureName();

                if(field == 'description')
                    this.toggleEditLectureDescription();

                if(field == 'link')
                    this.toggleEditLectureLink();

                if (this.selectedLecture[field] != this.lectures[index][field])
                    this.doUpdateLecture(id);
            },

            clearEditLectureFields() {
                this.newName = '';
                this.newDescription = '';
                this.newLink = '';
            },

            toggleEditLecture(field) {
                this.editLecture[field] = !this.editLecture[field];
            },

            toggleEditLectureName() {
                this.editLectureName = !this.editLectureName;
            },
            toggleEditLectureDescription() {
                this.editLectureDescription = !this.editLectureDescription;
            },
            toggleEditLectureLink() {
                this.editLectureLink = !this.editLectureLink;
                this.selectLecture(this.selectedLecture);
            },
            toggleAddLecture() {
                this.addLectureActive = !this.addLectureActive;
            },
        },
    }

</script>
