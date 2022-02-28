<template>  

    <v-app>
    <createThread v-if="createThread" />

    <div align="center"
    justify="space-around">
        <v-btn

        color="primary"
        dark
        @click="createThreadTrigger()"

        max-width="200"
        >
        Create Thread
        </v-btn>
    </div>
    </v-app>
</template>
<script>
import createThread from './createThread.vue'

    export default {
        components:{
            createThread
        },

        data: () => ({
            show: false,
            createThread: false,
        }),

        methods: {
            createThreadTrigger(){
                
                this.createThread = !this.createThread
                console.log("createThreadTrigger")
                console.log(this.createThread)
            }
        }
        
    };
</script>
