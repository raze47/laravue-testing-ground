<template>
    
        <v-dialog v-model="editModal" transition="dialog-bottom-transition" max-width="800" scrollable>
            <v-card>
            <template>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <v-textarea v-model="form.data.text"></v-textarea>

                    <v-btn :disabled="!valid" color="success" class="mr-4">
                        Update
                    </v-btn>

                    <v-btn color="error" class="mr-4">
                        Close
                    </v-btn>

                    
                </v-form>
            </template>
            </v-card>
        </v-dialog>
    
</template>
<script>
    export default {
        props: ["data"],

        data() {
            return {
                valid: true,
                editModal: true,
                loading: false,
                selection: 1,
                form: {
                    data: {},
                },
            };
        },

        created() {
            console.log("Editpost created()");
            this.form.data = Object.assign({}, this.data);
            console.log(this.form.data);
        },
        methods: {
            reserve() {
                this.loading = true;

                setTimeout(() => (this.loading = false), 2000);
            },
        },
    };
</script>
