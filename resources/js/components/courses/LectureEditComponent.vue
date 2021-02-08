<template>
    <div>
        <div class="lecture-edit">
            <!-- Lecture Name: Toggle edit -->
            <div class="col-md-12">
                <h3 class="card-title text-white" v-if="!editLectureName" @click="toggleEditLectureName()">
                    {{selectedLecture.name}}</h3>
            </div>

            <!-- Lecture Name: Edit -->
            <div class="row clearfix" v-if="editLectureName">
                <div class="col-md-9">
                    <input type="text" class="form-control" v-model="selectedLecture.name"
                        v-html="selectedLecture.name">
                </div>

                <!-- Lecture Name: Disable edit -->
                <div class="col-md-3">
                    <button type="button" class="btn btn-outline-light float-left"
                        @click="toggleEditLectureName()">Ok</button>
                </div>
            </div>

            <!-- Adjust paragraph -->
            <p v-if="editLectureName || editLectureDescription"></p>

            <!-- Lecture Description: Toggle edit -->
            <div class="col-md-12">
                <p class="card-text lead" v-if="!editLectureDescription" @click="toggleEditLectureDescription()">
                    {{selectedLecture.description}}</p>
            </div>

            <!-- Lecture Name: Edit  -->
            <div class="row clearfix" v-if="editLectureDescription">
                <div class="col-md-9">
                    <input type="text" class="form-control" v-model="selectedLecture.description"
                        v-html="selectedLecture.description">
                </div>
                <!-- Lecture Name: Disable edit -->
                <div class="col-md-3">
                    <button type="button" class="btn btn-outline-light float-left"
                        @click="toggleEditLectureDescription()">Ok</button>
                </div>
            </div>

            <!-- Adjust paragraph -->
            <p v-if="editLectureDescription || editLectureLink"></p>

            <!-- Lecture Link: Toggle edit -->
            <div class="col-md-12">
                <p class="card-text lead" v-if="!editLectureLink" @click="toggleEditLectureLink()">
                    <span class="border-bottom border-light">
                        youtube.com/{{selectedLecture.link}}
                    </span></p>
            </div>

            <!-- Lecture Link: Toggle edit -->
            <div class="row cleafix" v-if="editLectureLink">
                <div class="input-group col-md-9">
                    <div class="input-group-prepend">
                        <div class="input-group-text">youtube.com/</div>
                    </div>
                    <input type="text" class="form-control" v-model="selectedLecture.link" placeholder="v1de01D">
                </div>

                <!-- Lecture Link: Disable edit -->
                <div class="col-md-3">
                    <button type="button" class="btn btn-outline-light float-left" v-if="editLectureLink"
                        @click="toggleEditLectureLink()">Ok</button>
                </div>
            </div>
        </div>
        <!-- END lecture-edit -->

        <div class="lecture-edit-component-detail">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {

    }

</script>
