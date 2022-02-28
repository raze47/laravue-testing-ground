<template>
    <v-app>

        <editPost v-if="editPost" :data="post_data" />


        <div class="row">
            <div class="col-lg-10 mx-auto my-8">
                <v-form ref="createForm" v-model="form.valid" @submit.prevent="createPost" lazy-validation>
                    <v-textarea v-model="form.data.text" outlined name="input-7-4" label="Post anything!" :rules="form.rules.text"></v-textarea>

                    <div class="text-center">
                        <v-btn type="submit" color="secondary" class="ma-2" :disabled="form.loading || !form.valid">
                            {{ form.loading ? 'Posting...' : 'Post' }}
                            <v-icon right>
                                mdi-post
                            </v-icon>
                        </v-btn>
                    </div>
                </v-form>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-10 mx-auto my-8">
                <v-card v-for="post in list" :key="post.id" elevation="4">
                    <v-row>
                        <v-col cols="12">
                            <v-card-subtitle><a href="#" target="_blank">{{ userName }} | {{ post.created_at }}</a></v-card-subtitle>
                            <v-card-text>{{ post.text }}</v-card-text>

                            <v-card-actions>
                                <hr />
                                <div class="button-group">
                                    <v-btn @click="editDialog(post)" color="info" class="ma-1">
                                        Edit
                                        <v-icon right>
                                            mdi-comment-edit
                                        </v-icon>
                                    </v-btn>
                                    <v-btn @click="deletePost(post)" color="error" class="ma-1">
                                        Delete
                                        <v-icon right>
                                            mdi-delete
                                        </v-icon>
                                    </v-btn>
                                </div>
                            </v-card-actions>
                        </v-col>

                        <v-col cols="13"><v-spacer /></v-col>
                    </v-row>

                    <v-divider :inset="true" :key="post.id"> </v-divider>
                </v-card>

                <div class="text-center pt-2">
                    <v-pagination v-model="page" :length="pageCount" :total-visible="itemsPerPage" @input="onPageChange"></v-pagination>
                </div>
            </div>
        </div>
    </v-app>
</template>

<script>
    import axios from "axios";
    import editPost from "./modals/editPost.vue"

    export default {
        middleware: "auth",
        data() {
            return {
                loader: null,
                loading: false,
                loading2: false,
                loading3: false,
                loading4: false,
                loading5: false,
                refresh: false,
                
                editPost: false,
                post_data: [],
                panel: [],
                page: 1,
                pageCount: 0,
                itemsPerPage: 1,
                userName: null,
                list: [],
                form: {
                    valid: true,
                    loading: false,
                    rules: {
                        ref: [(v) => !!v || "Post Content is a required field"],
                    },
                    data: {
                        text: null,
                    },
                },
            };
        },

        watch: {
            loader() {
                const l = this.loader;
                this[l] = !this[l];

                setTimeout(() => (this[l] = false), 3000);

                this.loader = null;
            },
        },

        components: {
            editPost,
        },

        created() {
            let i = 0;
            for (let post in this.posts) {
                this.panel[i] = i;
                i++;
            }
            this.init();
        },
        watch: {
            loader() {
                const l = this.loader;
                this[l] = !this[l];

                setTimeout(() => (this[l] = false), 3000);

                this.loader = null;
            },
        },
        methods: {


            async triggerDialog(v){
                if(v == 'editPost'){
                    this.editPost = !this.editPost
                }
            },


            async editDialog(item){
                console.log(item)
                this.post_data = item
                this.editPost = !this.editPost
            },
   


            async createPost() {
                if (this.$refs.createForm.validate()) {
                    this.form.loading = true;
                    await axios
                        .post("/api/user_post_comment/post/create", this.form.data)
                        .then((res) => {
                            console.log("Success");
                            this.$refs.createForm.reset();
                            this.init();
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                    //end loading
                    this.form.loading = false;
                }
            },

            async onPageChange() {
                this.init();
            },

            displayPost(post) {
                console.log("Display post");
                console.log(post);
            },
            newPost() {
                this.refresh = true;
            },

            async init() {
                await axios
                    .post("/api/user_post_comment/post/list?page=" + this.page)
                    .then((res) => {
                        console.log(res.data);
                        var x = res.data;
                        this.list = x.data.data;
                        this.itemsPerPage = x.data.per_page;
                        this.page = x.data.current_page;
                        this.pageCount = x.data.last_page;

                        this.userName = this.list[0].users.name;
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },

            async deletePost(post, id) {
                console.log("Delete post");

                await axios
                    .post("/api/user_post_comment/post/delete", { id: post.post_id })
                    .then((res) => {
                        console.log("..");

                        this.init();
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
        },
    };
</script>
<style>
    .button-group {
        margin-top: 2%;
    }

    .custom-loader {
        animation: loader 1s infinite;
        display: flex;
    }
    @-moz-keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }
    @-webkit-keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }
    @-o-keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }
    @keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }
</style>
