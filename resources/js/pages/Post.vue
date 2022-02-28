<template>
    <div class="row">
        <div class="col-lg-10 mx-auto my-8">
            <v-form ref="createForm" v-model="form.valid" @submit.prevent="createPost" lazy-validation>
                <v-textarea v-model="form.data.text" outlined filled name="input-7-4" label="Post anything!" :rules="form.rules.text"></v-textarea>
                
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
</template>

<script>
import axios from 'axios';
    export default {
        middleware: "auth",
        data() {
            return {
                form: {
                    valid: true,
                    loading: false,
                    rules: {
                        ref: [(v) => !!v || "Post Content is a required field"],
                    },
                    data: {
                        text: null,

                    },
                }
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
        created(){
        },

        methods:{
            async createPost(){

                if(this.$refs.createForm.validate()){
                    this.form.loading = true
                    await axios.post('/api/user_post_comment/post/create', this.form.data)
                        .then(res => {
                            console.log("Success")
                            this.$emit('new-post')
                        })
                        .catch(err => {
                            console.log(err)
                        })
                //end loading
                this.form.loading = false
                }
                
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
