<template>
    <div>
        <div class="container">
        <div class="row">

                <div class="col pull-left" style="margin-left: 15px;">
                    Back to
                    <a :href="backToCategory"> {{ work.category.alias }}</a>
                </div>
                <div v-if="user" class="col pull-right">
                    <a href="#" @click="showModal">edit</a>
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

            <div class="row align-items-start">
                <div class="col-md-1 spacer5">
                    <span v-for="(media, index) in work.medias"><img width="100" height="100" class="img-responsive padding" :src="media.path" @click="changeLargePhoto(index)"></span>
                </div>
                <div class="col-sm-5">
                    <h1>{{  }}</h1>
                    <span><img width="400" height="500" class="img-responsive" :src="largePhoto"></span>
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
</style>
<script>
    import Modal from '../Modal.vue'
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
            work: {
                type: Object,
                required: true
            },
            categories: {
                type: Array,
                required: true
            },
            user: {
                type: Object,
                default: null
            }
        },
        data(){
            return{
                largePhoto: '',
                title: this.work.title,
                category: this.work.category.id,
                price: this.work.price,
                dimensions: this.work.measurements,
                description: this.work.description
            }
        },
        created: function() {
            for(var i = 0; i < this.work['medias'].length; i++) {
                if(this.work['medias'][i].primary == 1) {
                    this.largePhoto = this.work['medias'][i].path;

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
                this.largePhoto = this.work['medias'][index].path;
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
            }
        },
        components:{
            'modal' : Modal
        }
    }
</script>
