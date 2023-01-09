<template>
    <div class="col-md-4 border-end p-0">
        <div class="d-flex align-items-center justify-content-between leftSideSecrchBox">
            <div class="input-group" id="inputWithSearchIcon">
                                    <span class="input-group-text" id="icon" data-bs-toggle="modal"
                                          data-bs-target="#attachementModal"><i class="fa fa-search"></i></span>
                <input class="form-control border-start-0 input-txt-bx" id="searchAsset" type="text"
                       name="message-to-send" v-model="searchMember" placeholder="Search in conversations"
                       data-bs-original-title="" title="">
            </div>
        </div>

        <div class="conversationsList custom-scrollbar mt-3">
            <ul>

                <li v-if="filteredItemsLength" v-for="member in filteredItems" :key="member.id"
                    v-on:click="onClickButton(member)">
                    <a href="javascript:void(0)" class='conversation conversationInActive '
                       :class="getActiveClass(member.id)" id="dd11">
                        <img class="img-fluid rounded-circle"
                             :src="getAvatar(member.image_relative_url)" width="120px">
                        <div class="w-100">
                            <div class="d-flex flex-row justify-content-between p-0">
                                <p class="name text-natural-gray-7 fw-700">{{ member.name }}</p>
                                <div class="listTime">
                                <p class="lastMsgTime text-natural-gray-7 fw-700"> {{ asDays < 7 ? getFormattedDate(member.status_date_time).format('ddd') : getFormattedDate(member.status_date_time).format('MMM DD') }} <span class="dot_time"></span> {{ getFormattedDate(member.status_date_time).format('HH:mm A') }}</p>
                                </div>
                            </div>
                            <p class="mb-0 lastMsg">{{ member.body }}</p>
                        </div>
                    </a>
                </li>
                <li v-if="!filteredItemsLength" id="not-found"><a href="#"><p class="name text-natural-gray-7 fw-700">
                    Not Found</p></a></li>

            </ul>
        </div>
    </div>
</template>
<script>

import moment from "moment";
import timezone from "moment-timezone";
export default {
    name: "MemberList",
    components:{

    },
    props: ["member"],
    data() {
        return {
            // Our data object that holds the Laravel paginator data
            memberList: [],
            conversations: [],
            searchMember: '',
            selectedMember: '',
            asDays: '',
        }
    },
    mounted() {
        // Fetch initial results
        this.getResults();
    },
    computed: {
        filteredItems() {

            return this.memberList.filter(item => {
                return item.name.toLowerCase().includes(this.searchMember.toLowerCase())
            })
        },
        filteredItemsLength() {
            return this.filteredItems.length > 0;
        } ,
        appendDotClass() {
            return '<span class="dot_time"></span>';
        }
    },
    methods: {
        // Our method to GET results from a Laravel endpoint
        onClickButton(member) {
            this.selectedMember = member.id
            this.$emit('clicked', member)

        },
        getFormattedDate(date){
            const time = moment(date)
            var timeDifference = moment.tz.guess();
            const statusDateTime = time.clone().tz(timeDifference);
            var duration = moment.duration(moment().diff(statusDateTime));
            var days = duration.asDays();
            return statusDateTime;
        },
        getResults() {
            axios.get('/api/conversations/members')
                .then(response => {
                    this.memberList = response.data;
                });
        },
        getAvatar(src) {
            return src ? src : "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png"
        },
        getActiveClass(id) {
            if (this.member.id == id) {
                return "activeMember"
            }
            return this.selectedMember == id ? "activeMember" : '';
        }
    }
}
</script>
