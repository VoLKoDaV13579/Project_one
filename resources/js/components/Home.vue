<template>
    <div class="container">
        <navigation @updateComponent="updateComponent" :key="componentKey"></navigation>
        <br>
        <router-view @updateComponent="updateComponent"></router-view>
    </div>
</template>

<script>
import axios from 'axios';
    export default 
    {
        data(){
            return {
                componentKey:0
            }

        },
        mounted() {
        },
        methods:{
            updateComponent: function(){
                this.componentKey
            }

        }
    }

</script>
