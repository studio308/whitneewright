<template>
    <div>
        <select v-model="hour">
            <option v-for="hour in hours" v-bind:value="hour">
                {{ hour }}
            </option>
        </select>
        <select v-model="minute">
            <option v-for="minute in minutes" v-bind:value="minute">
                {{ minute }}
            </option>
        </select>
    </div>
</template>
<style>
    body{
        background-color:#ff0000;
    }
</style>
<script>

    export default{
        data(){
            return{
                hours: [
                1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12
                ],
                minutes: [],
                hour: 1,
                minute: 0
            }
        },
        created: function() {
            for(var i = 0; i < 60; i++) {
                this.minutes.push(i);
            }
        },
        components:{

        }
    }
</script>
