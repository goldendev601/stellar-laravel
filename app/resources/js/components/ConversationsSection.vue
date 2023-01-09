<template>
    <div id="conversationsPageRight-2" class="col-md-8 py-3 px-0">
        <loader :loader="loader"></loader>
        <div id="selected-1">

            <div class="row m-0 chat-box">
                <!-- Chat right side start-->
                <div class="col-12 ps-0 chat-right-aside widthAdjust">
                    <!-- chat start-->
                    <div class="chat">
                        <!-- chat-header start-->
                        <div class="chat-header" v-if="conversationsLength > 0">
                            <div class="about">
                                <div class="name">{{ member.first_name }} {{ member.last_name }}</div>
                                <!--                                <div class="status">Last Seen 3:55 PM</div>-->
                            </div>
                        </div>
                        <!-- chat-header end-->
                        <div class="chat-history chat-msg-box custom-scrollbar" id="customSsdas">
                            <ul v-if="conversationsLength > 0">
                                <!--                                is_admin_message-->
                                <li class="clearfix" v-for="conversation in conversations" :key="conversation.id">
                                    <div
                                        class="message my-message mb-0 pull-right d-flex flex-column justify-content-end mb-3 p-0"
                                        v-if="conversation.is_admin_message">
                                        <div class="message-data text-end">
                                            <span>  {{ conversation.message }}</span>
<!--                                            <span v-for="url in urlify(323)" :key="url">-->

<!--                                            <vue-link-preview v-for="url in urlify(323)" :key="url" :url="url" @click="handleClick"></vue-link-preview>-->

<!--</span>-->

                                        </div>
                                        <div class="message-data-time  text-end">
                                            <span :class="getStatusClass(conversation.status)">{{
                                                    conversation.status
                                                }}</span>
                                            {{ dateFormatWithUserTimeZone(conversation.status_date_time) }}
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3 message other-message pull-left" v-else>
                                        <div class="flex-shrink-0">
                                            <img class="rounded-circle chat-user-img img-30"
                                                 :src="getAvatar(conversation.receiver_image_url)" alt="">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="d-flex flex-column justify-content-end mb-3 p-0">
                                                <div class="message-data-name text-start mb-2">{{
                                                        conversation.receiver
                                                    }}
                                                </div>
                                                <div class="message-data text-start">
                                                    <span>  {{ conversation.message }}</span>
<!--                                                    <LinkPreview url="https://vuejs.org/"></LinkPreview>-->
                                                </div>
                                                <div class="message-data-time  text-start">
                                                    <span :class="getStatusClass(conversation.status)">{{
                                                            conversation.status
                                                        }}</span>
                                                    {{ dateFormatWithUserTimeZone(conversation.status_date_time) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </li>
                                <li ref="bottom" style="margin-bottom: 5px;"></li>
                            </ul>
                            <div id="no-conversation" v-if="conversationsLength == 0">
                                <h3>No conversation <span v-if="member.name != null"> found  with  {{member.name}}</span> </h3>

                            </div>
<!--                            <h1 ref="bottom"></h1>-->
                        </div>


                        <!-- end chat-history-->
                        <ChatMessage :isLoadingChat="isLoadingChat" v-if="conversationsLength > 0"
                                     @clicked="sendSms"></ChatMessage>
                        <!-- end chat-message-->
                        <!-- chat end-->
                        <!-- Chat right side ends-->
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>

import ChatMessage from "./ChatMessage";
import loader from "./loader"
//todo
// import LinkPreview from 'link-prevue'
import LinkPreview from '@ashwamegh/vue-link-preview'
import moment from "moment";
import timezone from "moment-timezone";
export default {
    name: "ConversationsSection",
    props: ["conversations", "member", "loader"],
    data: function () {
        return {
            isLoadingChat: false
        }
    },
    comments: {
        ChatMessage,
        loader,
        LinkPreview
    },
    computed: {
        conversationsLength() {
            return this.conversations.length ?? 0
        }
    },

    mounted() {

    },

    methods: {
        async sendSms(text) {
            this.isLoadingChat = true
            await axios.post('/api/conversations/send', {
                text: text,
                memberId: this.member.id,
            })
                .then(response => {
                    this.isLoadingChat = false
                    this.$parent.onClickChild(this.member)
                    this.scrollChat()
                });

        },
        getStatusClass(status) {
            if (status == "delivered") {
                return "badge badge-success"
            } else if (status == "delivery_failed") {
                return "badge badge-danger"
            } else {
                return "badge badge-warning"
            }

        },
        dateFormatWithUserTimeZone(date)
        {
            const time = moment(date)
            var timeDifference = moment.tz.guess();
            const statusDateTime = time.clone().tz(timeDifference);
            var YESTERDAY = moment().clone().subtract(1, 'days');
            var dateFromat = moment().isSame(time,"day") ? 'Today at' : (YESTERDAY.isSame(time,"day") ? 'Yesterday at': statusDateTime.format('DD MMM YYYY'));
            return  dateFromat + ' ' + statusDateTime.format('HH:mm A');

        },
        scrollChat()
        {

            this.$refs['bottom'].scrollIntoView(false)
        },
        getAvatar(src) {
            return src ? src : "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png"
        },
        urlify(inputText) {
            //todo
            var pattern1 = /[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)?/gi;
            // const pattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
            let text = inputText.match(pattern1, '<a href="$1" target="_blank">$1</a>');
            return text;
        }
    }
}
</script>

