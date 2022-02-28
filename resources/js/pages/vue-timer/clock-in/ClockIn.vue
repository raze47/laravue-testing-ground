<template>
    <v-app>
        <div class="row">
            <div class="col-lg-10 mx-auto my-8">
                <h1>Change me pls</h1>
                <v-card :loading="loading" class="mx-auto my-12" max-width="374">
                    <template slot="progress">
                        <v-progress-linear color="deep-purple" height="10" indeterminate></v-progress-linear>
                    </template>

                    <v-img height="250" src="https://media.istockphoto.com/photos/hand-point-on-data-report-show-on-screen-picture-id635969404?b=1&k=20&m=635969404&s=170667a&w=0&h=LdwjNzPt2M_dHJgH4MVQWwLoj7PtY3Qz0swZlG2fhnw="></v-img>


                

                    <v-card-title class="justify-center">Attendance Sheet</v-card-title>
            
                    <v-divider class="mx-4"></v-divider>
                    
                    <v-card-actions>
                        <div class="text-center">
                            <v-btn rounded @click="startTimer" color="primary" dark class="div-buttons">
                                Clock In
                            </v-btn>
                            <v-btn rounded @click="stopTimer" color="error" dark class="div-buttons">
                                Clock Out
                            </v-btn>
                            <v-btn rounded @click="employeeProfile" color="success" dark class="div-buttons">
                                Employee Profile
                            </v-btn>
                        </div>
                    </v-card-actions>
                </v-card>
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
                loading: false,
                selection: 1,
                hr: 0,
                min: 0,
                sec: 0,
                stoptime: true,
                curr_time: null,
                start_time_now: null,
                stop_time_now: null
            };
        },
        
        watch: {

        },
        methods: {
            clockIn() {
                console.log("Clock in");
            },
            clockOut() {
                console.log("Clock out");
            },
            employeeProfile() {
                console.log("Employee profile");
            },
            startTimer() {
                if (this.stoptime == true) {
                    console.log("Clock in");
                    const moment = require('moment')            
                    this.start_time_now = moment().format("HH:mm")
                    document.cookie = this.start_time_now
                    this.stoptime = false;
                    this.timerCycle();

                }

            },
            stopTimer() {

                if (this.stoptime == false) {
                    console.log("Clock out");
                    this.stoptime = true;
                }
            

                // this.sec = 0
                // this.min = 0
                // this.hr = 0
                const moment = require('moment')       
                var start_time_now = document.cookie      
                this.stop_time_now = moment().format("HH:mm")
                console.log("Started at: "+start_time_now.substring(0, 6))
                console.log("Stopped at: "+this.stop_time_now)

                
                var now_1 = parseInt(start_time_now.substring(0, 2))
                var now_2 = parseInt(start_time_now.substring(3, 6))
                var end_1 = parseInt(this.stop_time_now.substring(0, 2))
                var end_2 = parseInt(this.stop_time_now.substring(3, 6))
                var res_1 = end_1 - now_1
                var res_2 = end_2 - now_2

                console.log("From now= "+res_1+":"+res_2)

            },

            timerCycle() {
                if (this.stoptime == false) {
                    // this.sec = parseInt(this.sec);
                    // this.min = parseInt(this.min);
                    // this.hr = parseInt(this.hr);

                    // this.sec = this.sec + 1;

                    // if (this.sec == 60) {
                    //     this.min = this.min + 1;
                    //     this.sec = 0;
                    // }
                    // if (this.min == 60) {
                    //     this.hr = this.hr + 1;
                    //     this.min = 0;
                    //     this.sec = 0;
                    // }

                    // if (this.sec < 10 || this.sec == 0) {
                    //     this.sec = "0" + this.sec;
                    // }
                    // if (this.min < 10 || this.min == 0) {
                    //     this.min = "0" + this.min;
                    // }
                    // if (this.hr < 10 || this.hr == 0) {
                    //     this.hr = "0" + this.hr;
                    // }

                    // this.curr_time  = this.hr + ":" + this.min + ":" + this.sec;

                    setTimeout(this.timerCycle, 1000);
                }
            },
        },
    };
</script>

<style>
    .div-buttons {
        margin: 3%;
    }
</style>
