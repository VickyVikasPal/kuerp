<template>
    <div class="select-time d-flex">
        <select class="form-select" :id="datetime+'_hh'" :name="datetime+'_hh'" v-model="defaultHR">
            <option :value="defaultHR">{{defaultHR}}</option>
            <option v-for="(hrs, index) in hours" :value="hrs">{{hrs}}</option>
        </select>
        <select class="form-select" :id="datetime+'_mm'" :name="datetime+'_mm'"  v-model="defaultMI">
            <option :value="defaultMI">{{defaultMI}}</option>
            <option v-for="(mint, index) in minutes" :value="mint">{{mint}}</option>
        </select>
        <select class="form-select" :id="datetime+'_mt'" :name="datetime+'_mt'"  v-model="defaultMT">
            <option :value="defaultMT">{{defaultMT}}</option>
            <option>AM</option>
            <option>PM</option>
        </select>
    </div>
</template>
<script>
    export default {
        name: "timepicker",
        props: {
            datetime:{
                type: String,
                default:''
            },
            timeFormat:{
                type:Number,
                default:12
            }
        },
        data() {
            return {
                hours:[],
                minutes:[],
                defaultMT:'AM',
                defaultHR:'00',
                defaultMI:'00',
            }
        },
        mounted() {
            this.setHour();
            this.setMinute();
            this.setMaredian();
        },
        methods: {
            setHour(){
                const self = this;
                for(let i = 0; i < self.timeFormat; i++)
                {
                    if(i < 10)
                    {
                        self.hours.push('0'+i);
                    }else{
                        self.hours.push(''+i);
                    }
                }
            },
            setMinute(){
                const self = this;
                for(let i = 0; i < 60; i++)
                {
                    if(i < 10)
                    {
                        self.minutes.push('0'+i);
                    }else{
                        self.minutes.push(''+i);
                    }
                }
            },
            setMaredian(){
                const self = this;
                let time = new Date();
                let hh = time.getHours();
                let mm = time.getMinutes();
                let mt = time.toLocaleString('en-US', { hour: 'numeric', hour12: true }).split(" ");
                if(mt[0] < 10)
                {
                    hh = '0'+mt[0];
                }else{
                    hh = ''+mt[0];
                }

                if(mm < 10)
                {
                    mm = '0'+mm;
                }else{
                    mm = ''+mm;
                }
                self.defaultMT = mt[1];
                self.defaultHR = hh;
                self.defaultMI = mm;
                //console.log(mt[0]);
            }
        },

    }
</script>