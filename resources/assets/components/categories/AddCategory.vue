<template>
    <div>
        <table class="table">
            <tbody>
                <tr v-for="(row,index) in rows">
                    <td><input type="text" v-model="row.name" id="index"></td>
                    <td><button class="glyphicon glyphicon-trash" @click="removeElement(index)"></button></td>
                </tr>
            </tbody>
        </table>
        <span><button type="button" class="btn btn-primary" v-if="showSaveButton == true" @click="save">Save</button></span>
        <a type="button" class="glyphicon glyphicon-plus pull-right green" @click="addRow"></a>
    </div>
</template>
<style>
.green {
    color:#00ff0a;
}
</style>
<script>
    export default{
        props: {
            saveEndpoint: {
                type: String,
                required: true
            }
        },
        data(){
            return{
                rows: [],
                showSaveButton: false
            }
        },
        watch: {
            rows: {
                handler: function(val) {
                    if(this.rows.length >= 1) {
                        this.showSaveButton = true
                    } else {
                        this.showSaveButton = false;
                    }
                },
                deep: true
            },
        },
        computed: {
            categoryData: function() {
                return {
                    'categories': this.rows
                }
            }
        },
        methods: {
            addRow: function() {
                var elem = document.createElement('tr');
                this.rows.push({
                    name: ""
                });
            },
            removeElement: function(index) {
                this.rows.splice(index, 1);
            },
            save: function(){
                 this.$http.post(this.saveEndpoint, this.rows).then(function(response){
                    this.$bus.$emit('saved');
                    location.reload();
                 }, response =>{

                 });
            }
        },
        components:{

        }
    }
</script>
