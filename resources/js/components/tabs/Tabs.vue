<template>
    <div>
        <div class="tabs is-centered">
            <ul>
            <li :class="{ 'is-active': tab.isActive }" v-for="tab in tabs" v-bind:key="tab.name">
            <a style="text-decoration: none;" :href="tab.href" @click="selectTab(tab)"> {{ tab.name }} </a>
            </li>
            </ul>
        </div>
        <div class="tabs-details">
            <slot> </slot>
        </div> 
    </div>
</template>

<script>
    export default {
        props: {
            name: { required: true }
        },
        data() {
           return { 
                tabs: [],
            };
        }, 
        
        mounted() {
            console.log(this.$children);
        },

        created() {
            this.tabs = this.$children;
        },

        methods: {
            selectTab(selectedTab) {
                this.tabs.forEach( tab => {
                    tab.isActive = (tab.name == selectedTab.name);
                });
            }
        },
    }

</script>
