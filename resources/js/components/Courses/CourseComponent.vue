<template>
    <div class="container">
        <div class="course">
            <div class="row">
                <div class="col-8 ">
                    {{this.lectureSRC}}
                    <div class="tab-content" id="nav-tabContent">
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
                </div>

                <div class="col-4 clearfix">
                    <div class="card bg-white" style="width: 25rem;">
                        <div class="card-header">
                            <div class="col-12">
                                <h5>{{courseName}}</h5>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="card text-primary bg-white" style="width: 23rem;" v-if="addLectureActive">
                                <div class="card-header">
                                    New Lecture
                                </div>
                                <div class="card-body">
                                    <div class="form-group col-md-12">
                                        <label for="newName">Title</label>
                                        <input type="text" class="form-control" v-model="newName" placeholder="Aula...">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="newDescription">Title</label>
                                        <input type="text" class="form-control" v-model="newDescription"
                                            placeholder="Descrição da aula...">
                                    </div>
                                    <div class="col-md-12 my-1">
                                        <label class="sr-only" for="newLink">video ID</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">youtube.com/watch?v=</div>
                                            </div>
                                            <input type="text" class="form-control" v-model="newLink"
                                                placeholder="v1de01D">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-outline-primary float-left"
                                            @click="addLecture()">Add</button>
                                    </div>
                                </div>
                            </div>


                            <!-- <h5 class="card-title"><strong>{{courseName}}</strong></h5> -->
                            <!-- <p class="card-text lead">{{courseDescription}}</p> -->

                            <div class="card text-white bg-primary" style="width: 25rem;">
                                <div class="card-header clearfix">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-outline-light float-left"
                                            @click="toggleAddLecture()">Novo</button>
                                        <button type="button"
                                            class="btn btn-outline-primary bg-light float-right"
                                            @click="deleteLecture()">Del</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <h3 class="card-title text-white" v-if="!editLectureName"
                                            @click="toggleEditLectureName()">{{selectedLecture.name}}</h3>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="selectedLecture.name"
                                                v-if="editLectureName" v-html="selectedLecture.name">
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-outline-light float-left"
                                                v-if="editLectureName" @click="toggleEditLectureName()">Ok</button>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <p v-if="editLectureName || editLectureDescription"></p>
                                        <p class="card-text lead" v-if="!editLectureDescription"
                                            @click="toggleEditLectureDescription()">{{selectedLecture.description}}</p>
                                    </div>


                                    <div class="row clearfix">
                                        <div class="col-md-9">
                                            <input type="text" class="form-control"
                                                v-model="selectedLecture.description" v-if="editLectureDescription"
                                                v-html="selectedLecture.description">
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-outline-light float-left"
                                                v-if="editLectureDescription"
                                                @click="toggleEditLectureDescription()">Ok</button>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="list-group" id="list-tab" role="tablist"
                            style="overflow:scroll;max-height: 250px;-webkit-overflow-scrolling: touch;">

                            <a v-for="lecture in newLectures" v-bind:key="lecture.id" role="tab"
                                class="list-group-item list-group-item-action"
                                :class="{ 'active': lecture.name == lectureName }" :id="lecture.id" :href="lecture.href"
                                :aria-controls="lecture.ariaControls"
                                @click="selectLecture(lecture)">{{lecture.name}}</a>
                        </div>
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
        },
        data() {
            return {
                lectures: [],
                nextLecture: 0,
                courseName: this.name,
                courseDescription: this.description,
                selectedLecture: [],
                lectureName: '',
                lectureDescription: '',
                lectureLink: '',
                lectureSRC: '',
                newName: '',
                newDescription: '',
                newLink: '',
                newLectures: [],
                editLectureName: false,
                editLectureDescription: false,
                editLectureLink: false,
                addLectureActive: false,
            }
        },
        created() {
            this.lectures = this.$children;
            this.nextLecture = this.lectures.length + 1;
        },

        mounted() {
            this.lectures.forEach(lecture => {
                this.newLectures.push({
                    "id": this.nextLecture,
                    "name": lecture.name,
                    "description": lecture.description,
                    "link": lecture.link,
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
            this.selectedLecture = this.newLectures[0]
            this.setLectureSRC();
            console.log(this.$children);
        },

        methods: {
            selectLecture(selectedLecture) {
                this.lectureName = selectedLecture.name;
                this.lectureDescription = selectedLecture.description;
                this.lectureLink = selectedLecture.link;
                this.lectures.forEach(lecture => {
                    lecture.active = (lecture.name == selectedLecture.name);
                });
                this.selectedLecture = selectedLecture;
                this.setLectureSRC()

            },
            setLectureSRC() {
                this.lectureSRC = 'https://www.youtube.com/embed/' + this.lectureLink + '?rel=0'
            },
            addLecture() {
                var newLecture = {
                    "id": this.nextLecture,
                    "name": this.newName,
                    "description": this.newDescription,
                    "link": this.newLink,
                    "active": true,
                };

                this.newLectures.push(newLecture);
                this.selectLecture(newLecture);
                this.nextLecture++;
                this.toggleAddLecture();
            },

            deleteLecture() {
                this.nextLecture--;
                var tempId = this.selectedLecture.id;
                alert(tempId);  
                this.newLectures.splice(tempId-1, 1);
                this.selectLecture(this.newLectures[tempId + 1]);
            },

            toggleEditLectureName() {
                this.editLectureName = !this.editLectureName;
            },
            toggleEditLectureDescription() {
                this.editLectureDescription = !this.editLectureDescription;
            },
            toggleEditLectureLink() {
                this.editLectureLink = !this.editLectureLink;
            },
            toggleAddLecture() {
                this.addLectureActive = !this.addLectureActive;
            },
        },
    }

</script>
<!--   <div class="card" style="width: 25rem;">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>
              </div>
            <div class="card-body">
              <h5 class="card-title">Tútulo do Curso</h5>
              <p class="card-text">Alguma explicação rápida sobre o curso.</p>
            </div>
            <ul class="list-group list-group-flush" role="tablist">
              <li class="list-group-item list-group-item-action active" id="list-aula-1-list" data-toggle="list" href="#list-aula-1" role="tab" aria-controls="aula-1">Aula 1 - Tema</li>
              <li class="list-group-item list-group-item-action" id="list-aula-2-list" data-toggle="list" href="#list-aula-2" role="tab" aria-controls="aula-2">Aula 2 - Tema</li>
              <li class="list-group-item list-group-item-action" id="list-aula-3-list" data-toggle="list" href="#list-aula-3" role="tab" aria-controls="aula-3">Aula 3 - Tema</li>
            </ul>
            <div class="card-body">
              <a href="#" class="card-link">Próxima</a>
              <a href="#" class="card-link">Anterior</a>
            </div>
          </div> -->



<!--                         <div class="tab-pane fade show active" id="list-home" role="tabpanel"
                            aria-labelledby="list-home-list">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item"
                                    src="https://www.youtube.com/embed/KQ6zr6kCPj8?rel=0" allowfullscreen></iframe>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="list-profile" role="tabpanel"
                            aria-labelledby="list-profile-list">

                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item"
                                    src="https://www.youtube.com/embed/HCfPhZQz2CE?rel=0" allowfullscreen></iframe>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="list-messages" role="tabpanel"
                            aria-labelledby="list-messages-list">

                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item"
                                    src="https://www.youtube.com/embed/OPf0YbXqDm0?rel=0" allowfullscreen></iframe>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="list-settings" role="tabpanel"
                            aria-labelledby="list-settings-list">

                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item"
                                    src="https://www.youtube.com/embed/ZbZSe6N_BXs?rel=0" allowfullscreen></iframe>
                            </div>
 -->


<!--                                     <a class="list-group-item list-group-item-action active" id="list-home-list"
                                        data-toggle="list" href="#list-home" role="tab" aria-controls="home">Home</a>
                                    <a class="list-group-item list-group-item-action" id="list-profile-list"
                                        data-toggle="list" href="#list-profile" role="tab"
                                        aria-controls="profile">Profile</a>
                                    <a class="list-group-item list-group-item-action" id="list-messages-list"
                                        data-toggle="list" href="#list-messages" role="tab"
                                        aria-controls="messages">Messages</a>
                                    <a class="list-group-item list-group-item-action" id="list-settings-list"
                                        data-toggle="list" href="#list-settings" role="tab"
                                        aria-controls="settings">Settings</a> -->

<!-- {"id": 7, "name": "Aula 7", "description": "Description", "link": "KQ6zr6kCPj8", "selected": true} -->
