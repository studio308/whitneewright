<template>
    <div>
        <div class="container">
        <div class="row">

                <div class="col pull-left" style="margin-left: 15px;">
                    Back to
                    <a class="oblique" :href="backToCategory"> {{ work.category.alias }}</a>
                </div>
                <div v-if="user" class="col pull-right">
                    <a href="#" @click="showModal">edit</a>
                    <div class="row">
                        <a href="#" @click="deleteModal">delete</a>
                    </div>
                </div>
            </div>

            <modal modal_id="test" modal_class="test" :display_header="false" :display_footer="false">
                <div slot="modal_body">
                    <div class="m-a-2 p-a-2 center text-center block-center center-block">
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 form-control-label">Title</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="title" v-model="title">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="categories" class="col-sm-3 form-control-label">Category</label>
                            <div class="col-sm-7">
                                <select name="categories" id="categories" class="form-control" v-model="category">
                                    <option v-for="category in categories" :value="category.id"> {{ category.alias }} </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-3 form-control-label">Price</label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control" id="price" v-model="price">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dimensions" class="col-sm-3 form-control-label">Dimensions</label>
                            <div class="col-sm-7">
                                <input type="text" min="0" class="form-control" id="dimensions" v-model="dimensions">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-3 form-control-label">Description</label>
                            <div class="col-sm-7">
                                <textarea class="form-control" rows="5" id="description" v-model="description"></textarea>
                            </div>
                        </div>
                        <span><button type="button" class="btn btn-primary" @click="update">Save</button></span>
                    </div>
                </div>
            </modal>

            <modal modal_id="delete" modal_class="delete" :display_header="false" :display_footer="false">
                <div slot="modal_body">
                    <div class="m-a-2 p-a-2 center text-center block-center center-block">
                        <h4>Are you sure you want to delete {{ work.title }}?</h4>
                        <span><button type="button" class="btn btn-primary" @click="deleteWork">Delete</button></span>
                        <span><button type="button" class="btn btn-primary" @click="deleteWorkCancel">Cancel</button></span>
                    </div>
                </div>
            </modal>

            <image-modal modal_id="image" modal_class="image" :display_header="true" :display_footer="false">
                <div slot="modal_body">
                    <div class="m-a-2 p-a-2 center text-center block-center center-block">
                        <div class="imagewrap" v-on:mouseenter="showArrows" v-on:mouseleave="hideArrows">
                            <button id="previousArrow" class="glyphicon glyphicon-backward previousArrow" @click="previousImage(images.indexOf(modalImage))"></button>
                            <i class="arrow right"></i>
                            <img class="img-responsive center-block" :src="modalImage.path">
                            <button id="nextArrow" class="glyphicon glyphicon-forward nextArrow" @click="nextImage(images.indexOf(modalImage))"></button>
                        </div>
                    </div>
                    <div slot="modal_footer">
                        <div class="center text-center block-center center-block">
                            <span class="modaltext">
                                {{ (1 + images.indexOf(modalImage)) }} - {{ images.length }}
                            </span>
                        </div>
                    </div>
                </div>
            </image-modal>

            <div class="row align-items-start">
                <div class="col-md-1 spacer5">
                    <span v-for="(media, index) in work.medias"><img width="100" height="100" class="img-responsive padding" :src="media.path" @click="changeLargePhoto(index)"></span>
                </div>
                <div class="col-sm-5">
                    <h1>{{  }}</h1>
                    <span><img width="400" height="500" class="img-responsive" :src="largePhoto.path" @click="showImageModal"></span>
                    <p>{{  }}</p>
                </div>
                <div class="col-sm-5 col-md-2 spacer5">
                    {{ work.title }}
                    <div class="row">
                        {{ work.price }}
                    </div>
                    <div class="row">
                        {{ work.measurements }}
                    </div>
                    <div class="row">
                        {{ work.description }}
                    </div>
                </div>
            </div>
        </div>

</div>
</template>
<style>
.spacer5 {
  padding-top: 20px;
}
.padding {
    padding-bottom: 5px;
}
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}
a {
    color: #bdbdbd;
}
a.oblique {
    font-style: oblique;
}
a:hover {
    color: #000000;
}
.previousArrow {position:absolute;top:50%;}
.nextArrow {position:absolute;right:0;top:50%;}
.imagewrap {display:inline-block;position:relative;}
.modaltext{ color:white; }
i {
    border: solid black;
    border-width: 0 3px 3px 0;
    display: inline-block;
    padding: 3px;
}
.right {
    transform: rotate(-45deg);
    -webkit-transform: rotate(-45deg);
}

</style>
<script>
    import Modal from '../Modal.vue'
    import ImageModal from '../ImageModal.vue'
    import vueImages from 'vue-images'
    export default{
        props: {
            backToCategory: {
                type: String,
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
            work: {
                type: Object,
                required: true
            },
            categories: {
                type: Array,
                default: null
            },
            user: {
                type: Object,
                default: null
            }
        },
        data(){
            return{
                largePhoto: '',
                modalImage: '',
                title: this.work.title,
                category: this.work.category.id,
                price: this.work.price,
                dimensions: this.work.measurements,
                description: this.work.description,
                images: this.work.medias
            }
        },
        created: function() {
            for(var i = 0; i < this.work['medias'].length; i++) {
                if(this.work['medias'][i].primary == 1) {
                    this.largePhoto = this.work['medias'][i];
                }
            }
        },
        computed: {
            updateWork: function() {
                return {
                    'title': this.title,
                    'selectedCategory': this.category,
                    'price': this.price,
                    'dimensions': this.dimensions,
                    'description': this.description
                }
            }
        },
        methods: {
            changeLargePhoto: function(index) {
                this.largePhoto = this.work['medias'][index];
            },
            showModal() {
                $('#test').modal('show');
            },
            update() {
                 this.$http.post(this.saveEndpoint, this.updateWork).then(function(response){
                    this.$bus.$emit('saved');
                    location.reload();
                 }, response =>{

                 });
            },
            showImageModal() {
                this.modalImage = this.largePhoto;
                $('#image').modal('show');
                this.hideArrows();
            },
            nextImage: function(index){
                if(index >= 0 && index <= this.images.length - 1) {
                    if(index + 1 > this.images.length - 1) {
                        this.modalImage = this.images[0];
                    } else {
                        this.modalImage = this.images[index + 1]
                    }
                }
            },
            previousImage: function(index){
                if(index >= 0 && index <= this.images.length - 1) {
                    if(index - 1 < 0) {
                        this.modalImage = this.images[this.images.length - 1];
                    } else {
                        this.modalImage = this.images[index - 1]
                    }
                }
            },
            showArrows() {
                $('#previousArrow').fadeIn();
                $('#nextArrow').fadeIn();
            },
            hideArrows() {
                $('#previousArrow').fadeOut();
                $('#nextArrow').fadeOut();
            },
            deleteModal() {
                $('#delete').modal('show');
            },
            deleteWorkCancel() {
                $('#delete').modal('hide');
            },
            deleteWork() {
                 this.$http.post(this.deleteEndpoint).then(function(response){
                    this.$bus.$emit('deleted');
                    location.reload();
                 }, response =>{

                 });
            }
        },
        components:{
            'modal' : Modal,
            'vue-images': vueImages,
            'image-modal': ImageModal
        }
    }
</script>
