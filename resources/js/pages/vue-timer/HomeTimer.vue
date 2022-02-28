<template>
    <v-app>
        <div class="row">
            <div class="col-lg-10 mx-auto my-8">
                <div>
                    <h1>Plan your event:</h1>
                    <v-form @submit.prevent="clockInput">
                        <v-row justify="space-around" align="center">
                            <v-col style="width: 350px; flex: 0 1 auto;">
                                <h2>Start:</h2>
                                <v-time-picker v-model="start" :max="end"></v-time-picker>
                            </v-col>
                            <v-col style="width: 350px; flex: 0 1 auto;">
                                <h2>End:</h2>
                                <v-time-picker v-model="end" :min="start"></v-time-picker>
                            </v-col>

                            <v-btn color="primary" type="submit">Submit</v-btn>
                        </v-row>
                    </v-form>
                </div>
            </div>
        </div>
    </v-app>
</template>

<script>
    export default {
        data() {
            return {
                start: null,
                end: null,
            };
        },
        watch: {
           
        },
        methods: {
            clockInput(){
                alert("Input success")
                var start = this.start+":00"
                var end = this.end+":00"

                
                console.log(start)
                console.log(end)

                var moment = require('moment');
                var sec_start = moment.duration(start).asSeconds()
                var sec_end = moment.duration(end).asSeconds()
                var sec_diff = sec_end - sec_start

                if(sec_diff < 0){
                    alert("Invalid input")
                    return
                }
                sec_diff = sec_diff*1000
                console.log("time: "+sec_diff)
                setTimeout(this.setAlert, sec_diff)
            },

            setAlert(){
                alert("Finished")
            }
        
        }

    };
</script>
