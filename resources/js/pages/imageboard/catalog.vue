<template>
    <v-app>
        <createThread v-if="createThread" v-on:createThreadDialog="createThreadDialog" />

        <v-row class="h-5" no-gutters>
            <v-col lg="4" class="d-flex justify-center pt-12"></v-col>
            <v-col lg="4" class="d-flex justify-center pt-12" >
                <v-btn color="primary" dark @click="createThreadDialog()" max-width="200">
                    Create Thread
                </v-btn>
            </v-col>
            <v-col lg="4" class="d-flex justify-center pt-12"></v-col>
        </v-row>
        <v-row class="h-5" no-gutters>
            
             <v-card class="mx-auto py-auto" max-width="250" max-height="250">
            <v-img height="250" src="https://cdn.vuetifyjs.com/images/cards/cooking.png"></v-img>

            <v-divider class="mx-4"></v-divider>

            <v-card-text>
                <p>Sample post</p>
            </v-card-text>

            <v-card-actions>
                <v-btn color="deep-purple lighten-2" text>
                    visit
                </v-btn>

            </v-card-actions>
        </v-card>
        </v-row>
       
    </v-app>
</template>
<script>
    import createThread from "./createThread.vue";
    import axios from "axios";
    export default {
        middleware: "auth",


        created(){
            this.init();
        },

        components: {
            createThread,
        },

        data: () => ({
            show: false,
            createThread: false,
            selection: 1,
        }),

        methods: {
            createThreadDialog() {
                this.createThread = !this.createThread;
            },

            async init(){
                await axios.get("https://laravue-imageboard.test/api/imageboard/list")
                .then((res) => {
                    console.log(res.data.data);
                })
                .catch((err) => {
                    console.log(err);
                })
            }

        },
    };
</script>
<style scoped>


</style>