<template>
    <div>
        <div class="col-md-10 float-left">
            <a role="tab" class="list-group-item list-group-item-action"
                :class="{ 'active':  (this.selected == this.id) }" :id="id" :href="href"
                :aria-controls="ariaControls" @click="selectLecture()">{{name}}</a>
        </div>
        <div class="col-md-2 float-right">
            <button type="button" class="btn btn-outline-primary bg-light "
                @click="deleteLecture(id)">-</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            name: {
                string: '',
                required: true
            },
            description: {
                string: '',
                required: true
            },
            selected: {
                default: 1
            },
            link: {
                string: '',
                required: true
            },
            id: {
                number: 1,
                required: true
            },
            
        },

        data() {
            return {
            };
        },

        mounted() {
            this.newName = this.name;
            this.newDescription = this.description;
            this.newLink = this.link;
        },

        methods:{
            selectLecture(){
                this.$emit('lecture-selected', {    "id": this.id, 
                                                    "name": this.name,
                                                    "description": this.description,
                                                    "link": this.link});
            },
        },

        computed: {
            //href="#list-home" 
            href() {
                return '#' + this.id;
                //return '#list-' + this.name.toLowerCase().replace(/ /g, '-');
            },
            //id="list-home-list"
            ariaControls() {
                return this.name.toLowerCase().replace(/ /g, '-');
            },
            //aria-labelledby="list-home-list"
            ariaLabelledby() {
                return 'list-' + this.name.toLowerCase().replace(/ /g, '-') + '-list';
            },
            //src="https://www.youtube.com/embed/HCfPhZQz2CE?rel=0"
            src() {
                return 'https://www.youtube.com/embed/' + this.link + '?rel=0';
            }
        }
    }

</script>
