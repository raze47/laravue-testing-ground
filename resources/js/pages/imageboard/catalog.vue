<template>
    <v-app>
        <createThread v-if="createThread" v-on:toggleThreadDialog="toggleThreadDialog" />

        <v-row class="h-5" no-gutters>
            <v-col lg="4" class="d-flex justify-center pt-12"></v-col>
            <v-col lg="4" class="d-flex justify-center pt-12">
                <v-btn color="primary" dark @click="createThreadDialog()" max-width="200">
                    Create Thread
                </v-btn>
            </v-col>
            <v-col lg="4" class="d-flex justify-center pt-12"></v-col>
        </v-row>
        <v-row class="h-5" no-gutters>
            <v-col lg="2" v-for="item in list" :key="item.id" class="p-5 m-5">
                <v-card class="mx-auto py-auto" max-width="150" max-height="150">
                <v-img width="150" height="150" :src="'../storage/images/'+item.thread_file"></v-img>

                <v-divider class="mx-4"></v-divider>
                <v-card-title>{{item.title}}</v-card-title>
                <v-divider class="mx-2"></v-divider>
                <v-card-text>
                    <p><b>By Test</b></p>
                </v-card-text>

                <v-card-actions>
                    <v-btn color="deep-purple lighten-2" text>
                        visit
                    </v-btn>
                </v-card-actions>
             </v-card>    
                
            </v-col>
            
        </v-row>

    </v-app>
</template>
<script>
    import createThread from "./createThread.vue";
    import axios from "axios";
    export default {
        middleware: "auth",

        created() {
            this.init();
        },

        components: {
            createThread,
        },

        data: () => ({
            show: false,
            createThread: false,
            selection: 1,
            list: [],
        }),

        methods: {

            createThreadDialog() {
                this.createThread = !this.createThread;

            },
            toggleThreadDialog(){
                this.init();
                console.log("Toggled");
                
            },

            async init() {
                await axios
                    .get("https://laravue-imageboard.test/api/imageboard/list")
                    .then((res) => {
                        console.log(res.data.data);
                        this.list = res.data.data;
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
        },
    };
</script>
<style scoped></style>
