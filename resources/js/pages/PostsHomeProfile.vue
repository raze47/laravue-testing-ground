<template>
    <v-app>
        <div class="row">
            <div class="col-lg-10 mx-auto my-8">
                <template>
                    <v-app>
                        <div>
                            <v-expansion-panels v-model="panel" multiple>
                                <v-expansion-panel v-for="post in list" :key="post.id">
                                    <v-expansion-panel-header><a href="#" target="_blank">{{ userName }} | {{ post.created_at }}</a></v-expansion-panel-header>
                                    <v-expansion-panel-content>
                                        {{ post.text }}
                                        <hr>
                                        <div class="button-group">
                                            <v-btn v-model="editLoading" @click="editPost(post)" color="info" class="ma-1">
                                            Edit
                                                <v-icon right>
                                                    mdi-comment-edit
                                                </v-icon>
                                            </v-btn>
                                            <v-btn v-model="deleteLoading" @click="deletePost(post)" color="error" class="ma-1">
                                            Delete
                                                <v-icon right>
                                                    mdi-delete
                                                </v-icon>
                                            </v-btn>
                                        </div>
                                        
                                    </v-expansion-panel-content>
                                </v-expansion-panel>
                            </v-expansion-panels>
                        </div>
                    </v-app>
                </template>

                <div class="text-center pt-2">
                    <v-pagination v-model="page" :length="pageCount" :total-visible="itemsPerPage" @input="onPageChange"></v-pagination>
                </div>
            </div>
        </div>
    </v-app>
</template>

<script>
    import axios from "axios";

    export default {
        middleware: "auth",

        data() {
            return {
                panel: [],
                posts: [
                    { id: 1, post: "Post 1", user: "User 1" },
                    { id: 2, post: "Post 2", user: "User 2" },
                    { id: 3, post: "Post 3", user: "User 3" },
                    { id: 4, post: "Post 4", user: "User 4" },
                    { id: 5, post: "Post 5", user: "User 5" },
                ],
                editLoading: false,
                deleteLoading: false,
                page: 1,
                pageCount: 0,
                itemsPerPage: 1,
                userName: null,
                list: [],
            };
        },

        props: {
            refresh: {
                default: false,
                type: Boolean,
            }
            
        },

        watch: {
            refresh: function(){
                if(refresh){
                    this.init()
                }
                
            },

            loader() {
                const l = this.loader;
                this[l] = !this[l];

                setTimeout(() => (this[l] = false), 3000);

                this.loader = null;
            },
        },

        async created() {
            let i = 0;
            for (let post in this.posts) {
                this.panel[i] = i;
                i++;
            }
            this.init();
        },
        methods: {
            async onPageChange() {
                this.init();
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

            async deletePost(post){
                this.deleteLoading = true
                console.log("Delete post")
                console.log(post)

                await axios
                    .post("/api/user_post_comment/post/delete", {id: post.post_id})
                    .then((res) => {
                        console.log("..")
                        this.init()
                        
                    })
                    .catch((err) => {
                        console.log(err);
                    });

            },

            editPost(post){
                this.editLoading = true
                console.log("Edit post")
                console.log(post)


            },

            
        },
    };
</script>
<style>
.button-group{
    margin-top: 2%;
}

</style>
