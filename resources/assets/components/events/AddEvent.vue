<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-body">
                <form enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="title" class="col-sm-3 form-control-label">Name</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="title" v-model="title" placeholder="Name of the event">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="location" class="col-sm-3 form-control-label">Location</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="location" v-model="location" placeholder="Location of event">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 form-control-label">Description</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" rows="5" id="description" v-model="description" placeholder=""></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                            <label for="startDate" class="col-sm-3 form-control-label">Start Date</label>
                            <div class="col-sm-7">
                            <datepicker
                                v-model="startDate"
                                :format="format"
                                name="startDate"
                                input-class="form-control"
                                ></datepicker>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="endDate" class="col-sm-3 form-control-label">End Date</label>
                        <div class="col-sm-7">
                            <datepicker
                                    v-model="endDate"
                                    :format="format"
                                    name="endDate"
                                    input-class="form-control"
                                    ></datepicker>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="startTime" class="col-sm-3 form-control-label">Start Time</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="startTime" v-model="startTime" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="endTime" class="col-sm-3 form-control-label">End Time</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="endTime" v-model="endTime" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Image</label>
                        <div class="col-sm-7">
                            <dropzone id="myVueDropzone" :url="saveImageEndpoint" v-on:vdropzone-success="showSuccess" :maxNumberOfFiles="maxNumberOfFiles">
                                <!-- Optional parameters if any! -->
                                <input type="hidden" name="token" value="xxx">
                            </dropzone>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3 col-sm-offset-5">
                            <div class="clearfix">
                                <span><button type="button" class="btn btn-primary" @click="save">Save</button></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<style>
input[readonly].form-control { background-color: #fff; }
textarea { resize:vertical; }
</style>
<script>
    import Datepicker from 'vuejs-datepicker';
    import Dropzone from 'vue2-dropzone';

    export default{
        props: {
            saveEndpoint: {
                type: String,
                required: true
            },
            saveImageEndpoint: {
                type: String,
                required: true
            },
        },
        data(){
            return{
                title: '',
                description: '',
                location: '',
                image: {},
                startDate: new Date(),
                endDate: new Date(),
                format: 'd MMMM yyyy',
                startTime: '',
                endTime: '',
                maxNumberOfFiles: 1
            }
        },
        computed: {
            eventData: function() {
                return {
                    'title': this.title,
                    'description': this.description,
                    'location': this.location,
                    'startDate': this.startDate,
                    'endDate': this.endDate,
                    'startTime': this.startTime,
                    'endTime': this.endTime,
                    'image': this.image
                }
            }
        },
        methods: {
            startDate: function(val) {
                console.log(val);
                this.startDate = val;
            },
            endDate: function(val) {
                this.endDate = val;
            },
            save: function() {
                 this.$http.post(this.saveEndpoint, this.eventData).then(function(response){
                    this.$bus.$emit('saved');
                 }, response =>{

                 });
            },
            showSuccess: function(file, response) {
                this.image = response;
            }
        },
        components:{
            'datepicker': Datepicker,
            'dropzone': Dropzone
        }
    }
</script>
