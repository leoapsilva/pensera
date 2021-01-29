<template>
    <div class="container">
        <div class="course">
            <div class="row">
                <div class="col-8 ">
                    <div class="tab-content" id="nav-tabContent">

                        <div v-for="lecture in lectures" class="tab-pane fade show"
                            :class="{ 'active': lecture.active }" :id="lecture.active" role="tabpanel"
                            aria-labelledby="list-home-list">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" :src="lecture.src" allowfullscreen> </iframe>
                            </div>

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

                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card bg-white" style="width: 25rem;">
                        <div class="card-header"><h5>{{courseTitle}}</h5></div>
                        <div class="card-body">

                            <!-- <h5 class="card-title"><strong>{{courseTitle}}</strong></h5> -->
                            <!-- <p class="card-text lead">{{courseDescription}}</p> -->
                
                            <div class="card text-white bg-primary" style="width: 25rem;">
                                <div class="card-body">
                                    <h3 class="card-title text-white">{{lectureTitle}}</h3>
                                    <p class="card-text lead">{{lectureDescription}}</p>
                                </div>

                            </div>
                        </div>
                        <div class="list-group" id="list-tab" role="tablist"
                            style="overflow:scroll;max-height: 250px;-webkit-overflow-scrolling: touch;">

                            <a v-for="lecture in lectures" role="tab" class="list-group-item list-group-item-action"
                                :class="{ 'active': lecture.active }" id="list-aula-1-list" :href="lecture.href"
                                :aria-controls="lecture.ariaControls"
                                @click="selectLecture(lecture)">{{ lecture.title}}</a>

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
            title: {
                string: ''
            },
            description: {
                string: ''
            }
        },
        data() {
            return {
                lectures: [],
                courseTitle: this.title,
                courseDescription: this.description,
                lectureTitle: '',
                lectureDescription: '',
            }
        },
        created() {
            this.lectures = this.$children;
        },

        mounted() {
            this.lectures.forEach(lecture => {
                if (lecture.active) {
                    this.lectureTitle = lecture.title;
                    this.lectureDescription = lecture.description;
                }
            });
            console.log(this.$children);
        },

        methods: {
            selectLecture(selectedLecture) {
                this.lectureTitle = selectedLecture.title;
                this.lectureDescription = selectedLecture.description;
                this.lectures.forEach(lecture => {
                    lecture.active = (lecture.title == selectedLecture.title);
                });
            }
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
