<template>
    <v-app>
        <div class="row">
            <div class="col-lg-10 mx-auto my-8">
                <card :title="$t('home')">
                    {{ $t('you_are_logged_in') }}
                </card>
            </div>
        </div>
 
    </v-app>
</template>

<script>
    import Post from './Post'

    // import axios from 'axios'
    export default {
        middleware: "auth",

        // async asyncData () {
        //   const { data: projects } = await axios.get('/api/projects')

        //   return {
        //     projects
        //   }
        // },

        metaInfo() {
            return { title: this.$t("home") };
        },

        

        data: () => ({
        }),

        methods: {
            reserve() {
                this.loading = true;

                setTimeout(() => (this.loading = false), 2000);
            },
        },

        components: {
            Post,
        }
    };
</script>
<style>
.div-post{
    margin-top: 90%;
}

</style>
