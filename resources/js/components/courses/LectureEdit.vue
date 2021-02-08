<template>
    <!-- lecture-edit -->
    <div class="card text-white bg-primary clearfix" style="width: 25rem;" v-if="active">
        <div class="card-header col-md-12">
            <div class="col-md-10">
                Toque no texto para editar.<br>
                Toque fora ou tab para confirmar.
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-outline-light float-right"
                    @click="toggleActive">+</button>
                    
            </div>
        </div>

        <div class="card-body">

            <div class="lecture-edit">
                <!-- Lecture Name: Toggle edit -->
                <div class="col-md-12">
                    <h3 class="card-title text-white" v-if="!editLectureName"
                        @click="toggleEditName">{{name}}</h3>
                </div>

                <!-- Lecture Name: Edit -->
                <div class="row clearfix" v-if="editLectureName">
                    <div class="col-md-9">
                        <input  type="text" class="form-control" 
                                v-model="name"
                                v-html="name"
                                @blur="toggleEditName">
                    </div>
                    
                    <!-- Lecture Name: Disable edit -->
                    <div class="col-md-3">
                        <button type="button" class="btn btn-outline-light float-left"
                            @click="toggleEditName">Ok</button>
                    </div>
                </div>

                <!-- Adjust paragraph -->
                <p v-if="editLectureName || editLectureDescription"></p>

                <!-- Lecture Description: Toggle edit -->
                <div class="col-md-12">
                    <p class="card-text lead" v-if="!editLectureDescription"
                        @click="toggleEditDescription">{{description}}</p>
                </div>

                <!-- Lecture Name: Edit  -->
                <div class="row clearfix" v-if="editLectureDescription">
                    <div class="col-md-9">
                        <input  type="text" class="form-control"
                                v-model="description" 
                                v-html="description"
                                @blur="toggleEditDescription">
                    </div>
                    <!-- Lecture Name: Disable edit -->
                    <div class="col-md-3">
                        <button type="button" class="btn btn-outline-light float-left"
                            @click="toggleEditDescription">Ok</button>
                    </div>
                </div>

                <!-- Adjust paragraph -->
                <p v-if="editLectureDescription || editLectureLink"></p>

                <!-- Lecture Link: Toggle edit -->
                <div class="col-md-12">
                    <p class="card-text lead" v-if="!editLectureLink"
                        @click="toggleEditLink">
                        <span class="border-bottom border-light">
                            youtube.com/{{link}}
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
                                v-model="link"
                                @blur="toggleEditLink"
                                placeholder="v1de01D">
                    </div>

                    <!-- Lecture Link: Disable edit -->
                    <div class="col-md-3">
                        <button type="button" class="btn btn-outline-light float-left"
                            v-if="editLectureLink"
                            @click="toggleEditLink">Ok</button>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <!-- lecture-edit -->
</template>

<script>


    export default {

        props: {
            id: String,
            name: String,
            description: String,
            link: String
        },

        data() {
            return {

                active: true,
                edit: [],

                // Flags to enable editing a lecture
                editLectureName: false,
                editLectureDescription: false,
                editLectureLink: false,
            }
        },

        methods: {

            toggleActive() {
                this.active = !this.active;
            },

            toggleEditName() {
                this.editLectureName = !this.editLectureName;
            },
            toggleEditDescription() {
                this.editLectureDescription = !this.editLectureDescription;
            },
            toggleEditLink() {
                this.editLectureLink = !this.editLectureLink;
                this.selectLecture(this.selectedLecture);
            },

        }
    }

</script>
