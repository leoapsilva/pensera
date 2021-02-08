<template>
    <div class="col-8 ">
        <h1> {{courseName}} </h1>
        <h3> {{courseDescription}} </h3>
        <div class="tab-content" id="nav-tabContent">

            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" :src="srcLink" allowfullscreen>
                </iframe>
            </div>

        </div>
    </div>
</template>

<script>
    export default {

        props: {
            courseName: String,
            courseDescription: String,
            videoLink: String,
        },

        data() {
            return {}
        },

        computed: {
            srcLink() {
                return 'https://www.youtube.com/embed/' + this.videoLink + '?rel=0';
            },
        },
    }

</script>
