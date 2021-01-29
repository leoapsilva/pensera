<template>
    <div><slot></slot></div>
</template>
<script>
    export default {
        props: {
            title: { 
                    string: '',
                    required: true},
            description: { 
                    string: '',
                    required: true},
            selected: { 
                    default: false },
            link: { 
                    string: '',
                    required: true},
        },  

        data() {    
            return {
                active: false
            };
        },

        mounted() {
            this.active = this.selected;
        },

        computed: {
            //href="#list-home" 
            href() {
                return '#list-' + this.title.toLowerCase().replace(/ /g,'-');
            },
            //id="list-home-list"
            id() {
                return 'list-' + this.title.toLowerCase().replace(/ /g,'-') + '-list';
            },
            //aria-controls="home"
            ariaControls() {
                return this.title.toLowerCase().replace(/ /g,'-');
            },
            //aria-labelledby="list-home-list"
            ariaLabelledby() {
                return 'list-' + this.title.toLowerCase().replace(/ /g,'-') + '-list';
            },
            //src="https://www.youtube.com/embed/HCfPhZQz2CE?rel=0"
            src() {
                return 'https://www.youtube.com/embed/' + this.link + '?rel=0';
            }


        }
    }

</script>
