<template>
    <div class="modal" :class="modal_class" :id="modal_id" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="row-col h-v">
            <div class="row-cell v-m">
                <div class="modal-dialog"
                     :class="size"
                     role="document">
                    <div class="white-box">
                        <div class="box-header b-0" v-if="display_header">
                            <button v-if="display_header_close_btn" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h6 v-if="!this.$slots['modal_header']" class="m-b-0"></h6>
                            <slot name="modal_header"></slot>
                        </div>
                        <div class="box-divider"></div>
                        <div class="modal-body box-body">
                            <slot name="modal_body"></slot>
                        </div>
                        <div class="modal-footer box-footer" v-if="display_footer">
                            <button v-if="!this.$slots['modal_footer']" type="button" class="btn white" data-dismiss="modal">Close</button>
                            <slot name="modal_footer"></slot>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
    .white-box { margin-top: 50px; margin-left: auto; margin-right: auto;

background: rgba(255,255,255,1);
padding: 30px;
-webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.15);
-moz-box-shadow: 0 1px 2px rgba(0,0,0,0.15);
box-shadow: 0 1px 2px rgba(0,0,0,0.15);
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
-ms-border-radius: 5px;
-o-border-radius: 5px;
border-radius: 5px;
}

.featured:before {
content: '+';
font-weight: 400;
display: inline-block;
margin-right: 5px;
color: #4CB1FF;
}

.vertical-text {width:50px; height:50px; margin: 30px 0 auto auto; background: #4CB1FF;}
.vertical-text span {
width: 50px;
display: inline-block;
text-align: center;
-webkit-transform: rotate(-90deg);
-moz-transform: rotate(-90deg);
-ms-transform: rotate(-90deg);
-o-transform: rotate(-90deg);
transform: rotate(-90deg);
}
</style>
<script>
    export default{
        props: {
            modal_id: {
                type: String,
                required: true
            },
            modal_class: {
                type: String,
                default: ''
            },
            size: {
                default : null
            },
            use_header_close: {
                default: false
            },
            display_footer: {
                default: true
            },
            display_header: {
                default: true
            }
        },
        computed: {
//            display_header(){
//                return !(!this.$slots['modal_header'] && !this.display_header_close_btn);
//            },
            display_header_close_btn(){
                return (this.use_header_close === 'true' || this.use_header_close === true);
            }
        }
    }
</script>
