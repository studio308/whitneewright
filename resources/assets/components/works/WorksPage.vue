<template>
    <div>
        <div class="container">
        <div class="row">

                <div class="col pull-left">
                    Back to
                    <a :href="backToCategory"> {{ work.category.alias }}</a>
                </div>
            </div>


            <div class="row align-items-start">
                <div class="col-sm-1 spacer5">
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
</style>
<script>
    export default{
        props: {
            backToCategory: {
                type: String,
                required: true
            },
            work: {
                type: Object,
                required: true
            },
        },
        data(){
            return{
                largePhoto: ''
            }
        },
        created: function() {
            for(var i = 0; i < this.work['medias'].length; i++) {
                if(this.work['medias'][i].primary == 1) {
                    this.largePhoto = this.work['medias'][i].path;

                }
            }
        },
        methods: {
            changeLargePhoto: function(index) {
                this.largePhoto = this.work['medias'][index].path;
            }
        },
        components:{

        }
    }
</script>
