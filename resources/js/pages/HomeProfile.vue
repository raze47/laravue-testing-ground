<template>
    <v-app>
        
            <Post @display-post="displayPost" @new-post="newPost"/>
            <hr>
            <PostsHomeProfile :refresh="refresh" />
            
    </v-app>
</template>

<script>
    import Post from "./Post";
    import PostsHomeProfile from "./PostsHomeProfile";

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
            };
        },
        components: {
            Post,
            PostsHomeProfile,
        },
        data(){
            return{

            }
        },
        created(){

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
            displayPost(post){
                console.log("Display post")
                console.log(post)

            },
            newPost(){
                this.refresh = true
            }
        }
    };
</script>
<style>
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
