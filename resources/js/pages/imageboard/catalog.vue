<template>
    <v-app>
        <createThread v-if="createThread" v-on:createThreadDialog="createThreadDialog" />

        <v-row>
            <v-col lg="4"></v-col>
            <v-col lg="4" class="d-flex justify-center py-12">
                <v-btn color="primary" dark @click="createThreadDialog()" max-width="200">
                    Create Thread
                </v-btn>
            </v-col>
            <v-col lg="4"></v-col>
        </v-row>
    </v-app>
</template>
<script>
    import createThread from "./createThread.vue";

    export default {
        components: {
            createThread,
        },

        data: () => ({
            show: false,
            createThread: false,
        }),

        methods: {
            createThreadDialog() {
                this.createThread = !this.createThread;
            },
        },
    };
</script>
