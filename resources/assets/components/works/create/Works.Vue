<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-body">
                <form enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="title" class="col-sm-3 form-control-label">Title</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="title" v-model="title" placeholder="Title of the art piece">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="categories" class="col-sm-3 form-control-label">Category</label>
                        <div class="col-sm-7">
                            <select name="categories" id="categories" class="form-control" v-model="selected">
                                <option v-for="category in categories" :value="category.id"> {{ category.alias }} </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-3 form-control-label">Price</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="price" v-model="price" placeholder="Price of the art piece">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dimensions" class="col-sm-3 form-control-label">Dimensions</label>
                        <div class="col-sm-7">
                            <input type="text" min="0" class="form-control" id="dimensions" v-model="dimensions" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 form-control-label">Description</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" rows="5" id="description" v-model="description" placeholder=""></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Images</label>
                        <div class="col-sm-7">
                            <dropzone id="myVueDropzone" :url="saveImageEndpoint" v-bind:dropzone-options="{headers: {
                                Authorization: 'Bearer ' + this.apiToken
                                }}" v-bind:use-custom-dropzone-options="true" v-on:vdropzone-success="showSuccess">
                                <!-- Optional parameters if any! -->
                                <input type="hidden" name="token" value="xxx">
                            </dropzone>
                        </div>
                    </div>
                    <div class="form-group row" v-if="showPrimary == true">
                        <label for="primary" class="col-sm-3 form-control-label">Primary Photo</label>
                        <div class="col-sm-7">
                            <select name="categories" id="primary" class="form-control" v-model="primaryPhoto">
                                <option v-for="image in images" :value="image.name"> {{ image.name }} </option>
                            </select>
                        </div>
                    </div>
                    <span><button type="button" class="btn btn-primary" @click="save">Save</button></span>
                </form>
             </div>
        </div>
    </div>
</template>
<style>
textarea { resize:vertical; }
.red {
    color:#ff0000;
}
</style>
<script>
    import { PulseLoader } from 'vue-spinner/dist/vue-spinner.min.js'
    import Dropzone from 'vue2-dropzone'
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
            deleteImageEndpoint: {
                type: String,
                required: true
            },
            categories: {
                type: Array,
                required: true
            },
            apiToken: {
                type: String,
                required: true
            }
        },
        data(){
            return{
                images: [],
                title: '',
                selected: '',
                primaryPhoto: '',
                price: 0,
                dimensions: '',
                description: '',
                showPrimary: false
            }
        },
        watch: {
            images: {
                handler: function(val) {
                    if(this.images.length >= 1) {
                        this.showPrimary = true
                    } else {
                        this.showPrimary = false;
                    }
                },
                deep: true
            },
        },
        created: function() {

        },
        computed: {
            workData: function() {
                return {
                    'title': this.title,
                    'selectedCategory': this.selected,
                    'price': this.price,
                    'dimensions': this.dimensions,
                    'description': this.description,
                    'images': this.images,
                    'primaryPhoto': this.primaryPhoto
                }
            }
        },
        methods: {
            save: function() {
                 this.$http.post(this.saveEndpoint, this.workData, {headers: {
                         Authorization: 'Bearer ' + this.apiToken
                     }}).then(function(response){
                    this.$bus.$emit('saved');
                     location.reload();
                 }, response =>{

                 });
            },
            deleteImage: function(index) {
                this.images.splice(index, 1);
            },
            showSuccess: function(file, response) {
                console.log(response.name);

                this.images.push(response);
            }
        },
        components:{
            'pulse-loader': PulseLoader,
            'dropzone': Dropzone
        }
    }
</script>
