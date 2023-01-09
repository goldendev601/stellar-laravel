<template>
    <div class="chat-message clearfix">
        <div class="row">
            <div class="col-xl-12">
                <div class="input-group text-box">
                    <input class="form-control border-start-0 input-txt-bx" id="message-to-send" type="text"
                           name="message-to-send" placeholder="Type a message......" data-bs-original-title=""
                           title="" v-model="smsText">
                    <button :class="[ smsText ?  'input-group-text btn btn-primary' : 'input-group-text btn btn-primary inActive'] " type="button" data-bs-original-title=""
                            title="" v-on:click="sendSms">

                       <span v-if="!isloaderRuning">SEND MESSAGE</span>
                            <div v-if="isloaderRuning" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "ChatMessage",
    props:['isLoadingChat'],
    data() {
        return {
            // Our data object that holds the Laravel paginator data
            smsText: ''

        }
    },
    computed: {
        isloaderRuning() {
            return this.$parent.isLoadingChat;
        }
    },
    methods: {
        sendSms() {
            this.$emit('clicked', this.smsText)
            this.smsText = '';
        },
    }
}
</script>
