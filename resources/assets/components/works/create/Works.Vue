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
                        <label for="images" class="col-sm-3">Images</label>
                        <div class="col-sm-10">
                            <ul class="mod_files">
                                <li v-for="(image, index) in images">
                                    <strong>{{image.name}}</strong>
                                    <div class="thumbnail">
                                        <img :src="image.location" />
                                        <div class="clearfix">
                                            <input type="radio" name="primary" class="pull-left" value="image.id"><p class="pull-left">Primary</p>
                                            <a type="button" class="glyphicon glyphicon-remove red pull-right green" @click="deleteImage(index)"></a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <input type="file" id="images" @change="onFileChange">
                            <span><button type="button" class="btn btn-primary" @click="save">Save</button></span>
                        </div>
                    </div>
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
        },
        data(){
            return{
                images: [],
                imagesTest: [],
                title: '',
                selected: '',
                price: 0,
                dimensions: '',
                description: '',
                image: {}
            }
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
                    'images': this.images
                }
            }
        },
        methods: {
            onFileChange(e) {
                e.preventDefault();
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;

                var file = e.target.files[0];
                var imageView = window.URL.createObjectURL(file)
                var data = new FormData();
                data.append('image', file);
                this.$http.post(this.saveImageEndpoint, data).then(function(response){
                    console.log(response.data);
                    var image = {
                        'imagePath': response.data,
                        'location': imageView,
                    }
                    this.images.push(image);
                }, response =>{

                });
            },
            save: function() {
                 var formData = new FormData()
                 formData.append('image', this.image);
                 this.$http.post(this.saveEndpoint, formData).then(function(response){
                    this.$bus.$emit('saved');
                 }, response =>{

                 });
            },
            deleteImage: function(index) {
                this.images.splice(index, 1);
            }
        },
        components:{
            'pulse-loader': PulseLoader,
            'dropzone': Dropzone

        }
    }
</script>
