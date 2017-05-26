<template>
    <div>
        <h4> Categories </h4>
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="list-group">
                    <li v-for="category in categories" class="list-group-item">{{ category.alias }}</li>
                </ul>
            </div>
            <div class="panel-footer clearfix">
                <add-category
                        :save-endpoint="saveEndpoint"
                ></add-category>
            </div>
        </div>
    </div>
</template>
<style>

</style>
<script>
    import { PulseLoader } from 'vue-spinner/dist/vue-spinner.min.js'
    import AddCategory from './AddCategory.vue'
    export default{
        props: {
            categories: {
                type: Array,
                required: true
            },
            saveEndpoint: {
                type: String,
                required: true
            },
            deleteEndpoint: {
                type: String,
                required: true
            }
        },
        data(){
            return{
                msg:'hello vue'
            }
        },
        created: function() {
            this.$bus.$on('saved', function () { location.reload(); })
        },
        components:{
            'pulse-loader': PulseLoader,
            'add-category': AddCategory
        }
    }
</script>
