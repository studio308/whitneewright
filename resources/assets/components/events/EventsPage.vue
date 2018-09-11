<template>
    <div class="col-lg-12">
        <div v-for="(event, index) in events">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-md-offset-4">
                    <img :src="event.path" class="event-photo">
                </div>
                <div v-if="user" class="col-lg-2">
                    <a href="#" @click="editModal(index)">edit</a>
                    <div class="row">
                        <a href="#" @click="deleteModal(index)">delete</a>
                    </div>
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

        <modal modal_id="edit" modal_class="edit" :display_header="false" :display_footer="false">
            <div slot="modal_body">
                <div class="m-a-2 p-a-2 center text-center block-center center-block">
                    <div class="form-group row">
                        <label for="title" class="col-sm-3 form-control-label">Title</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="title" v-model="title">
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
                        <label for="startDate" class="col-sm-3 form-control-label">End Date</label>
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
                        <div class="col-sm-3 col-sm-offset-5">
                            <div class="clearfix">
                                <span><button type="button" class="btn btn-primary" @click="update">Save</button></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </modal>

        <modal modal_id="delete" modal_class="delete" :display_header="false" :display_footer="false">
            <div slot="modal_body">
                <div class="m-a-2 p-a-2 center text-center block-center center-block">
                    <h4 id="modal-title">Are you sure you want to delete this event?</h4>
                    <span><button type="button" class="btn btn-primary" @click="deleteEvent">Delete</button></span>
                    <span><button type="button" class="btn btn-primary" @click="deleteEventCancel">Cancel</button></span>
                </div>
            </div>
        </modal>

    </div>
</template>
<style>
input[readonly].form-control { background-color: #fff; }
</style>
<script>
    import Modal from '../Modal.vue';
    import Datepicker from 'vuejs-datepicker';
    export default{
        props: {
            events: {
                type: Array,
                required: true
            },
            saveEndpoint: {
                type: String,
                default: null
            },
            deleteEndpoint: {
                type: String,
                default: null
            },
            user: {
                type: Object,
                default: null
            },
            apiToken: {
                type: String,
                required: true
            }
        },
        data(){
            return{
                id: '',
                title:'',
                startDate: new Date(),
                endDate: new Date(),
                description: '',
                location: '',
                startTime: '',
                endTime: ''
            }
        },
        computed: {
            updateEvent: function() {
                return {
                    'id': this.id,
                    'title': this.title,
                    'startDate': this.startDate,
                    'endDate': this.endDate,
                    'description': this.description,
                    'location': this.location,
                    'startTime': this.startTime,
                    'endTime': this.endTime
                }
            }
        },
        methods: {
            editModal: function(index) {
                var event = this.events[index];

                $('#edit').modal('show');
                this.id = event.id;
                this.title = event.title;
                this.startDate = event.start_at;
                this.endDate = event.end_at;
                this.description = event.description;
                this.location = event.location;
                this.startTime = event.start_time;
                this.endTime = event.end_time;

                //$('#edit #title').val(event.title);
            },
            update() {
                 this.$http.post(this.saveEndpoint, this.updateEvent, {headers: {
                         Authorization: 'Bearer ' + this.apiToken
                     }}).then(function(response){
                    this.$bus.$emit('saved');
                    location.reload();
                 }, response =>{

                 });
            },
            deleteEvent() {
                 this.$http.post(this.deleteEndpoint, { id: this.id }, {headers: {
                         Authorization: 'Bearer ' + this.apiToken
                     }}).then(function(response){
                    this.$bus.$emit('delete');
                    location.reload();
                 }, response =>{

                 });
            },
            deleteModal: function(index) {
                var event = this.events[index];
                this.id = event.id;
                $('#delete').modal('show');
                $('#delete #modal-title').text("Are you sure you want to delete " + event.title);
            },
            deleteEventCancel() {
                $('#delete').modal('hide');
            },
        },
        components:{
            'modal': Modal,
            'datepicker': Datepicker
        }
    }
</script>
