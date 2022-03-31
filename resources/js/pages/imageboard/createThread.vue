<template>
    <v-dialog v-model="createThread" transition="dialog-bottom-transition" max-width="400" scrollable>
        <v-card>
            <v-card-title>
                <span class="text-h5">Create Thread</span>
            </v-card-title>
            <v-form ref="createThreadForm" v-model="form.data.valid" @submit.prevent="createThreadPost" lazy-validation>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12">
                                <v-textarea label="Post" required v-model="form.data.post"></v-textarea>
                            </v-col>
                            <v-col cols="12">
                                <v-file-input accept="image/*" label="Upload Image/Video" @change="uploadFile"></v-file-input>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="createThread = false">
                        Close
                    </v-btn>
                    <v-btn color="blue darken-1" text type="submit" >
                        Save
                    </v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<script>
    import axios from "axios";

    export default {
        data() {
            return{
                dialog: false,
                createThread: true,
                form: {
                    data: {
                        post: null,
                        thread_file: null,
                    },
                    valid: {},
                },
            }
        },
        watch: {
            createThread(v) {
                if (v == false) {
                    this.$refs.createThreadForm.reset();
                    this.createThread = false;
                    this.$emit("createThreadDialog");
                }
            },
        },

        methods: {

            async uploadFile(event){
                console.log(event)
                this.form.data.thread_file = event
            },

            async createThreadPost() {
                console.log(this.form.data.thread_file);


                const formData = new FormData();
                formData.append("thread_file", this.form.data.thread_file);
                formData.append("post", this.form.data.post);
                console.log(formData.get("thread_file"));
                // let formData = new FormData();
                //formData.append("Thread File", this.form.data.thread_file, this.form.data.thread_file.name);
                //console.log(formData);
                // formData.append("Post Text", this.form.data.post);
                await axios
                    .post("/api/imageboard/create", formData, {
                        headers:{
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then((res) => {
                        console.log(res);
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
        },
    };
</script>
