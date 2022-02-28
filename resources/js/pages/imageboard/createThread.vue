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
                                    <v-file-input
                                        accept="image/*"
                                        label="Upload Image/Video"
                                        v-model="form.data.threadFile"
                                    ></v-file-input>
                                </v-col>
                                
                            </v-row>
                        </v-container>
                    </v-card-text>
                
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="createThread= false">
                        Close
                    </v-btn>
                    <v-btn color="blue darken-1" text type="submit" @click="createThread = false">
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
    data: () => ({
      dialog: false,
      createThread: true,
      form: {
          data: {
              post: null,
              threadFile: null,
          },
          valid: {}
      }
    }),
    methods: {
        async createThreadPost(){
            console.log(this.form.data)
            console.log(this.form.data.threadFile)
            let formData = new FormData(this.form.data)
            formData.append("image", this.form.data.threadFile)
            console.log(formData)

            await axios.post('/api/imageboard/create', this.form.data)
            .then((res) => {
                console.log(res)
            })
            .catch((err) => {
                console.log(err)
            })
            
        }
    }
  }
</script>
