<template>
    <div class="col-lg-12">
        <div v-for="event in events">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-md-offset-4">
                    <img :src="event.path" class="event-photo">
                </div>
            </div>
            <div class="row">
               <h3> {{ event.title }} </h3>
            </div>
            <div class="row">
                {{ event.start_at.substr(0, event.start_at.indexOf(' ')) }} - {{ event.end_at.substr(0, event.end_at.indexOf(' ')) }}
            </div>
            <div class="row">
                {{ event.start_time }} - {{ event.end_time }}
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-md-offset-4">
                    {{  event.description }}
                </div>
            </div>
            <hr/>
        </div>
    </div>
</template>
<style>

</style>
<script>
    export default{
        props: {
            events: {
                type: Array,
                required: true
            }
        },
        data(){
            return{
                msg:'hello vue'
            }
        },
        components:{

        }
    }
</script>
